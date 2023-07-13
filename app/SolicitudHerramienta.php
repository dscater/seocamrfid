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
        "fecha_finalizacion",
        "ingreso",
        "aprobado",
    ];

    protected $appends = ["asignado"];

    public function getAsignadoAttribute()
    {
        $existe = ObraHerramienta::where("solicitud_herramienta_id", $this->id)->get()->first();
        if ($existe) {
            return true;
        }
        return false;
    }

    public function solicitud_obra()
    {
        return $this->belongsTo(SolicitudObra::class, 'solicitud_obra_id');
    }

    public function herramienta()
    {
        return $this->belongsTo(Herramienta::class, 'herramienta_id');
    }
}
