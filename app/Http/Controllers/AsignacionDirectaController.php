<?php

namespace app\Http\Controllers;

use app\Herramienta;
use app\Material;
use app\Notificacion;
use app\NotificacionUser;
use app\Obra;
use app\ObraHerramienta;
use app\Personal;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AsignacionDirectaController extends Controller
{
    public function create(Obra $obra)
    {
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
        return view("asignacion_directa.create", compact("obra", "materiales", "herramientas", "personals"));
    }

    public function store(Obra $obra, Request $request)
    {
        if (!$obra->solicitud_obra) {
            $solicitud_obra = $obra->solicitud_obra()->create([
                "aprobado" => 1,
                "fecha_registro" => date("Y-m-d")
            ]);
        } else {
            $solicitud_obra = $obra->solicitud_obra;
            $solicitud_obra->aprobado = 1;
            $solicitud_obra->save();
        }

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
                    "aprobado" => 1,
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
                    "aprobado" => 1,
                ]);
            }
        }
        if (isset($personals)) {
            for ($i = 0; $i < count($personals); $i++) {
                $array_personal = explode("|", $personals[$i]);
                $solicitud_obra->solicitud_personals()->create([
                    "personal_id" => $array_personal[1],
                    "ingreso" => 0,
                    "aprobado" => 1,
                ]);
            }
        }

        $desc_add = "";
        if (isset($materials)) {
            $desc_add .= " MATERIALES,";
        }
        if (isset($herramientas)) {
            $desc_add .= " HERRAMIENTAS,";
        }
        if (isset($personals)) {
            $desc_add .= " PERSONAL,";
        }

        $nueva_notificacion = Notificacion::create([
            'registro_id' => $solicitud_obra->id,
            'tipo'  => 'SOLICITUD',
            'accion' => "NUEVO",
            'mensaje' => "EL USUARIO " . Auth::user()->name . " APROBÓ Y ASIGNÓ" . $desc_add . " EN LA OBRA: " . $solicitud_obra->obra->nombre,
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
        ]);
        NotificacionUser::create([
            'notificacion_id' => $nueva_notificacion->id,
            'user_id' => $obra->jefe_id,
            'visto' => 0
        ]);

        return redirect()->route('solicitud_obras.solicitudes_obra', $obra->id)->with('bien', 'Registro realizado con éxito');
    }
}
