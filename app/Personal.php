<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Personal extends Model
{
    protected $fillable = [
        'nombre', 'paterno', 'materno', 'ci', 'ci_exp',
        'cel', 'domicilio', 'familiar_referencia', 'fono_familiar',
        'cel_familiar', 'foto', 'cargo', 'habilitado', 'fecha_registro', 'estado',
    ];

    protected $appends = ["habilitado_txt", "full_name", "ultima_obra"];

    public function getUltimaObraAttribute()
    {
        $ultima_obra = ObraPersonal::where("personal_id", $this->id)->get()->last();
        return $ultima_obra;
    }

    public function getHabilitadoTxtAttribute()
    {
        return $this->habilitado ? "SI" : "NO";
    }

    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->paterno . ' ' . $this->materno;
    }
}
