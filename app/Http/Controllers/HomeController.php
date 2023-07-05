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
            ->whereIn('users.tipo', ['ADMINISTRADOR', 'AUXILIAR'])
            ->get());

        $personals = count(Personal::where('estado', 1)->get());

        $obras = count(Obra::all());

        $_obras = Obra::all();

        $herramientas = count(Herramienta::all());

        return view('home', compact('usuarios', 'personals', 'obras', 'herramientas', '_obras'));
    }
}
