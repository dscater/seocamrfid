<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class SolicitudObra extends Model
{
    protected $fillable = [
        "obra_id",
        "aprobado",
        "fecha_registro",
    ];

    protected $appends = ["c_material", "c_herramientas", "c_personal", "aprobado_txt"];

    public function getCMaterialAttribute()
    {
        return count($this->solicitud_materials);
    }
    public function getCHerramientasAttribute()
    {
        return count($this->solicitud_herramientas);
    }
    public function getCPersonalAttribute()
    {
        return count($this->solicitud_personals);
    }
    public function getAprobadoTxtAttribute()
    {
        return $this->aprobado ? "SI" : "NO";
    }

    // RELACIONES
    public function solicitud_materials()
    {
        return $this->hasMany(SolicitudMaterial::class, 'solicitud_obra_id');
    }
    public function solicitud_herramientas()
    {
        return $this->hasMany(SolicitudHerramienta::class, 'solicitud_obra_id');
    }
    public function solicitud_personals()
    {
        return $this->hasMany(SolicitudPersonal::class, 'solicitud_obra_id');
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }
}
