<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class SolicitudPersonal extends Model
{
    protected $fillable = [
        "solicitud_obra_id",
        "personal_id",
        "ingreso",
        "aprobado_admin",
        "aprobado_aux"
    ];

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }
}
