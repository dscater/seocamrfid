<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class ObraPersonal extends Model
{
    protected $fillable = [
        "obra_id",
        "personal_id",
    ];
}
