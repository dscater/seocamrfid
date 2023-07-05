<?php

namespace app\Http\Controllers;

use app\Herramienta;
use app\MonitoreoHerramienta;
use app\Notificacion;
use app\NotificacionUser;
use app\User;
use Illuminate\Http\Request;

class MonitoreoHerramientaController extends Controller
{
    public function index()
    {
        $herramientas = herramienta::orderBy('nombre', 'asc')->get();
        $monitoreos = MonitoreoHerramienta::orderBy('created_at', 'desc')->get();
        return view('herramientas.monitoreo', compact('herramientas', 'monitoreos'));
    }

    public function getAccion(Request $request)
    {
        $herramienta = Herramienta::where('rfid', $request->rfid)->get()->first();
        $msg = 'bien';
        $accion = '';
        if ($herramienta) {
            $msg = 'bien';
            $accion = 'SALIDA';
            if ($herramienta->estado == 'INGRESO') {
                $accion = 'SALIDA';
            } else {
                $accion = 'INGRESO';
            }
        } else {
            $herramienta = ['id' => 0];
            $msg = 'error';
        }

        return response()->JSON([
            'sw' => true,
            'msg' => $msg,
            'accion' => $accion,
            'herramienta_id' => $herramienta->id
        ]);
    }
    public function registraIS(Request $request)
    {
        $herramienta = Herramienta::find($request->herramienta_id);
        $accion = $request->accion;
        $nuevo_monitoreo = MonitoreoHerramienta::create([
            'herramienta_id' => $herramienta->id,
            'accion' => $accion,
            'fecha_registro' => date('Y-m-d'),
        ]);

        $herramienta->estado = $accion;
        $herramienta->save();

        $mensaje = '';
        if ($accion == 'INGRESO') {
            $mensaje = 'INGRESO DE LA HERRAMIENTA ' . $nuevo_monitoreo->herramienta->nombre;
        } else {
            $mensaje = 'SALIDA DE LA HERRAMIENTA ' . $nuevo_monitoreo->herramienta->nombre;
        }
        $nueva_notificacion = Notificacion::create([
            'registro_id' => $nuevo_monitoreo->id,
            'tipo'  => 'HERRAMIENTA',
            'accion' => $accion,
            'mensaje' => $mensaje,
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
        ]);

        $users = User::where('estado', 1)->whereIn('tipo', ['ADMINISTRADOR', 'AUXILIAR'])->get();
        foreach ($users as $u) {
            NotificacionUser::create([
                'notificacion_id' => $nueva_notificacion->id,
                'user_id' => $u->id,
                'visto' => 0
            ]);
        }

        return response()->JSON([
            'sw' => true,
            'msg' => 'bien',
        ]);
    }

    public function lista_estados(Request $request)
    {
        $herramientas = Herramienta::all();
        $monitoreos = MonitoreoHerramienta::orderBy('created_at', 'desc')->get();
        $lista_is = view('herramientas.parcial.lista_is', compact('monitoreos'))->render();
        return response()->JSON([
            'herramientas' => $herramientas,
            'lista_is' => $lista_is
        ]);
    }
}
