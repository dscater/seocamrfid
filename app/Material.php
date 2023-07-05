<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Material extends Model
{
    protected $fillable = [
        'nombre', 'stock_minimo', 'descripcion',
        'fecha_registro',
    ];

    public function obras()
    {
        return $this->hasMany(MaterialObra::class, 'material_id');
    }
}
