<?php

namespace app\Http\Controllers;

use app\DatosUsuario;
use Illuminate\Http\Request;
use app\Obra;
use app\Personal;
use Illuminate\Support\Facades\Auth;

class ObraController extends Controller
{
    public function index(Request $request)
    {
        $texto = '';
        if ($request->texto) {
            $texto = $request->texto;
        }
        $obras = [];
        if (Auth::user()->tipo == 'JEFE DE OBRA' || Auth::user()->tipo == 'AUXILIAR') {
            if (Auth::user()->tipo == 'JEFE DE OBRA') {
                $obras = Obra::where('nombre', 'LIKE', "%$texto%")->where("jefe_id", Auth::user()->id)->get();
            } else {
                $obras = Obra::where('nombre', 'LIKE', "%$texto%")->where("auxiliar_id", Auth::user()->id)->get();
            }
        } else {
            $obras = Obra::where('nombre', 'LIKE', "%$texto%")->get();
        }

        if ($request->ajax()) {
            $html = view('obras.parcial.lista', compact('obras'))->render();
            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }
        return view('obras.index', compact('obras'));
    }

    public function create()
    {
        $array_jefes[""] = "Seleccione...";
        $array_auxiliars[""] = "Seleccione...";

        $jefes = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('datos_usuarios.habilitado', 1)
            ->where('users.tipo', "JEFE DE OBRA")
            ->where('users.estado', 1)
            ->get();

        foreach ($jefes as $jefe) {
            $array_jefes[$jefe->user_id] = $jefe->full_name;
        }

        $auxiliars = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('datos_usuarios.habilitado', 1)
            ->where('users.estado', 1)
            ->where('users.tipo', "AUXILIAR")
            ->get();

        foreach ($auxiliars as $auxiliar) {
            $array_auxiliars[$auxiliar->user_id] = $auxiliar->full_name;
        }
        return view('obras.create', compact("array_jefes", "array_auxiliars"));
    }

    public function store(Request $request)
    {
        Obra::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('obras.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Obra $obra)
    {
        $array_jefes[""] = "Seleccione...";
        $array_auxiliars[""] = "Seleccione...";

        $jefes = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('datos_usuarios.habilitado', 1)
            ->where('users.tipo', "JEFE DE OBRA")
            ->where('users.estado', 1)
            ->get();

        foreach ($jefes as $jefe) {
            $array_jefes[$jefe->user_id] = $jefe->full_name;
        }

        $auxiliars = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('datos_usuarios.habilitado', 1)
            ->where('users.estado', 1)
            ->where('users.tipo', "AUXILIAR")
            ->get();

        foreach ($auxiliars as $auxiliar) {
            $array_auxiliars[$auxiliar->user_id] = $auxiliar->full_name;
        }
        return view('obras.edit', compact('obra', "array_jefes", "array_auxiliars"));
    }

    public function update(Obra $obra, Request $request)
    {
        $obra->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('obras.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Obra $obra)
    {
        return 'mostrar cargo';
    }

    public function destroy(Obra $obra)
    {
        $comprueba = Personal::where('obra_id', $obra->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('obras.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $obra->delete();
            return redirect()->route('obras.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
