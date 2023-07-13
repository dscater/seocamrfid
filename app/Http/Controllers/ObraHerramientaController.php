<?php

namespace app\Http\Controllers;

use app\Notificacion;
use app\NotificacionUser;
use app\Obra;
use app\ObraHerramienta;
use app\SolicitudHerramienta;
use app\User;
use Illuminate\Http\Request;

class ObraHerramientaController extends Controller
{
    public function index(Obra $obra)
    {
        return view("movimientos.herramientas", compact("obra"));
    }

    public function finalizar(Request $request)
    {
        $obra_herramienta_id = $request->id;
        $obra_herramienta = ObraHerramienta::find($obra_herramienta_id);
        if ($obra_herramienta->herramienta->estado == 'INGRESO') {
            $obra_herramienta->fecha_fin = date("Y-m-d");
            $obra_herramienta->estado = 2;
            return response()->JSON([
                "sw" => true
            ]);
        } else {
            return response()->JSON([
                "sw" => false,
                "message" => "No es posible completar la operación debido a que la herramienta se encuentra fuera del Almacén"
            ]);
        }
    }

    public function asignar(Request $request)
    {
        $solicitud_herramienta_id = $request->id;
        $solicitud_herramienta = SolicitudHerramienta::find($solicitud_herramienta_id);
        $obra = $solicitud_herramienta->solicitud_obra->obra;
        $fecha = date("Y-m-d");
        $obra_herramienta = $obra->obra_herramientas()->create([
            "herramienta_id" => $solicitud_herramienta->herramienta_id,
            "solicitud_herramienta_id" => $solicitud_herramienta->id,
            "fecha_registro" => $fecha,
            "fecha_fin" => null,
            "estado" => 1
        ]);
        
        $mensaje = 'SE REGISTRO EL INGRESO DE LA HERRAMIENTA ' . $solicitud_herramienta->herramienta->herramienta . ' EN LA OBRA ' . $solicitud_herramienta->solicitud_obra->obra->nombre;
        $nueva_notificacion = Notificacion::create([
            'registro_id' => $obra_herramienta->herramienta_id,
            'tipo'  => 'HERRAMIENTA OBRA',
            'accion' => "INGRESO",
            'mensaje' => $mensaje,
            'fecha' => $fecha,
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

        return response()->JSON(true);
    }

    public function destroy(Request $request)
    {
        $obra_herramienta_id = $request->id;
        $obra_herramienta = ObraHerramienta::find($obra_herramienta_id);
        $obra_herramienta->solicitud_herramienta->ingreso = 0;
        $obra_herramienta->solicitud_herramienta->save();
        $mensaje = 'SE REGISTRO LA SALIDA DE LA HERRAMIENTA ' . $obra_herramienta->herramienta->herramienta . ' EN LA OBRA ' . $obra_herramienta->obra->nombre;
        $obra_herramienta->delete();
        $fecha = date("Y-m-d");
        $nueva_notificacion = Notificacion::create([
            'registro_id' => $obra_herramienta->herramienta_id,
            'tipo'  => 'HERRAMIENTA OBRA',
            'accion' => "SALIDA",
            'mensaje' => $mensaje,
            'fecha' => $fecha,
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
        return response()->JSON(true);
    }
}
