<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class SolicitudMaterial extends Model
{
    protected $fillable = [
        "solicitud_obra_id",
        "material_id",
        "cantidad",
        "aprobado"
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
