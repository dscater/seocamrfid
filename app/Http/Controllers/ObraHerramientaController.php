<?php

namespace app\Http\Controllers;

use app\Obra;
use Illuminate\Http\Request;

class ObraHerramientaController extends Controller
{
    public function index(Obra $obra)
    {
        return view("movimientos.herramientas", compact("obra"));
    }
}
