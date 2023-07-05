<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $fillable = [
        'nombre', 'paterno', 'materno', 'ci', 'ci_exp',
        'cel', 'obra_id', 'domicilio', 'familiar_referencia', 'fono_familiar',
        'cel_familiar', 'foto', 'fecha_registro', 'estado',
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }
}
