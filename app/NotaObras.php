<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class NotaObras extends Model
{
    protected $fillable = [
        "obra_id",
        "nota",
        "fecha_registro"
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }
}
