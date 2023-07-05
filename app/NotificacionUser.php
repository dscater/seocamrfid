<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class NotificacionUser extends Model
{
    protected $fillable = ['notificacion_id', 'user_id', 'visto'];

    public function notificacion()
    {
        return $this->belongsTo(Notificacion::class,'notificacion_id');
    }
}
