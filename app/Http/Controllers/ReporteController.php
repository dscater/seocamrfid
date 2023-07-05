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
use app\Obra;
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
                    if ($tipo != 'todos') {

                        $usuarios = DatosUsuario::select('datos_usuarios.*', 'users.id as user_id', 'users.name as usuario', 'users.tipo', 'users.foto')
                            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
                            ->where('users.estado', 1)
                            ->where('users.tipo', $tipo)
                            ->orderBy('datos_usuarios.nombre', 'ASC')
                            ->get();
                    }
                    break;
            }
        }

        $pdf = PDF::loadView('reportes.usuarios', compact('usuarios'))->setPaper('letter', 'landscape');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('Usuarios.pdf');
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

        $materiales = MaterialObra::select('material_obras.*')->join('obras', 'obras.id', '=', 'material_obras.obra_id')->where('estado', 1)->orderBy('obras.nombre', 'asc')->get();
        if ($obra != 'todos') {
            $materiales = MaterialObra::select('material_obras.*')->join('obras', 'obras.id', '=', 'material_obras.obra_id')->where('estado', 1)->where('obra_id', $obra)->orderBy('obras.nombre', 'asc')->get();
        }

        $pdf = PDF::loadView('reportes.materiales_obras', compact('materiales'))->setPaper('letter', 'portrait');
        // ENUMERAR LAS PÁGINAS USANDO CANVAS
        $pdf->output();
        $dom_pdf = $pdf->getDomPDF();
        $canvas = $dom_pdf->get_canvas();
        $alto = $canvas->get_height();
        $ancho = $canvas->get_width();
        $canvas->page_text($ancho - 90, $alto - 25, "Página {PAGE_NUM} de {PAGE_COUNT}", null, 10, array(0, 0, 0));

        return $pdf->stream('MaterialObras.pdf');
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
}
