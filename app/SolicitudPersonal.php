<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class SolicitudPersonal extends Model
{
    protected $fillable = [
        "solicitud_obra_id",
        "personal_id",
    ];
}
