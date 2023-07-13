<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class SolicitudPersonal extends Model
{
    protected $fillable = [
        "solicitud_obra_id",
        "personal_id",
        "ingreso",
        "aprobado",
    ];

    protected $appends = ["asignado"];

    public function getAsignadoAttribute()
    {
        $existe = ObraPersonal::where("solicitud_personal_id", $this->id)->get()->first();
        if ($existe) {
            return true;
        }
        return false;
    }

    public function solicitud_obra()
    {
        return $this->belongsTo(SolicitudObra::class, 'solicitud_obra_id');
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }
}
