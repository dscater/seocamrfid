<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use Barryvdh\DomPDF\Facade as PDF;
use app\DatosUsuario;
use app\Herramienta;
use app\IngresoSalida;
use app\Material;
use app\MaterialObra;
use app\MonitoreoHerramienta;
use app\NotaObras;
use app\Obra;
use app\ObraHerramienta;
use app\ObraPersonal;
use app\Personal;

class ReporteController extends Controller
{
    public function index()
    {
        $personals = Personal::where('estado', 1)->get();
        $obras = Obra::all();
        $herramientas = Herramienta::all();
        return view('reportes.index', compact('personals', 'obras', 'herramientas'));
    }

    public function usuarios(Request $request)
    {
        $filtro = $request->filtro;

        $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.tipo', 'users.foto')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('users.estado', 1)
            ->orderBy('datos_usuarios.nombre', 'ASC')
            ->get();

        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'tipo':
                    $tipo = $request->tipo;
                    $usuario = $request->usuario;
                    if ($tipo != 'todos') {
                        $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.tipo', 'users.foto')
                            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                            ->where('users.estado', 1)
                            ->where('users.tipo', $tipo)
                            ->where('users.id', $usuario)
                            ->orderBy('datos_usuarios.nombre', 'ASC')
                            ->get();
                    }
                    break;
                case 'usuario':
                    $usuario = $request->usuario;
                    if ($usuario != 'todos') {
                        $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.tipo', 'users.foto')
                            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                            ->where('users.estado', 1)
                            ->where('users.id', $usuario)
                            ->orderBy('datos_usuarios.nombre', 'ASC')
                            ->get();
                    }
                    break;
            }
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('HistorialUsuario.pdf');
    }

    public function personal(Request $request)
    {
        $filtro = $request->filtro;
        $obra = $request->obra;

        $personals = Personal::where('estado', 1)->get();
        if ($filtro == 'obra') {
            if ($obra != 'todos') {
                $personals = Personal::where('estado', 1)->where('obra_id', $obra)->get();
            }
        }

        $pdf = PDF::loadView('reportes.personal', compact('personals'))->setPaper('legal', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Personal.pdf');
    }

    public function materiales_obras(Request $request)
    {
        $obra = $request->obra;

        $materiales = MaterialObra::select('material_obras.*')->join('obras', 'obras.id', '=', 'material_obras.obra_id')->where('material_obras.estado', 1)->orderBy('obras.nombre', 'asc')->get();
        if ($obra != 'todos') {
            $materiales = MaterialObra::select('material_obras.*')->join('obras', 'obras.id', '=', 'material_obras.obra_id')->where('material_obras.estado', 1)->where('obra_id', $obra)->orderBy('obras.nombre', 'asc')->get();
        }
        $obras = Obra::all();
        if ($obra != "todos") {
            $obras = Obra::where("id", $obra)->get();
        }
        $pdf = PDF::loadView('reportes.materiales_obras', compact('obras'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('MaterialObras.pdf');
    }

    public function g_materiales_obras()
    {
        $_obras = Obra::all();
        return view("reportes.g_materiales_obras", compact("_obras"));
    }
    public function obrasMateriales(Request $request)
    {
        $obra = $request->obra;
        $obras = Obra::all();
        if ($obra != 'todos') {
            $obras = Obra::where('id', $obra)->get();
        }
        $materials = Material::all();
        $categorias = [];
        foreach ($obras as $o) {
            $categorias[] = $o->nombre;
        }

        foreach ($materials as $m) {
            $contenedor_series[$m->id] = [
                'name' => $m->nombre,
                'data' => [],
                'dataLabels' => [
                    'enabled' => true,
                    'rotation' => -90,
                    'color' => '#FFFFFF',
                    'align' => 'right',
                    'format' => '{point.y:.0f}', // one decimal
                    'y' => 10, // 10 pixels down from the top
                    'style' => [
                        'fontSize' => '13px',
                        'fontFamily' => 'Verdana, sans-serif'
                    ]
                ],
            ];
            foreach ($obras as $o) {
                $material_obra = MaterialObra::where('obra_id', $o->id)->where('material_id', $m->id)->get()->first();
                if ($material_obra) {
                    $contenedor_series[$m->id]['data'][] = (float)$material_obra->stock_actual;
                } else {
                    $contenedor_series[$m->id]['data'][] = 0;
                }
            }
        }

        $series = [];
        foreach ($contenedor_series as $val) {
            $series[] = $val;
        }


        $fecha = date('d/m/Y');
        return response()->JSON([
            'sw' => true,
            'categorias' => $categorias,
            'series' => $series,
            'fecha' => $fecha
        ]);
    }
    public function infoMateriales(Request $request)
    {
        $obra = $request->obra;
        $obras = Obra::all();
        if ($obra != 'todos') {
            $obras = Obra::where('id', $obra)->get();
        }
        $materials = Material::all();
        $categorias = [];
        foreach ($obras as $o) {
            $categorias[] = $o->nombre;
        }

        foreach ($materials as $m) {
            $contenedor_series[$m->id] = [
                'name' => $m->nombre,
                'data' => [],
                'dataLabels' => [
                    'enabled' => true,
                    'rotation' => -90,
                    'color' => '#FFFFFF',
                    'align' => 'right',
                    'format' => '{point.y:.0f}', // one decimal
                    'y' => 10, // 10 pixels down from the top
                    'style' => [
                        'fontSize' => '13px',
                        'fontFamily' => 'Verdana, sans-serif'
                    ]
                ],
            ];
            foreach ($obras as $o) {
                $material_obra = MaterialObra::where('obra_id', $o->id)->where('material_id', $m->id)->get()->first();
                if ($material_obra) {
                    $contenedor_series[$m->id]['data'][] = (float)$material_obra->stock_actual;
                } else {
                    $contenedor_series[$m->id]['data'][] = 0;
                }
            }
        }

        $series = [];
        foreach ($contenedor_series as $val) {
            $series[] = $val;
        }


        $fecha = date('d/m/Y');
        return response()->JSON([
            'sw' => true,
            'categorias' => $categorias,
            'series' => $series,
            'fecha' => $fecha
        ]);
    }

    public function ingresos_salidas(Request $request)
    {
        $filtro = $request->filtro;
        $obra = $request->obra;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $ingresos_salidas = IngresoSalida::where('estado', 1)->orderBy('created_at', 'desc')->get();
        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'obra':
                    if ($obra != 'todos') {
                        $ingresos_salidas = IngresoSalida::where('estado', 1)->where('obra_id', $obra)->orderBy('created_at', 'desc')->get();
                    }
                    break;
                case 'fecha':
                    $ingresos_salidas = IngresoSalida::where('estado', 1)->whereBetween('fecha_registro', [$fecha_ini, $fecha_fin])->orderBy('created_at', 'desc')->get();
                    break;
            }
        }

        $pdf = PDF::loadView('reportes.ingresos_salidas', compact('ingresos_salidas'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('IngresosSalidasMateriales.pdf');
    }

    public function monitoreo(Request $request)
    {
        $filtro = $request->filtro;
        $herramienta = $request->herramienta;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $herramientas = Herramienta::all();
        if ($filtro != 'todos') {
            switch ($filtro) {
                case 'herramienta':
                    if ($herramienta != 'todos') {
                        $herramientas = Herramienta::where('id', $herramienta)->get();
                    }
                    break;
            }
        }

        $ingresos_salidas = [];
        foreach ($herramientas as $h) {
            $monitoreo = MonitoreoHerramienta::where('herramienta_id', $h->id)->orderBy('created_at', 'desc')->get();
            if ($filtro == 'fecha') {
                $monitoreo = MonitoreoHerramienta::where('herramienta_id', $h->id)->whereBetween('fecha_registro', [$fecha_ini, $fecha_fin])->orderBy('created_at', 'desc')->get();
            }
            $ingresos_salidas[$h->id] = $monitoreo;
        }

        $pdf = PDF::loadView('reportes.monitoreo', compact('herramientas', 'ingresos_salidas'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('MonitoreoHerramientas.pdf');
    }

    public function g_monitoreo(Request $request)
    {
        $herramientas = Herramienta::all();
        return view("reportes.g_monitoreo", compact("herramientas"));
    }

    public function monitoreoInfo(Request $request)
    {
        $herramienta = $request->herramienta;
        $fecha = date('d/m/Y');

        $herramientas = Herramienta::all();
        if ($herramienta != "todos") {
            $herramientas = Herramienta::where("id", $herramienta)->get();
        }
        $series = [
            "name" => "DÍAS DE USO",
            "data" => [],
        ];
        foreach ($herramientas as $h) {
            $series["data"][] = [
                "name" => $h->nombre,
                "y" => (float)(number_format(($h->tiempo_uso / 24), 2, ".", "")),
            ];
        }
        return response()->JSON([
            'sw' => true,
            'series' => $series,
            'fecha' => $fecha
        ]);
    }

    public function obras(Request $request)
    {
        $filtro = $request->filtro;
        $obra = $request->obra;
        $fecha_ini = $request->fecha_ini;
        $fecha_fin = $request->fecha_fin;

        $obras = Obra::all();

        if ($filtro != "todos") {
            if ($filtro == "obra" && $obra != "todos") {
                $obras = Obra::where("id", $obra)->get();
            }
            if ($filtro == "fecha" && $fecha_ini && $fecha_fin) {
                $obras = Obra::whereBetween("fecha_obra", [$fecha_ini, $fecha_fin])->get();
            }
        }

        $pdf = PDF::loadView('reportes.obras', compact('obras'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Obras.pdf');
    }

    public function g_obras(Request $request)
    {
        $obras = Obra::all();
        return view("reportes.g_obras", compact("obras"));
    }

    public function obrasInfo(Request $request)
    {
        $obra = $request->obra;
        $obras = Obra::all();
        if ($obra != 'todos') {
            $obras = Obra::where('id', $obra)->get();
        }
        $categorias = [];
        foreach ($obras as $o) {
            $categorias[] = $o->nombre;
        }
        $serie = ["MATERIALES", "HERRAMIENTAS", "PERSONAL", "NOTAS"];
        foreach ($serie as $m) {
            $nueva_serie = [
                'name' => $m,
                'data' => [],
            ];
            foreach ($obras as $o) {
                switch ($m) {
                    case "MATERIALES":
                        $material_obra = count(MaterialObra::where('obra_id', $o->id)->get());
                        $nueva_serie['data'][] = (float)$material_obra;
                        break;
                    case "HERRAMIENTAS":
                        $material_obra = count(ObraHerramienta::where('obra_id', $o->id)->get());
                        $nueva_serie['data'][] = (float)$material_obra;
                        break;
                    case "PERSONAL":
                        $material_obra = count(ObraPersonal::where('obra_id', $o->id)->get());
                        $nueva_serie['data'][] = (float)$material_obra;
                        break;
                    case "NOTAS":
                        $material_obra = count(NotaObras::where('obra_id', $o->id)->get());
                        $nueva_serie['data'][] = (float)$material_obra;
                        break;
                }
            }
            $series[] = $nueva_serie;
        }

        $fecha = date('d/m/Y');
        return response()->JSON([
            'sw' => true,
            'categorias' => $categorias,
            'series' => $series,
            'fecha' => $fecha
        ]);
    }
}
