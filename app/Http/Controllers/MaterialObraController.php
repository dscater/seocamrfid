<?php

namespace app\Http\Controllers;

use app\IngresoSalida;
use app\Material;
use Illuminate\Http\Request;
use app\MaterialObra;
use app\Notificacion;
use app\NotificacionUser;
use app\Obra;
use app\SolicitudMaterial;
use app\SolicitudObra;
use app\User;
use Exception;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MaterialObraController extends Controller
{
    public function index(Obra $obra)
    {
        $material_obras = MaterialObra::where('obra_id', $obra->id)->where('estado', 1)->get();
        return view('material_obras.index', compact('material_obras', 'obra'));
    }

    public function create(Obra $obra)
    {
        $materials = Material::all();
        if (Auth::user()->tipo == 'JEFE DE OBRA') {
            $materials = [];
            $material_obras = $obra->materials;
            foreach ($material_obras as $mo) {
                $materials[] = $mo->material;
            }
        }
        $array_materials[''] = 'Seleccione...';
        foreach ($materials as $value) {
            $array_materials[$value->id] = $value->nombre;
        }


        return view('material_obras.create', compact('obra', 'array_materials'));
    }

    public function store(Request $request)
    {
        DB::beginTransaction();
        try {
            $tipo = $request->tipo;
            $fecha_actual = date("Y-m-d");
            if ($tipo == "INGRESO") {
                $request->validate([
                    "solicitud_id_ingresos" => "required",
                    "material_id_ingresos" => "required",
                    "cantidad_ingresos" => "required",
                ], [
                    "solicitud_id_ingresos.required" => "Algó esta equivocado en el formulario intente nuevamente",
                    "material_id_ingresos.required" => "Algó esta equivocado en el formulario intente nuevamente",
                    "cantidad_ingresos.required" => "Debes ingresar la cantidad que ingresara en cada material de la lista",
                ]);

                $solicitud_id_ingresos = $request->solicitud_id_ingresos;
                $material_id_ingresos = $request->material_id_ingresos;
                $cantidad_ingresos = $request->cantidad_ingresos;
                for ($i = 0; $i < count($solicitud_id_ingresos); $i++) {
                    $solicitud_material = SolicitudMaterial::find($solicitud_id_ingresos[$i]);
                    $solicitud_obra = $solicitud_material->solicitud_obra;
                    $material = Material::find($material_id_ingresos[$i]);
                    $existe = MaterialObra::where("material_id", $material_id_ingresos[$i])
                        ->where("obra_id", $request->obra_id)
                        ->get()->first();
                    if (!$existe) {
                        $material_obra = MaterialObra::create(array_map('mb_strtoupper', [
                            'material_id' => $material_id_ingresos[$i],
                            'stock_minimo' => $material->stock_minimo,
                            'stock_actual' => $cantidad_ingresos[$i],
                            'estado_stock' => 'NORMAL',
                            'obra_id' => $solicitud_obra->obra->id,
                            'fecha_registro' => $fecha_actual,
                            'estado' => 1
                        ]));
                    } else {
                        $material_obra = $existe;
                        $material_obra->stock_actual = (float)$material_obra->stock_actual + (float)$cantidad_ingresos[$i];
                        $material_obra->save();
                    }

                    // actualizar la cantidad_usada de la SM
                    $solicitud_material->cantidad_usada = $solicitud_material->cantidad_usada + (float)$cantidad_ingresos[$i];
                    $solicitud_material->save();

                    if ($material_obra->stock_actual < $material_obra->stock_minimo) {
                        $material_obra->estado_stock = 'BAJO';
                    } else {
                        $material_obra->estado_stock = 'NORMAL';
                    }
                    // else{
                    //     throw new Exception('No es posible realizar el registro debido a que la cantidad supera al stock disponible ' . $material_obra->stock_actual);
                    // }
                    $material_obra->save();

                    $nuevo_is = IngresoSalida::create([
                        'obra_id' => $solicitud_obra->obra->id,
                        'mo_id' => $material_obra->id,
                        'cantidad' => $cantidad_ingresos[$i],
                        'tipo' => $tipo,
                        'fecha_registro' => $fecha_actual,
                        'estado' => 1
                    ]);

                    $mensaje = 'INGRESO DE ' . $nuevo_is->cantidad . ' ' . $nuevo_is->mo->material->nombre . ' EN LA OBRA ' . $nuevo_is->obra->nombre;
                    $nueva_notificacion = Notificacion::create([
                        'registro_id' => $nuevo_is->id,
                        'tipo'  => 'MATERIAL',
                        'accion' => $tipo,
                        'mensaje' => $mensaje,
                        'fecha' => $fecha_actual,
                        'hora' => date('H:i:s'),
                    ]);

                    $users = User::where('estado', 1)->whereIn('tipo', ['ADMINISTRADOR', 'AUXILIAR'])->get();
                    foreach ($users as $u) {
                        NotificacionUser::create([
                            'notificacion_id' => $nueva_notificacion->id,
                            'user_id' => $u->id,
                            'visto' => 0
                        ]);
                    }
                }
            } else {
                $request->validate([
                    "material_obra_id" => "required",
                    "material_id_salidas" => "required",
                    "cantidad_salidas" => "required",
                ], [
                    "material_obra_id.required" => "Algó esta equivocado en el formulario intente nuevamente",
                    "material_id_salidas.required" => "Algó esta equivocado en el formulario intente nuevamente",
                    "cantidad_salidas.required" => "Debes ingresar la cantidad que saldra de cada material de la lista",
                ]);

                $material_obra_id = $request->material_obra_id;
                $material_id_salidas = $request->material_id_salidas;
                $cantidad_salidas = $request->cantidad_salidas;
                for ($i = 0; $i < count($material_obra_id); $i++) {
                    $material_obra = MaterialObra::where("material_id", $material_id_salidas[$i])
                        ->where("obra_id", $request->obra_id)
                        ->get()->first();
                    if ($cantidad_salidas[$i] <= $material_obra->stock_actual) {
                        $material_obra->stock_actual = (float)$material_obra->stock_actual - $cantidad_salidas[$i];
                    }
                    if ($material_obra->stock_actual < $material_obra->stock_minimo) {
                        $material_obra->estado_stock = 'BAJO';
                    } else {
                        $material_obra->estado_stock = 'NORMAL';
                    }
                    $material_obra->save();
                    $nuevo_is = IngresoSalida::create([
                        'obra_id' => $material_obra->obra->id,
                        'mo_id' => $material_obra->id,
                        'cantidad' => $cantidad_salidas[$i],
                        'tipo' => $tipo,
                        'fecha_registro' => $fecha_actual,
                        'estado' => 1
                    ]);

                    $mensaje = 'SALIDA DE ' . $nuevo_is->cantidad . ' ' . $nuevo_is->mo->material->nombre . ' EN LA OBRA ' . $nuevo_is->obra->nombre;
                    $nueva_notificacion = Notificacion::create([
                        'registro_id' => $nuevo_is->id,
                        'tipo'  => 'MATERIAL',
                        'accion' => $tipo,
                        'mensaje' => $mensaje,
                        'fecha' => $fecha_actual,
                        'hora' => date('H:i:s'),
                    ]);

                    $users = User::where('estado', 1)->whereIn('tipo', ['ADMINISTRADOR', 'AUXILIAR'])->get();
                    foreach ($users as $u) {
                        NotificacionUser::create([
                            'notificacion_id' => $nueva_notificacion->id,
                            'user_id' => $u->id,
                            'visto' => 0
                        ]);
                    }
                }
            }
            DB::commit();
            return redirect()->route('material_obras.index', $request->obra_id)->with('bien', 'Registro realizado con éxito');
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('material_obras.index', $request->obra_id)->with('error', 'Ocurrió un error. ' . $e->getMessage());
        }
    }

    public function edit(MaterialObra $material_obra)
    {
        $obra = Obra::find($material_obra->obra_id);
        $materials = Material::all();
        $array_materials[''] = 'Seleccione...';
        foreach ($materials as $value) {
            $array_materials[$value->id] = $value->nombre;
        }
        return view('material_obras.edit', compact('material_obra', 'obra', 'array_materials'));
    }

    public function update(MaterialObra $material_obra, Request $request)
    {
        $material_obra->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('material_obras.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(MaterialObra $material_obra)
    {
        return 'mostrar cargo';
    }

    public function destroy(MaterialObra $material_obra)
    {
        $obra = $material_obra->obra;
        // reestablecer cantidad de solicitudes
        $solicitud_materials = SolicitudMaterial::select("solicitud_materials.*")
            ->join("solicitud_obras", "solicitud_obras.id", "solicitud_materials.solicitud_obra_id")
            ->where("solicitud_obras.obra_id", $obra->id)
            ->where("solicitud_materials.material_id", $material_obra->material_id)
            ->where("solicitud_materials.cantidad_usada", ">", 0)
            ->get();
        $restante = $material_obra->stock_actual;
        foreach ($solicitud_materials as $sm) {
            if ($sm->cantidad <= $restante) {
                $restante = (float)$restante - (float)$sm->cantidad;
            } else {
                $restante = 0;
            }
            $sm->cantidad_usada = 0;
            $sm->save();
            if ($restante == 0) {
                break;
            }
        }

        foreach ($material_obra->ingresos_salidas as $is) {
            // eliminar notificaciones
            $notificacions = Notificacion::where("registro_id", $is->id)->where("tipo", "MATERIAL")->get();
            foreach ($notificacions as $noti) {
                $noti->notificacions_user()->delete();
                $noti->delete();
            }
            $is->delete();
        }

        $material_obra->delete();
        return redirect()->route('material_obras.index', $obra->id)->with('bien', 'Registro eliminado correctamente');
    }
}
