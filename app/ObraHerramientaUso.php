<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class ObraHerramientaUso extends Model
{
    protected $fillable = [
        "obra_id",
        "obra_herramienta_id",
        "herramienta_id",
        "total_almacen",
        "total_uso",
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_herramienta_id');
    }

    public function obra_herramienta()
    {
        return $this->belongsTo(ObraHerramienta::class, 'obra_herramienta_id');
    }

    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'herramienta_id');
    }
}
