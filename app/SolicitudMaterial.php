<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class SolicitudMaterial extends Model
{
    protected $fillable = [
        "solicitud_obra_id",
        "material_id",
        "cantidad",
        "cantidad_usada",
        "aprobado_admin",
        "aprobado_aux"
    ];

    protected $appends = ["disponible"];

    public function getDisponibleAttribute()
    {
        return $this->cantidad - $this->cantidad_usada;
    }
    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
