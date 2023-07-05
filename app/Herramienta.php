<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    protected $fillable = [
        'nombre', 'rfid', 'descripcion', 'estado', 'fecha_registro',
    ];
    public function monitoreos()
    {
        return $this->hasMany(MonitoreoHerramienta::class, 'herramienta_id');
    }
}
