<?php

namespace app\Http\Controllers;

use app\Herramienta;
use app\Material;
use app\Notificacion;
use app\NotificacionUser;
use app\Obra;
use app\ObraHerramienta;
use app\ObraPersonal;
use app\Personal;
use app\SolicitudHerramienta;
use app\SolicitudMaterial;
use app\SolicitudNota;
use app\SolicitudObra;
use app\SolicitudPersonal;
use app\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class SolicitudObraController extends Controller
{
    public function index()
    {
        $solicitud_obras = [];
        if (Auth::user()->tipo == 'AUXILIAR') {
            $solicitud_obras = SolicitudObra::select("solicitud_obras.*")
                ->join("obras", "obras.id", "=", "solicitud_obras.obra_id")
                ->where("obras.auxiliar_id", Auth::user()->id)
                ->orderBy("fecha_registro", "desc")->orderBy("created_at", "desc")
                ->get();
        } else {
            $solicitud_obras = SolicitudObra::orderBy("fecha_registro", "desc")->orderBy("created_at", "desc")->get();
        }

        return view("solicitud_obras.index", compact("solicitud_obras"));
    }

    public function solicitudes_obra(Obra $obra)
    {
        $solicitud_obras = SolicitudObra::where("obra_id", $obra->id)
            ->orderBy("fecha_registro", "desc")->orderBy("created_at", "desc")
            ->get();

        return view("solicitud_obras.solicitudes_obra", compact("solicitud_obras", "obra"));
    }

    public function show(SolicitudObra $solicitud_obra)
    {
        $obra = $solicitud_obra->obra;
        return view("solicitud_obras.show", compact("solicitud_obra", "obra"));
    }

    public function create(Obra $obra)
    {
        if ($obra->solicitud_obra) {
            return redirect()->route("solicitud_obras.edit", $obra->solicitud_obra->id);
        }
        $materiales = Material::all();
        $reg_herramientas = Herramienta::all();
        $herramientas = [];
        foreach ($reg_herramientas as $h) {
            $existe = ObraHerramienta::where("estado", 1)
                ->where("herramienta_id", $h->id)
                ->get()->first();
            if ($h->estado == 'INGRESO' && !$existe) {
                $herramientas[] = $h;
            }
        }
        $personals = Personal::where("estado", 1)->where("habilitado", 1)->get();
        return view("solicitud_obras.create", compact("obra", "materiales", "herramientas", "personals"));
    }

    public function store(Obra $obra, Request $request)
    {
        // $request->validate([
        //     "materials" => "required",
        //     "herramientas" => "required",
        //     "personals" => "required",
        // ], [
        //     "materials.required" => "Debes ingresar al menos un material",
        //     "herramientas.required" => "Debes ingresar al menos una herramienta",
        //     "personals.required" => "Debes ingresar al menos un personal",
        // ]);

        $solicitud_obra = $obra->solicitud_obra()->create([
            "aprobado" => 0,
            "fecha_registro" => date("Y-m-d")
        ]);

        $materials = $request->materials;
        $herramientas = $request->herramientas;
        $personals = $request->personals;

        if (isset($materials)) {
            for ($i = 0; $i < count($materials); $i++) {
                $array_material = explode("|", $materials[$i]);
                $solicitud_obra->solicitud_materials()->create([
                    "material_id" => $array_material[1],
                    "cantidad" => $array_material[2],
                    "cantidad_usada" => 0,
                    "aprobado" => 0,
                ]);
            }
        }

        if (isset($herramientas)) {
            for ($i = 0; $i < count($herramientas); $i++) {
                $array_herramienta = explode("|", $herramientas[$i]);
                $solicitud_obra->solicitud_herramientas()->create([
                    "herramienta_id" => $array_herramienta[1],
                    "dias_uso" => $array_herramienta[2],
                    "fecha_asignacion" => $array_herramienta[3],
                    "fecha_finalizacion" => $array_herramienta[4],
                    "ingreso" => 0,
                    "aprobado" => 0,
                ]);
            }
        }
        if (isset($personals)) {
            for ($i = 0; $i < count($personals); $i++) {
                $array_personal = explode("|", $personals[$i]);
                $solicitud_obra->solicitud_personals()->create([
                    "personal_id" => $array_personal[1],
                    "ingreso" => 0,
                    "aprobado" => 0,
                ]);
            }
        }

        $nueva_notificacion = Notificacion::create([
            'registro_id' => $solicitud_obra->id,
            'tipo'  => 'SOLICITUD',
            'accion' => "NUEVO",
            'mensaje' => "SE REALZÓ UNA SOLICITUD PARA LA OBRA: " . $solicitud_obra->obra->nombre,
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
        ]);

        $users = User::where('estado', 1)->whereIn('tipo', ["ADMINISTRADOR", "AUXILIAR"])->get();
        foreach ($users as $u) {
            NotificacionUser::create([
                'notificacion_id' => $nueva_notificacion->id,
                'user_id' => $u->id,
                'visto' => 0
            ]);
        }

        return redirect()->route('solicitud_obras.solicitudes_obra', $obra->id)->with('bien', 'Registro realizado con éxito');
    }


    public function edit(SolicitudObra $solicitud_obra)
    {
        $materiales = Material::all();
        $personals = Personal::where("estado", 1)->get();
        $reg_herramientas = Herramienta::all();
        $herramientas = [];
        foreach ($reg_herramientas as $h) {
            if ($h->estado == 'INGRESO') {
                $existe = ObraHerramienta::where("estado", 1)
                    ->where("herramienta_id", $h->id)
                    ->get()->first();
                $pertenece = SolicitudHerramienta::where("solicitud_obra_id", $solicitud_obra->id)
                    ->where("herramienta_id", $h->id)->get()->first();
                if (!$existe || $pertenece) {
                    $herramientas[] = $h;
                }
            }
        }
        $obra = $solicitud_obra->obra;
        return view("solicitud_obras.edit", compact("solicitud_obra", "obra", "materiales", "herramientas", "personals"));
    }

    public function update(SolicitudObra $solicitud_obra, Request $request)
    {
        $solicitud_obra->update([
            "aprobado" => 0,
            "fecha_registro" => date("Y-m-d")
        ]);

        $obra = $solicitud_obra->obra;

        $materials = $request->materials;
        $herramientas = $request->herramientas;
        $personals = $request->personals;

        if (isset($materials)) {
            for ($i = 0; $i < count($materials); $i++) {
                $array_material = explode("|", $materials[$i]);
                if ($array_material[0] == 0) {
                    $solicitud_obra->aprobado = 0;
                    $solicitud_obra->solicitud_materials()->create([
                        "material_id" => $array_material[1],
                        "cantidad" => $array_material[2],
                        "cantidad_usada" => 0,
                        "aprobado" => 0,
                    ]);
                } else {
                    $solicitud_material = SolicitudMaterial::find($array_material[0]);
                    $solicitud_material->update([
                        "material_id" => $array_material[1],
                        "cantidad" => $array_material[2],
                        'cantidad_usada' => 0,
                        "aprobado" => 0,
                    ]);
                    if ($solicitud_material->aprobado == 0) {
                        $solicitud_obra->aprobado = 0;
                    }
                }
            }
        }

        if (isset($herramientas)) {
            for ($i = 0; $i < count($herramientas); $i++) {
                $array_herramienta = explode("|", $herramientas[$i]);
                if ($array_herramienta[0] == 0) {
                    $solicitud_obra->aprobado = 0;
                    $solicitud_obra->solicitud_herramientas()->create([
                        "herramienta_id" => $array_herramienta[1],
                        "dias_uso" => $array_herramienta[2],
                        "fecha_asignacion" => $array_herramienta[3],
                        "fecha_finalizacion" => $array_herramienta[4],
                        "ingreso" => 0,
                        "aprobado" => 0,
                    ]);
                } else {
                    $solicitud_herramienta = SolicitudHerramienta::find($array_herramienta[0]);
                    if (!$solicitud_herramienta->asignado) {
                        $solicitud_herramienta->update([
                            "herramienta_id" => $array_herramienta[1],
                            "dias_uso" => $array_herramienta[2],
                            "fecha_asignacion" => $array_herramienta[3],
                            "fecha_finalizacion" => $array_herramienta[4],
                            "ingreso" => 0,
                            "aprobado" => 0,
                        ]);
                    }
                    if ($solicitud_herramienta->aprobado == 0) {
                        $solicitud_obra->aprobado = 0;
                    }
                }
            }
        }

        if (isset($personals)) {
            for ($i = 0; $i < count($personals); $i++) {
                $array_personal = explode("|", $personals[$i]);
                if ($array_personal[0] == 0) {
                    $solicitud_obra->aprobado = 0;
                    $solicitud_obra->solicitud_personals()->create([
                        "personal_id" => $array_personal[1],
                        "ingreso" => 0,
                        "aprobado" => 0,
                    ]);
                } else {
                    $solicitud_personal = SolicitudPersonal::find($array_personal[0]);
                    if (!$solicitud_personal->asignado) {
                        $solicitud_personal->update([
                            "personal_id" => $array_personal[1],
                            "ingreso" => 0,
                            "aprobado" => 0,
                        ]);
                    }
                    if ($solicitud_personal->aprobado == 0) {
                        $solicitud_obra->aprobado = 0;
                    }
                }
            }
        }

        $solicitud_obra->save();

        // ELIMINADOS
        if (isset($request->eliminados_material)) {
            $eliminados_material = $request->eliminados_material;
            if (count($eliminados_material) > 0) {
                for ($i = 0; $i < count($eliminados_material); $i++) {
                    $solicitud_material = SolicitudMaterial::find($eliminados_material[$i]);
                    $solicitud_material->delete();
                }
            }
        }
        if (isset($request->eliminados_herramientas)) {
            $eliminados_herramientas = $request->eliminados_herramientas;
            if (count($eliminados_herramientas) > 0) {
                for ($i = 0; $i < count($eliminados_herramientas); $i++) {
                    $solicitud_herramienta = SolicitudHerramienta::find($eliminados_herramientas[$i]);
                    $solicitud_herramienta->delete();
                }
            }
        }
        if (isset($request->eliminados_personal)) {
            $eliminados_personal = $request->eliminados_personal;
            if (count($eliminados_personal) > 0) {
                for ($i = 0; $i < count($eliminados_personal); $i++) {
                    $solicitud_personal = SolicitudPersonal::find($eliminados_personal[$i]);
                    $solicitud_personal->delete();
                }
            }
        }

        $nueva_notificacion = Notificacion::create([
            'registro_id' => $solicitud_obra->id,
            'tipo'  => 'SOLICITUD',
            'accion' => "MODIFICACIÓN",
            'mensaje' => "SE REALIZÓ UNA NUEVA SOLICITUD PARA LA OBRA: " . $solicitud_obra->obra->nombre,
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
        ]);

        $users = User::where('estado', 1)->whereIn('tipo', ["ADMINISTRADOR", "AUXILIAR"])->get();
        foreach ($users as $u) {
            NotificacionUser::create([
                'notificacion_id' => $nueva_notificacion->id,
                'user_id' => $u->id,
                'visto' => 0
            ]);
        }

        return redirect()->route('solicitud_obras.solicitudes_obra', $obra->id)->with('bien', 'Registro realizado con éxito');
    }

    public function cambiaEstado(SolicitudObra $solicitud_obra, Request $request)
    {
        // $solicitud_obra->aprobado = $request->estado;
        $obra = $solicitud_obra->obra;
        $id_solicitud = $request->id;
        $tipo = $request->tipo;
        $solicitud_obra->save();

        if ($tipo == 'material') {
            $solicitud_material = SolicitudMaterial::findOrFail($id_solicitud);
            $solicitud_material->aprobado = $request->estado;
            $solicitud_material->save();
        }

        if ($tipo == 'herramienta') {
            $solicitud_herramienta = SolicitudHerramienta::findOrFail($id_solicitud);
            $solicitud_herramienta->aprobado = $request->estado;
            $solicitud_herramienta->save();
        }

        if ($tipo == 'personal') {
            $solicitud_personal = SolicitudPersonal::findOrFail($id_solicitud);
            $solicitud_personal->aprobado = $request->estado;
            $solicitud_personal->save();
        }

        // verificar aprobado
        $total_solicitud_herramientas = count($solicitud_obra->solicitud_herramientas);
        $total_solicitud_materials = count($solicitud_obra->solicitud_materials);
        $solicitud_personals = count($solicitud_obra->solicitud_personals);
        $total_solicitud_herramientas_aprobados = count($solicitud_obra->solicitud_herramientas->where("aprobado", 1));
        $total_solicitud_materials_aprobados = count($solicitud_obra->solicitud_materials->where("aprobado", 1));
        $solicitud_personals_aprobados = count($solicitud_obra->solicitud_personals->where("aprobado", 1));
        if ($total_solicitud_herramientas == $total_solicitud_herramientas_aprobados && $total_solicitud_materials == $total_solicitud_materials_aprobados && $solicitud_personals == $solicitud_personals_aprobados) {
            $solicitud_obra->aprobado = 1;
            $solicitud_obra->save();
        }


        $tipo_txt = $tipo == 'material' ? 'MATERIAL' : ($tipo == 'herramienta' ? 'HERRAMIENTA' : ($tipo == 'personal' ? 'PERSONAL' : ''));

        $nueva_notificacion = Notificacion::create([
            'registro_id' => $solicitud_obra->id,
            'tipo'  => 'SOLICITUD',
            'accion' => "NUEVO",
            'mensaje' => "SE APROBÓ LA SOLICITUD DE " . $tipo_txt . " EN LA OBRA: " . $solicitud_obra->obra->nombre,
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
        ]);
        NotificacionUser::create([
            'notificacion_id' => $nueva_notificacion->id,
            'user_id' => $obra->jefe_id,
            'visto' => 0
        ]);

        return response()->JSON(true);
    }

    public function destroy(SolicitudObra $solicitud_obra)
    {
        DB::beginTransaction();
        try {
            $obra = $solicitud_obra->obra;
            $notificaciones = Notificacion::where("registro_id", $solicitud_obra->id)
                ->where("tipo", "SOLICITUD")->get();
            foreach ($notificaciones as $value) {
                $value->notificacions_user()->delete();
                $value->delete();
            }
            $solicitud_obra->solicitud_materials()->delete();
            $solicitud_obra->solicitud_herramientas()->delete();
            $solicitud_obra->solicitud_personals()->delete();
            $solicitud_obra->delete();
            DB::commit();
            return redirect()->route('solicitud_obras.solicitudes_obra', $obra->id)->with('bien', 'Registro eliminado');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('solicitud_obras.solicitudes_obra', $obra->id)->with('error', 'No se pudo eliminar el registro debido a un error del sistema: ' . $e->getMessage());
        }
    }
}
