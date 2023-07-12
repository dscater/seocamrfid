<?php

namespace app\Http\Controllers;

use app\Obra;
use Illuminate\Http\Request;

class MovimientoController extends Controller
{
    public function index(Obra $obra)
    {
        return view("movimientos.index", compact("obra"));
    }
}
