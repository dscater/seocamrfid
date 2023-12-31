<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>MonitoreoHerramientas</title>
    <style type="text/css">
        * {
            font-family: sans-serif;
        }

        @page {
            margin-top: 2cm;
            margin-bottom: 1cm;
            margin-left: 1.5cm;
            margin-right: 1cm;
            border: 5px solid blue;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            table-layout: fixed;
            margin-top: 20px;
        }

        table thead tr th,
        tbody tr td {
            font-size: 0.63em;
        }

        .encabezado {
            width: 100%;
        }

        .logo img {
            position: absolute;
            width: 200px;
            height: 90px;
            top: -20px;
            left: -20px;
        }

        h2.titulo {
            width: 450px;
            margin: auto;
            margin-top: 15px;
            margin-bottom: 15px;
            text-align: center;
            font-size: 14pt;
        }

        .texto {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: bold;
            font-size: 1.1em;
        }

        .fecha {
            width: 250px;
            text-align: center;
            margin: auto;
            margin-top: 15px;
            font-weight: normal;
            font-size: 0.85em;
        }

        .total {
            text-align: right;
            padding-right: 15px;
            font-weight: bold;
        }

        table {
            width: 100%;
        }

        table thead {
            background: rgb(236, 236, 236)
        }

        table thead tr th {
            padding: 3px;
            font-size: 0.7em;
        }

        table tbody tr td {
            padding: 3px;
            font-size: 0.55em;
        }

        table tbody tr td.franco {
            background: red;
            color: white;
        }

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .datos {
            margin-left: 15px;
            border-top: solid 1px;
            border-collapse: collapse;
            width: 250px;
        }

        .txt {
            font-weight: bold;
            text-align: right;
            padding-right: 5px;
        }

        .txt_center {
            font-weight: bold;
            text-align: center;
        }

        .cumplimiento {
            position: absolute;
            width: 150px;
            right: 0px;
            top: 86px;
        }

        .p_cump {
            color: red;
            font-size: 1.2em;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(202, 202, 202);
        }

        .txt_rojo {}

        .img_celda img {
            width: 45px;
        }


        .izquierda {
            text-align: left;
        }
    </style>
</head>

<body>
    <div class="encabezado">
        <div class="logo">
            <img src="{{ asset('imgs/' . app\RazonSocial::first()->logo) }}">
        </div>
        <h2 class="titulo">
            {{ app\RazonSocial::first()->nombre }}
        </h2>
        <h4 class="texto">MONITOREO DE HERRAMIENTAS DE TRABAJO</h4>
        <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
    </div>
    @foreach ($herramientas as $h)
        <table border="1">
            <thead>
                <tr>
                    <th colspan="2" class="izquierda">
                        <div style="width:100%;text-align:center;">{{ $h->nombre }}</div>
                    </th>
                </tr>
                @if ($h->asignacion_herramienta)
                    <tr>
                        <th>OBRA</th>
                        <th>SOLICITUD</th>
                    </tr>
                    <tr>
                        <th class="izquierda">
                            OBRA ASIGNADA: {{ $h->asignacion_herramienta->obra->nombre }}
                            <br>
                            FECHA DE ASIGNACIÓN: {{ $h->asignacion_herramienta->fecha_registro }}
                            <br>
                            FECHA DE FINALIZACIÓN: {{ $h->asignacion_herramienta->fecha_fin }}
                            <br>
                            DÍAS DE USO: {{ (float) number_format($h->tiempo_uso / 24, 2, '.', '') }}
                            <br>
                            INGRESO HORAS: {{ $h->tiempo_almacen ? $h->tiempo_almacen : $h->tiempo_ingreso }}<br>
                            SALIDA HORAS: {{ $h->tiempo_uso ? $h->tiempo_uso : $h->tiempo_salida }}
                        </th>
                        <th class="izquierda">
                            FECHA DE ASIGNACIÓN:
                            {{ $h->asignacion_herramienta->solicitud_herramienta->fecha_asignacion }}
                            <br>
                            FECHA DE FINALIZACIÓN:
                            {{ $h->asignacion_herramienta->solicitud_herramienta->fecha_finalizacion }}
                            <br>
                            DÍAS DE USO: {{ $h->asignacion_herramienta->solicitud_herramienta->dias_uso }}
                        </th>
                    </tr>
                @else
                    <tr>
                        <th colspan="2" class="izquierda">
                            INGRESO HORAS: {{ $h->tiempo_almacen ? $h->tiempo_almacen : $h->tiempo_ingreso }}<br>
                            SALIDA HORAS: {{ $h->tiempo_uso ? $h->tiempo_uso : $h->tiempo_salida }}</th>
                    </tr>
                @endif
                <tr>
                    <th colspan="2">INGRESOS Y SALIDAS</th>
                </tr>
                <tr>
                    <th>Fecha Hora de Registro</th>
                    <th>Estado</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($ingresos_salidas[$h->id] as $is)
                    <tr>
                        <td>{{ date('d/m/Y H:i:s', strtotime($is->created_at)) }}</td>
                        <td>{{ $is->accion }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endforeach
</body>

</html>
