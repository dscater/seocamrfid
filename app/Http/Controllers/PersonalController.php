<?php

namespace app\Http\Controllers;

use app\Obra;
use app\Personal;
use Illuminate\Http\Request;

class PersonalController extends Controller
{
    public function index()
    {
        $personals = Personal::where('estado', 1)
            ->get();
        return view('personals.index', compact('personals'));
    }

    public function create()
    {
        return view('personals.create');
    }

    public function store(Request $request)
    {
        if (!isset($request->habilitado)) {
            $request["habilitado"] = 0;
        }
        $request['fecha_registro'] = date('Y-m-d');
        $nuevo_personal = new Personal(array_map('mb_strtoupper', $request->all()));
        $nuevo_personal->foto = 'user_default.png';
        $nuevo_personal->estado = 1;
        if ($request->hasFile('foto')) {
            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $nuevo_personal->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/personals/", $nom_foto);
            $nuevo_personal->foto = $nom_foto;
        }
        $nuevo_personal->save();
        return redirect()->route('personals.index')->with('bien', 'personal registrado con éxito');
    }

    public function edit(Personal $personal)
    {
        return view('personals.edit', compact('personal'));
    }

    public function update(Personal $personal, Request $request)
    {
        if (!isset($request->habilitado)) {
            $request["habilitado"] = 0;
        }
        $personal->update(array_map('mb_strtoupper', $request->except('foto')));
        if ($request->hasFile('foto')) {
            // antiguo
            $antiguo = $personal->foto;
            if ($antiguo != 'user_default.png') {
                \File::delete(public_path() . '/imgs/personals/' . $antiguo);
            }

            //obtener el archivo
            $file_foto = $request->file('foto');
            $extension = "." . $file_foto->getClientOriginalExtension();
            $nom_foto = $personal->nombre . time() . $extension;
            $file_foto->move(public_path() . "/imgs/personals/", $nom_foto);
            $personal->foto = $nom_foto;
        }
        $personal->save();
        return redirect()->route('personals.index')->with('bien', 'personal modificado con éxito');
    }

    public function show(Personal $personal)
    {
        return 'mostrar personal';
    }

    public function destroy(Personal $personal)
    {
        $personal->estado = 0;
        $personal->save();
        return redirect()->route('personals.index')->with('bien', 'Registro eliminado correctamente');
    }
}
