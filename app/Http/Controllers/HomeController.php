<?php

namespace app\Http\Controllers;

use app\Herramienta;
use app\MaterialObra;
use app\Obra;
use Illuminate\Http\Request;

use Illuminate\Support\Facades\Auth;
use app\User;
use app\RazonSocial;
use app\Personal;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $empresa = RazonSocial::first();
        if (Auth::user()->tipo == 'CONTROL') {
            return view('layouts.control', compact('empresa'));
        }

        $usuarios = count(User::select('users.*')
            ->join('datos_usuarios', 'datos_usuarios.user_id', '=', 'users.id')
            ->where('users.estado', 1)
            ->get());

        $personals = count(Personal::where('estado', 1)->get());

        $obras = Obra::all();
        if (Auth::user()->tipo == 'JEFE DE OBRA' || Auth::user()->tipo == 'AUXILIAR') {
            if (Auth::user()->tipo == 'JEFE DE OBRA') {
                $obras = Obra::where("jefe_id", Auth::user()->id)->get();
            } else {
                $obras = Obra::where("auxiliar_id", Auth::user()->id)->get();
            }
        }

        $obras = count($obras);

        $_obras = Obra::all();

        if (Auth::user()->tipo == 'JEFE DE OBRA' || Auth::user()->tipo == 'AUXILIAR') {
            if (Auth::user()->tipo == 'JEFE DE OBRA') {
                $_obras = Obra::where("jefe_id", Auth::user()->id)->get();
            } else {
                $_obras = Obra::where("auxiliar_id", Auth::user()->id)->get();
            }
        }

        $herramientas = count(Herramienta::all());

        return view('home', compact('usuarios', 'personals', 'obras', 'herramientas', '_obras'));
    }
}
