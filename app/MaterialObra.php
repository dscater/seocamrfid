<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class MaterialObra extends Model
{
    protected $fillable = [
        'material_id', 'stock_minimo', 'stock_actual', 'estado_stock',
        'obra_id', 'fecha_registro', 'estado'
    ];

    public function material()
    {
        return $this->belongsTo(Material::class, 'material_id');
    }

    public function obra()
    {
        return $this->belongsTo(Obra::class, 'obra_id');
    }

    public function ingresos_salidas()
    {
        return $this->hasMany(IngresoSalida::class, 'mo_id');
    }
}
