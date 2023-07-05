<?php

namespace app\Http\Controllers;

use Illuminate\Http\Request;
use app\herramienta;
use app\MonitoreoHerramienta;
use app\Notificacion;
use app\NotificacionUser;
use app\User;

class HerramientaController extends Controller
{
    public function index()
    {
        $herramientas = herramienta::all();
        return view('herramientas.index', compact('herramientas'));
    }

    public function create()
    {
        return view('herramientas.create');
    }

    public function store(Request $request)
    {
        $request['fecha_registro'] = date('Y-m-d');
        $request['estado'] = 'INGRESO';
        $nueva_herramienta = herramienta::create(array_map('mb_strtoupper', $request->all()));
        $nuevo_monitoreo = MonitoreoHerramienta::create([
            'herramienta_id' => $nueva_herramienta->id,
            'accion' => 'INGRESO',
            'fecha_registro' => date('Y-m-d')
        ]);

        $mensaje = 'INGRESO DE LA HERRAMIENTA ' . $nuevo_monitoreo->herramienta->nombre;
        $nueva_notificacion = Notificacion::create([
            'registro_id' => $nuevo_monitoreo->id,
            'tipo'  => 'HERRAMIENTA',
            'accion' => 'INGRESO',
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
        return redirect()->route('herramientas.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(herramienta $herramienta)
    {
        return view('herramientas.edit', compact('herramienta'));
    }

    public function update(herramienta $herramienta, Request $request)
    {
        $herramienta->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('herramientas.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(herramienta $herramienta)
    {
        return 'mostrar cargo';
    }

    public function destroy(herramienta $herramienta)
    {
        $herramienta->delete();
        return redirect()->route('herramientas.index')->with('bien', 'Registro eliminado correctamente');
    }
}
