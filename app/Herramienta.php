<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    protected $fillable = [
        'nombre', 'rfid', 'descripcion', 'estado', 'foto', 'fecha_registro',
    ];
    protected $appends = ["url_foto"];
    
    public function getUrlFotoAttribute()
    {
        return asset("imgs/herramientas/" . ($this->foto ? $this->foto : 'default.png'));
    }

    public function monitoreos()
    {
        return $this->hasMany(MonitoreoHerramienta::class, 'herramienta_id');
    }
}
