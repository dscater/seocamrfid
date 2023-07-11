<?php

namespace app\Http\Controllers;

use app\MaterialObra;
use app\NotificacionUser;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class NotificacionController extends Controller
{
    public function index()
    {
        $notificacions = NotificacionUser::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')->get();

        // MARCAR COMO VISTO LOS QUE AUN NO ESTAN
        $notificacions_noVistos = NotificacionUser::where('user_id', Auth::user()->id)
            ->where('visto', 0)->get();

        foreach ($notificacions_noVistos as $value) {
            $value->visto = 1;
            $value->save();
        }

        return view('notificacions.index', compact('notificacions'));
    }

    public function show(NotificacionUser $notificacion)
    {
        $notificacion->visto = 1;
        $notificacion->save();
        return view('notificacions.show', compact('notificacion'));
    }

    public function notificacionUser(Request $request)
    {
        $notificacions = NotificacionUser::where('user_id', Auth::user()->id)
            ->orderBy('created_at', 'DESC')->get();

        // MARCAR COMO VISTO LOS QUE AUN NO ESTAN
        $notificacions_noVistos = NotificacionUser::where('user_id', Auth::user()->id)
            ->where('visto', 0)->get();

        $total = count($notificacions);
        $sinVer = count($notificacions_noVistos);
        $html = '';

        foreach ($notificacions as $value) {
            $visto = 'visto';
            $icono = 'arrow-left'; //SALIENDO
            if ($value->notificacion->accion == 'INGRESO') {
                $icono = 'arrow-right'; //ENTRANDO
            }

            if ($value->visto == 0) {
                $visto = 'novisto';
            }

            $html .= '<a href="' . route('notificacions.show', $value->id) . '" class="dropdown-item ' . $visto . '">
                        <i class="fas fa-' . $icono . ' mr-2"></i> ' . $value->notificacion->mensaje . '
                        <span class="float-right text-muted text-sm"></span>
                    </a>
                    <div class="dropdown-divider"></div>';
        }


        return response()->JSON([
            'sw' => true,
            'sinVer' => $sinVer,
            'html' => $html,
            'total' => $total,
        ]);
    }
}
