<?php

namespace app\Http\Controllers;

use app\Herramienta;
use app\Material;
use app\Obra;
use app\Personal;
use app\SolicitudObra;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class SolicitudObraController extends Controller
{
    public function index()
    {
        $solicitud_obras = [];
        if (Auth::user()->tipo == 'AUXILIAR') {
            $solicitud_obras = SolicitudObra::select("solicitud_obras.*")
                ->join("obras", "obras.id", "=", "solicitud_obras.obra_id")
                ->where("obras.auxiliar_id", Auth::user()->id)
                ->get();
        } else {
            $solicitud_obras = SolicitudObra::all();
        }

        return view("solicitud_obras.index", compact("solicitud_obras"));
    }

    public function solicitudes_obra(Obra $obra)
    {
        $solicitud_obras = SolicitudObra::where("obra_id", $obra->id)->get();

        return view("solicitud_obras.solicitudes_obra", compact("solicitud_obras", "obra"));
    }

    public function show(SolicitudObra $solicitud_obra)
    {
        return $solicitud_obra;
    }

    public function create(Obra $obra)
    {
        $materiales = Material::all();
        $herramientas = Herramienta::all();
        $personals = Personal::where("estado", 1)->get();
        return view("solicitud_obras.create", compact("obra", "materiales", "herramientas", "personals"));
    }

    public function store(Obra $obra, Request $request)
    {
        $request->validate([
            "materials" => "required",
        ], [
            "materials.required" => "Debes ingresar al menos un material"
        ]);
        return $request;
    }
}
