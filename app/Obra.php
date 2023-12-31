<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Obra extends Model
{
    protected $fillable = [
        'nombre',
        'jefe_id',
        "auxiliar_id",
        'fecha_obra',
        'descripcion',
        "check_jefe",
        "check_aux",
        "estado"
    ];

    protected $appends = [
        "stock_bajo", "c_material", "c_herramientas", "c_personal",
        "total_herramientas_solicitadas", "total_personal_solicitado"
    ];

    public function getTotalHerramientasSolicitadasAttribute()
    {
        $total = 0;
        if ($this->solicitud_obra) {
            $total = count($this->solicitud_obra->solicitud_herramientas);
        }
        return $total;
    }

    public function getTotalPersonalSolicitadoAttribute()
    {
        $total = 0;
        if ($this->solicitud_obra) {
            $total = count($this->solicitud_obra->solicitud_personals);
        }
        return $total;
    }

    public function getStockBajoAttribute()
    {
        return count(MaterialObra::where('obra_id', $this->id)->where('estado', 1)->where('estado_stock', 'BAJO')->get());
    }
    public function getCMaterialAttribute()
    {
        return count(MaterialObra::where('obra_id', $this->id)->where('estado', 1)->get());
    }
    public function getCHerramientasAttribute()
    {
        return count(ObraHerramienta::where('obra_id', $this->id)->get());
    }
    public function getCPersonalAttribute()
    {
        return count(ObraPersonal::where('obra_id', $this->id)->get());
    }

    public function jefe_obra()
    {
        return $this->belongsTo(User::class, 'jefe_id');
    }
    public function auxiliar()
    {
        return $this->belongsTo(User::class, 'auxiliar_id');
    }

    public function materials()
    {
        return $this->hasMany(MaterialObra::class, 'obra_id');
    }

    public function obra_personals()
    {
        return $this->hasMany(ObraPersonal::class, 'obra_id');
    }

    public function obra_herramientas()
    {
        return $this->hasMany(ObraHerramienta::class, 'obra_id');
    }

    public function ingresos_salidas()
    {
        return $this->hasMany(IngresoSalida::class, 'obra_id');
    }

    public function solicitud_obra()
    {
        return $this->hasOne(SolicitudObra::class, 'obra_id');
    }

    public function nota_obras()
    {
        return $this->hasMany(NotaObras::class, 'obra_id');
    }
}
