<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class ObraHerramienta extends Model
{
    protected $fillable = [
        "obra_id",
        "herramienta_id",
        "solicitud_herramienta_id",
        "fecha_registro",
        "fecha_fin",
        "estado" // 1 => En uso, 2 => Terminado
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }

    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'herramienta_id');
    }

    public function solicitud_herramienta()
    {
        return $this->belongsTo(SolicitudHerramienta::class, 'solicitud_herramienta_id');
    }

    public function usos()
    {
        return $this->hasOne(ObraHerramientaUso::class, 'obra_herramienta_id');
    }
}
