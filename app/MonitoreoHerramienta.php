<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class MonitoreoHerramienta extends Model
{
    protected $fillable = [
        'herramienta_id', 'accion', 'fecha_registro', 'hora',
    ];

    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'herramienta_id');
    }

    public function notificacions()
    {
        return $this->hasMany(Notificacion::class, 'registro_id');
    }
}
