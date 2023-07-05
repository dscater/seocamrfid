<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\Obra;
use app\Personal;

class ObraController extends Controller
{
    public function index(Request $request)
    {
        $texto = '';
        if ($request->texto) {
            $texto = $request->texto;
        }
        $obras = Obra::where('nombre', 'LIKE', "%$texto%")->get();
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
        return view('obras.create');
    }

    public function store(Request $request)
    {
        Obra::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('obras.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Obra $obra)
    {
        return view('obras.edit', compact('obra'));
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
