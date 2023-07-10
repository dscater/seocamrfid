<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class DatosUsuario extends Model
{
    protected $table = 'datos_usuarios';
    protected $fillable = [
        'nombre', 'paterno', 'materno', 'ci', 'ci_exp', 'dir', 'email', 'fono', 'cel', 'user_id', 'habilitado', 'fecha_registro'
    ];

    protected $appends = ["habilitado_txt", "full_name"];


    public function getFullNameAttribute()
    {
        return $this->nombre . ' ' . $this->paterno . ' ' . $this->materno;
    }


    public function getHabilitadoTxtAttribute()
    {
        return $this->habilitado ? "SI" : "NO";
    }

    public function user()
    {
        return $this->belongsTo('app\User', 'user_id', 'id');
    }

    public function doctor()
    {
        return $this->hasOne('app\Doctor', 'datos_usuario_id', 'id');
    }
}
