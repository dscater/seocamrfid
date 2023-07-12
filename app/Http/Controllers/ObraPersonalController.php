<?php

namespace app\Http\Controllers;

use app\Obra;
use Illuminate\Http\Request;

class ObraPersonalController extends Controller
{
    public function index(Obra $obra)
    {
        return view("movimientos.personals", compact("obra"));
    }
}
