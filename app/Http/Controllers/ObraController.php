<?php

namespace app\Http\Controllers;

use app\DatosUsuario;
use app\Notificacion;
use app\NotificacionUser;
use Illuminate\Http\Request;
use app\Obra;
use app\Personal;
use app\SolicitudHerramienta;
use app\SolicitudMaterial;
use app\SolicitudObra;
use app\SolicitudPersonal;
use app\User;
use Illuminate\Support\Facades\Auth;

class ObraController extends Controller
{
    public function index(Request $request)
    {
        $texto = '';
        if ($request->texto) {
            $texto = $request->texto;
        }
        $obras = [];
        if (Auth::user()->tipo == 'JEFE DE OBRA' || Auth::user()->tipo == 'AUXILIAR') {
            if (Auth::user()->tipo == 'JEFE DE OBRA') {
                $obras = Obra::where('nombre', 'LIKE', "%$texto%")->where("jefe_id", Auth::user()->id)->get();
            } else {
                $obras = Obra::where('nombre', 'LIKE', "%$texto%")->where("auxiliar_id", Auth::user()->id)->get();
            }
        } else {
            $obras = Obra::where('nombre', 'LIKE', "%$texto%")->get();
        }

        if ($request->ajax()) {
            $html = view('obras.parcial.lista', compact('obras'))->render();
            return response()->JSON([
                'sw' => true,
                'html' => $html
            ]);
        }
        return view('obras.index', compact('obras'));
    }

    public function create()
    {
        $array_jefes[""] = "Seleccione...";
        $array_auxiliars[""] = "Seleccione...";

        $jefes = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('datos_usuarios.habilitado', 1)
            ->where('users.tipo', "JEFE DE OBRA")
            ->where('users.estado', 1)
            ->get();

        foreach ($jefes as $jefe) {
            $array_jefes[$jefe->user_id] = $jefe->full_name;
        }

        $auxiliars = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('datos_usuarios.habilitado', 1)
            ->where('users.estado', 1)
            ->where('users.tipo', "AUXILIAR")
            ->get();

        foreach ($auxiliars as $auxiliar) {
            $array_auxiliars[$auxiliar->user_id] = $auxiliar->full_name;
        }
        return view('obras.create', compact("array_jefes", "array_auxiliars"));
    }

    public function store(Request $request)
    {
        $request["estado"] = "POR INICIAR";
        $request["check_jefe"] = 0;
        $request["check_aux"] = 0;
        Obra::create(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('obras.index')->with('bien', 'Registro realizado con éxito');
    }

    public function edit(Obra $obra)
    {
        $array_jefes[""] = "Seleccione...";
        $array_auxiliars[""] = "Seleccione...";

        $jefes = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('datos_usuarios.habilitado', 1)
            ->where('users.tipo', "JEFE DE OBRA")
            ->where('users.estado', 1)
            ->get();

        foreach ($jefes as $jefe) {
            $array_jefes[$jefe->user_id] = $jefe->full_name;
        }

        $auxiliars = DatosUsuario::select('datos_usuarios.*')
            ->join('users', 'users.id', '=', 'datos_usuarios.user_id')
            ->where('datos_usuarios.habilitado', 1)
            ->where('users.estado', 1)
            ->where('users.tipo', "AUXILIAR")
            ->get();

        foreach ($auxiliars as $auxiliar) {
            $array_auxiliars[$auxiliar->user_id] = $auxiliar->full_name;
        }
        return view('obras.edit', compact('obra', "array_jefes", "array_auxiliars"));
    }

    public function update(Obra $obra, Request $request)
    {
        $obra->update(array_map('mb_strtoupper', $request->all()));
        return redirect()->route('obras.index')->with('bien', 'Registro modificado con éxito');
    }

    public function show(Obra $obra)
    {
        return view('obras.show', compact('obra'));
    }

    public function destroy(Obra $obra)
    {
        $comprueba = Personal::where('obra_id', $obra->id)->get();
        if (count($comprueba) > 0) {
            return redirect()->route('obras.index')->with('info', 'No se pudo eliminar el registro porque esta siendo utilizado');
        } else {
            $obra->delete();
            return redirect()->route('obras.index')->with('bien', 'Registro eliminado correctamente');
        }
    }

    public function cambiaEstado(Obra $obra, Request $request)
    {
        if (Auth::user()->tipo == 'JEFE DE OBRA') {
            $obra->check_jefe = $request->estado;
        }
        if (Auth::user()->tipo == 'AUXILIAR') {
            $obra->check_aux = $request->estado;
        }
        $obra->save();
        return response()->JSON(true);
    }

    public function copiar(Obra $obra, Request $request)
    {
        // crear la obra
        $nueva_obra = new Obra([
            "nombre" => mb_strtoupper($request->nombre),
            "jefe_id" => $obra->jefe_id,
            "auxiliar_id" => $obra->auxiliar_id,
            "fecha_obra" => $obra->fecha_obra,
            "descripcion" => $obra->descripcion,
            "check_jefe" => 0,
            "check_aux" => 0,
            "estado" => "POR INICIAR"
        ]);

        $nueva_obra->save();

        // crear la solicitud de obra
        $nueva_solicitud_obra = SolicitudObra::create([
            "obra_id" => $nueva_obra->id,
            "aprobado" => 0,
            "fecha_registro" => date("Y-m-d")
        ]);

        // solicitud materials
        foreach ($obra->solicitud_obra->solicitud_materials as $sm) {
            $solicitud_material = SolicitudMaterial::create([
                "solicitud_obra_id" => $nueva_solicitud_obra->id,
                "material_id" => $sm->material_id,
                "cantidad" => $sm->cantidad,
                "cantidad_usada" => 0,
                "aprobado" => 0,
            ]);
        }

        // solicitud herramientas
        $no_asignadas = false;
        $herramientas_no_asignadas = "<ul>";

        foreach ($obra->solicitud_obra->solicitud_herramientas as $sh) {
            if (!$sh->herramienta->asignacion_herramienta) {
                $solicitud_herramienta = SolicitudHerramienta::create([
                    "solicitud_obra_id" => $nueva_solicitud_obra->id,
                    "herramienta_id" => $sh->herramienta_id,
                    "dias_uso" => $sh->dias_uso,
                    "fecha_asignacion" => $sh->fecha_asignacion,
                    "fecha_finalizacion" => $sh->fecha_finalizacion,
                    "ingreso" => 0,
                    "aprobado" => 0,
                ]);
            } else {
                $no_asignadas = true;
                $herramientas_no_asignadas .= "<li>" . $sh->herramienta->nombre . "</li>";
            }
        }
        $herramientas_no_asignadas .= "</ul>";

        // solicitud personals
        foreach ($obra->solicitud_obra->solicitud_personals as $sp) {
            $solicitud_personal = SolicitudPersonal::create([
                "solicitud_obra_id" => $nueva_solicitud_obra->id,
                "personal_id" => $sp->personal_id,
                "ingreso" => 0,
                "aprobado" => 0,
            ]);
        }

        // notas
        foreach ($obra->nota_obras as $no) {
            $solicitud_personal = SolicitudPersonal::create([
                "obra_id" => $no->obra_id,
                "nota" => $no->nota,
                "fecha_registro" => date("Y-m-d")
            ]);
        }

        $nueva_notificacion = Notificacion::create([
            'registro_id' => $nueva_solicitud_obra->id,
            'tipo'  => 'SOLICITUD',
            'accion' => "NUEVO",
            'mensaje' => "SE REALZÓ UNA SOLICITUD PARA LA OBRA: " . $nueva_solicitud_obra->obra->nombre,
            'fecha' => date('Y-m-d'),
            'hora' => date('H:i:s'),
        ]);

        $users = User::where('estado', 1)->whereIn('tipo', ["ADMINISTRADOR", "AUXILIAR"])->get();
        foreach ($users as $u) {
            NotificacionUser::create([
                'notificacion_id' => $nueva_notificacion->id,
                'user_id' => $u->id,
                'visto' => 0
            ]);
        }
        return redirect()->route('obras.index')
            ->with('no_asignadas', $no_asignadas ? "si" : "no")
            ->with('herramientas_no_asignadas', $herramientas_no_asignadas)
            ->with('bien', 'Copia realizada con éxito');
    }
}
