<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class ObraPersonal extends Model
{
    protected $fillable = [
        "obra_id",
        "personal_id",
        "fecha_registro"
    ];

    public function personal()
    {
        return $this->belongsTo(Personal::class, 'personal_id');
    }
}
