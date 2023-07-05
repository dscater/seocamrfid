<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $fillable = ['nombre', 'descripcion'];

    public function personal()
    {
        return $this->hasMany(Personal::class, 'obra_id');
    }

    public function materials()
    {
        return $this->hasMany(MaterialObra::class, 'obra_id');
    }

    public function ingresos_salidas()
    {
        return $this->hasMany(IngresoSalida::class, 'obra_id');
    }
}
