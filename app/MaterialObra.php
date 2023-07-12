<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class MaterialObra extends Model
{
    protected $fillable = [
        'material_id', 'stock_minimo', 'stock_actual', 'estado_stock',
        'obra_id', 'fecha_registro', 'estado'
    ];

    protected $appends = ["existe_salida_material"];

    public function getExisteSalidaMaterialAttribute()
    {
        $salidas = IngresoSalida::where("mo_id", $this->id)->where("tipo", "SALIDA")->where("estado", 1)->get();
        if (count($salidas) > 0) {
            return true;
        }
        return false;
    }

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
