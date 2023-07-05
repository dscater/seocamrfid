<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Notificacion extends Model
{
    protected $fillable = [
        'registro_id', 'tipo', 'accion',
        'mensaje', 'fecha', 'hora',
    ];

    public function notificacions_user()
    {
        return $this->hasMany(NotificacionUser::class, 'notificacion_id');
    }

    public function material()
    {
        return $this->belongsTo(IngresoSalida::class, 'registro_id');
    }

    public function monitoreo()
    {
        return $this->belongsTo(MonitoreoHerramienta::class, 'registro_id');
    }
}
