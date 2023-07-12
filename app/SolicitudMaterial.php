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
        "aprobado",
    ];

    protected $appends = ["disponible"];

    public function getDisponibleAttribute()
    {
        return $this->cantidad - $this->cantidad_usada;
    }
    public function solicitud_obra()
    {
        return $this->belongsTo(SolicitudObra::class, 'solicitud_obra_id');
    }

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }
}
