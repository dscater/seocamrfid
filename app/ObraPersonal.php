<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class ObraPersonal extends Model
{
    protected $fillable = [
        "obra_id",
        "personal_id",
        "solicitud_personal_id",
        "fecha_registro"
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }

    public function solicitud_personal()
    {
        return $this->belongsTo(SolicitudPersonal::class, 'solicitud_personal_id');
    }
}
