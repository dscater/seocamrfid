<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class ObraHerramienta extends Model
{
    protected $fillable = [
        "obra_id",
        "herramienta_id",
        "fecha_registro",
    ];
}
