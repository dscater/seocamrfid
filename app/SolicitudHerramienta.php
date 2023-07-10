<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class SolicitudHerramienta extends Model
{
    protected $fillable = [
        "solicitud_obra_id",
        "herramienta_id",
        "dias_uso",
        "fecha_asignacion",
        "fecha_finalización",
    ];
}
