<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\material;
use app\MaterialObra;

class MaterialController extends Controller
{
    public function index()
    {
        $materials = material::all();
        return view('materials.index', compact('materials'));
    }

    public function create()
    {
        return view('materials.create');
    }

    public function store(Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        material::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('materials.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(material $material)
    {
        return view('materials.edit', compact('material'));
    }

    public function update(material $material, Request $request)
    {
        $material->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('materials.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(material $material)
    {
        return 'mostrar cargo';
    }

    public function destroy(material $material)
    {
        $comprueba = MaterialObra::where('material_id', $material->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('materials.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $material->delete();
            return redirect()->route('materials.index')->with('bien', 'Registro eliminado correctamente');
        }
    }
}
