<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class SolicitudNota extends Model
{
    protected $fillable = [
        "solicitud_obra_id",
        "nota",
    ];
}
