<?php

namespace app\Http\Controllers;

use app\Notificacion;
use app\NotificacionUser;
use app\Obra;
use app\ObraPersonal;
use app\SolicitudPersonal;
use app\User;
use Illuminate\Http\Request;

class ObraPersonalController extends Controller
{
    public function index(Obra $obra)
    {
        return view("movimientos.personals", compact("obra"));
    }

    public function asignar(Request $request)
    {
        $solicitud_personal_id = $request->id;
        $solicitud_personal = SolicitudPersonal::find($solicitud_personal_id);
        $obra = $solicitud_personal->solicitud_obra->obra;
        $fecha = date("Y-m-d");
        $obra_personal = $obra->obra_personals()->create([
            "personal_id" => $solicitud_personal->personal_id,
            "solicitud_personal_id" => $solicitud_personal->id,
            "fecha_registro" => $fecha
        ]);
        $mensaje = 'SE REGISTRO EL INGRESO DEL PERSONAL ' . $solicitud_personal->personal->full_name . ' EN LA OBRA ' . $solicitud_personal->solicitud_obra->obra->nombre;
        $nueva_notificacion = Notificacion::create([
            'registro_id' => $obra_personal->personal_id,
            'tipo'  => 'PERSONAL',
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
        $obra_personal_id = $request->id;
        $obra_personal = ObraPersonal::find($obra_personal_id);
        $obra_personal->solicitud_personal->ingreso = 0;
        $obra_personal->solicitud_personal->save();
        $obra_personal->delete();
        $mensaje = 'SE REGISTRO LA SALIDA DEL PERSONAL ' . $obra_personal->personal->full_name . ' EN LA OBRA ' . $obra_personal->obra->nombre;
        $fecha = date("Y-m-d");
        $nueva_notificacion = Notificacion::create([
            'registro_id' => $obra_personal->personal_id,
            'tipo'  => 'PERSONAL',
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
