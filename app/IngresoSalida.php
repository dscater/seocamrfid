<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class IngresoSalida extends Model
{
    protected $fillable = [
        'obra_id', 'mo_id', 'cantidad', 'tipo',
        'fecha_registro','estado'
    ];

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }

    public function mo()
    {
        return $this->belongsTo(MaterialObra::class, 'mo_id');
    }

    public function notificacions()
    {
        return $this->hasMany(Notificacion::class, 'registro_id');
    }
}
