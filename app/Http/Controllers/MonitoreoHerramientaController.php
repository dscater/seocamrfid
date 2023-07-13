<?php

namespace app\Http\Controllers;

use app\Herramienta;
use app\MonitoreoHerramienta;
use app\Notificacion;
use app\NotificacionUser;
use app\ObraHerramientaUso;
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
            'hora' => date('H:i'),
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

        // REGISTRAR USO
        // si tiene una obra asignada
        if ($herramienta->asignacion_herramienta) {
            $existe_uso = ObraHerramientaUso::where("obra_herramienta_id", $herramienta->asignacion_herramienta->id)
                ->get()->first();
            if (!$existe_uso) {
                // inicializar el uso
                $existe_uso = ObraHerramientaUso::create([
                    "obra_id" => $herramienta->asignacion_herramienta->obra_id,
                    "obra_herramienta_id" => $herramienta->asignacion_herramienta->id,
                    "herramienta_id" => $herramienta->asignacion_herramienta->herramienta_id,
                    "total_almacen" => 0, //INGRESO
                    "total_uso" => 0, //SALIDA
                ]);
            }

            // usar el $nuevo_monitoreo para la fecha y hora
            if ($herramienta->estado == 'SALIDA') {
                // sumar como ALMACEN
                if ($existe_uso->total_uso > 0) {
                    $ultimo_ingreso = Herramienta::getUltimoIngreso($herramienta->id);
                    $total_horas = Herramienta::horasTranscurridas($ultimo_ingreso->fecha_registro, $ultimo_ingreso->hora, $nuevo_monitoreo->fecha_registro, $nuevo_monitoreo->hora);
                    $existe_uso->total_almacen += (float)$existe_uso->total_almacen + $total_horas;
                }
            } else {
                // sumar como USO
                $ultima_salida = Herramienta::getUltimaSalida($herramienta->id);
                $total_horas = Herramienta::horasTranscurridas($ultima_salida->fecha_registro, $ultima_salida->hora, $nuevo_monitoreo->fecha_registro, $nuevo_monitoreo->hora);
                $existe_uso->total_uso += (float)$existe_uso->total_uso + $total_horas;
            }
        }

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
