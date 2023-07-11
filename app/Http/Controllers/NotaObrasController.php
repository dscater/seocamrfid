<?php

namespace app\Http\Controllers;

use app\NotaObras;
use app\Obra;
use Illuminate\Http\Request;

class NotaObrasController extends Controller
{
    public function index(Obra $obra)
    {
        $nota_obras = $obra->nota_obras;
        return view('nota_obras.index', compact('nota_obras', 'obra'));
    }

    public function create(Obra $obra)
    {
        return view('nota_obras.create', compact("obra"));
    }

    public function store(Obra $obra, Request $request)
    {
        $request["fecha_registro"] = date("Y-m-d");
        $obra->nota_obras()->create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('nota_obras.index', $obra->id)->with('bien', 'Registro realizado con éxito');
    }

    public function edit(NotaObras $nota_obra)
    {
        $obra = $nota_obra->obra;
        return view('nota_obras.edit', compact('nota_obra', "obra"));
    }

    public function update(NotaObras $nota_obra, Request $request)
    {
        $nota_obra->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('nota_obras.index', $nota_obra->obra->id)->with('bien', 'Registro modificado con éxito');
    }

    public function show(NotaObras $nota_obra)
    {
        return view('nota_obras.show', compact('nota_obra'));
    }

    public function destroy(NotaObras $nota_obra)
    {
        $obra = $nota_obra->obra;
        $nota_obra->delete();
        return redirect()->route('nota_obras.index', $obra->id)->with('bien', 'Registro eliminado correctamente');
    }
}
