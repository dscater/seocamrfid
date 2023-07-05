<?php

namespace app\Http\Controllers;

use app\IngresoSalida;
use app\Material;
use Illuminate\Http\Request;
use app\MaterialObra;
use app\Notificacion;
use app\NotificacionUser;
use app\Obra;
use app\User;
use Illuminate\Support\Facades\Auth;

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
        $tipo = $request->tipo;
        $material = Material::find($request->material_id);
        $existe = MaterialObra::where('material_id', $request->material_id)
            ->where('obra_id', $request->obra_id)
            ->get()
            ->first();
        if ($existe) {
            if ($tipo == 'SALIDA') {
                if ($request->cantidad <= $existe->stock_actual) {
                    $existe->stock_actual = $existe->stock_actual - $request->cantidad;
                } else {
                    return redirect()->back()->with('error', 'Error! La cantidad supera el stock actual, intente nuevamente');
                }
            } else {
                $existe->stock_actual = $request->cantidad + $existe->stock_actual;
            }
            $existe->save();
        } else {
            if ($tipo == 'SALIDA') {
                // debe existir el registro
                return redirect()->back()->with('error', 'Error! No se encontró/asigno el material seleccionado, intente nuevamente');
            } else {
                $nuevo = MaterialObra::create(array_map('mb_strtoupper', [
                    'material_id' => $material->id,
                    'stock_minimo' => $material->stock_minimo,
                    'stock_actual' => $request->cantidad,
                    'estado_stock' => 'NORMAL',
                    'obra_id' => $request->obra_id,
                    'fecha_registro' => date('Y-m-d'),
                    'estado' => 1
                ]));
                $existe = $nuevo;
            }
        }

        $existe->estado_stock = 'NORMAL';
        if ($existe->stock_actual <= $existe->stock_minimo) {
            $existe->estado_stock = 'BAJO';
        }
        $existe->save();

        $nuevo_is = IngresoSalida::create([
            'obra_id' => $request->obra_id,
            'mo_id' => $existe->id,
            'cantidad' => $request->cantidad,
            'tipo' => $request->tipo,
            'fecha_registro' => date('Y-m-d'),
            'estado' => 1
        ]);

        $mensaje = '';
        if ($request->tipo == 'INGRESO') {
            $mensaje = 'INGRESO DE ' . $nuevo_is->cantidad . ' ' . $nuevo_is->mo->material->nombre . ' EN LA OBRA ' . $nuevo_is->obra->nombre;
        } else {
            $mensaje = 'SALIDA DE ' . $nuevo_is->cantidad . ' ' . $nuevo_is->mo->material->nombre . ' EN LA OBRA ' . $nuevo_is->obra->nombre;
        }
        $nueva_notificacion = Notificacion::create([
            'registro_id' => $nuevo_is->id,
            'tipo'  => 'MATERIAL',
            'accion' => $request->tipo,
            'mensaje' => $mensaje,
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
        ]);

        $users = User::where('estado', 1)->where('tipo', '!=', 'CONTROL')->get();
        foreach ($users as $u) {
            NotificacionUser::create([
                'notificacion_id' => $nueva_notificacion->id,
                'user_id' => $u->id,
                'visto' => 0
            ]);
        }

        return redirect()->route('material_obras.index', $request->obra_id)->with('bien', 'Registro realizado con éxito');
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
        foreach ($material_obra->ingresos_salidas as $is) {
            $is->estado = 0;
            $is->save();
        }

        $material_obra->estado = 0;
        $material_obra->save();
        return redirect()->route('material_obras.index', $material_obra->obra->id)->with('bien', 'Registro eliminado correctamente');
    }
}
