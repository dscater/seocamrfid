<?php

namespace app;

use Illuminate\Database\Eloquent\Model;

class Herramienta extends Model
{
    protected $fillable = [
        'nombre', 'rfid', 'descripcion', 'estado', 'foto', 'fecha_registro',
    ];
    protected $appends = [
        "url_foto",
        "asignacion_herramienta",
        "tiempo_ingreso",
        "tiempo_salida",
        "tiempo_almacen",
        "tiempo_uso"
    ];

    public function getAsignacionHerramientaAttribute()
    {
        // buscar la ultima asignación activa
        $obra_herramienta = ObraHerramienta::where("estado", 1)
            ->where("herramienta_id", $this->id)->get()->first();
        return $obra_herramienta;
    }
    public function getTiempoIngresoAttribute()
    {
        // obtener la suma total de ingresos
        $almacen = ObraHerramientaUso::where("herramienta_id", $this->id)->sum("total_almacen");
        if ($almacen == 0) {
            $ultimo_ingreso = MonitoreoHerramienta::where("herramienta_id", $this->id)->get()->last();
            if ($ultimo_ingreso) {
                if ($ultimo_ingreso->accion == 'SALIDA') {
                    $almacen = 0;
                } else {
                    $almacen = Herramienta::horasTranscurridas($ultimo_ingreso->fecha_registro, $ultimo_ingreso->hora, date("Y-m-d"), date("H:i"));
                }
            }
        }
        return $almacen; //INGRESOS
    }
    public function getTiempoSalidaAttribute()
    {
        // obtener la suma total de salidas
        $uso = ObraHerramientaUso::where("herramienta_id", $this->id)->sum("total_uso");
        $ultimo_ingreso = MonitoreoHerramienta::where("herramienta_id", $this->id)->get()->last();
        if ($ultimo_ingreso && $this->asignacion_herramienta && $ultimo_ingreso->accion != "INGRESO") {
            $uso = Herramienta::horasTranscurridas($ultimo_ingreso->fecha_registro, $ultimo_ingreso->hora, date("Y-m-d"), date("H:i"));
        } else {
            $uso = 0;
        }
        return $uso; //SALIDAS
    }

    public function getTiempoAlmacenAttribute()
    {
        // obtener la suma total de ingresos
        $almacen = ObraHerramientaUso::where("herramienta_id", $this->id)->sum("total_almacen");
        if ($almacen == 0) {
            $ultimo_ingreso = MonitoreoHerramienta::where("herramienta_id", $this->id)->get()->last();
            if ($ultimo_ingreso && $ultimo_ingreso->accion == 'INGRESO') {
                $almacen = Herramienta::horasTranscurridas($ultimo_ingreso->fecha_registro, $ultimo_ingreso->hora, date("Y-m-d"), date("H:i"));
            }
        }
        return $almacen; //INGRESOS
    }
    public function getTiempoUsoAttribute()
    {
        // obtener la suma total de salidas
        $uso = 0;
        if ($this->asignacion_herramienta) {
            $uso = ObraHerramientaUso::where("herramienta_id", $this->id)->where("obra_id", $this->asignacion_herramienta->obra_id)->sum("total_uso");
        } else {
            if ($uso == 0) {
                $ultimo_ingreso = MonitoreoHerramienta::where("herramienta_id", $this->id)->get()->last();
                if ($ultimo_ingreso->accion == 'SALIDA') {
                    $uso = Herramienta::horasTranscurridas($ultimo_ingreso->fecha_registro, $ultimo_ingreso->hora, date("Y-m-d"), date("H:i"));
                }
            }
        }
        return $uso; //SALIDAS
    }

    public function getUrlFotoAttribute()
    {
        return asset("imgs/herramientas/" . ($this->foto ? $this->foto : 'default.png'));
    }

    public function monitoreos()
    {
        return $this->hasMany(MonitoreoHerramienta::class, 'herramienta_id');
    }

    public static function getUltimaSalida($id)
    {
        $ultimo_salida = MonitoreoHerramienta::where("herramienta_id", $id)
            ->where("accion", "SALIDA")->get()->last();
        return $ultimo_salida;
    }

    public static function getUltimoIngreso($id)
    {
        $ultimo_ingreso = MonitoreoHerramienta::where("herramienta_id", $id)
            ->where("accion", "INGRESO")->get()->last();
        return $ultimo_ingreso;
    }

    public static function horasTranscurridas($fecha1, $hora1, $fecha2, $hora2)
    {
        $inicio = strtotime($fecha1 . ' ' . $hora1);
        $fin = strtotime($fecha2 . ' ' . $hora2);
        $diferencia = $fin - $inicio;

        // Convertir la diferencia a horas
        $horas = $diferencia / (60 * 60);

        return (int)$horas;
    }
}
