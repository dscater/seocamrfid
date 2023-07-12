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

    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'herramienta_id');
    }
}
