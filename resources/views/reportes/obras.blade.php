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

        .centreado {
            padding-left: 0px;
            text-align: center;
        }

        .b_top {
            border-top: solid 1px black;
        }

        .gray {
            background: rgb(202, 202, 202);
        }

        .izquierda {
            text-align: left;
        }

        .break_page {
            page-break-after: always;
        }

        .bold {
            font-weight: bold;
        }
    </style>
</head>

<body>
    @php
        $cont = 0;
    @endphp
    @foreach ($obras as $obra)
        <div class="encabezado">
            <div class="logo">
                <img src="{{ asset('imgs/' . app\RazonSocial::first()->logo) }}">
            </div>
            <h2 class="titulo">
                {{ app\RazonSocial::first()->nombre }}
            </h2>
            <h4 class="texto">OBRAS</h4>
            <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
        </div>
        <table border="1">
            <tbody>
                <tr>
                    <td class="bold" width="10%">Nombre:</td>
                    <td>{{ $obra->nombre }}</td>
                    <td class="bold" width="10%">Fecha:</td>
                    <td>{{ $obra->fecha_obra }}</td>
                </tr>
                <tr>
                    <td class="bold">Jefe de Obra:</td>
                    <td>{{ $obra->jefe_obra->full_name }}</td>
                    <td class="bold">Auxiliar:</td>
                    <td>{{ $obra->auxiliar->full_name }}</td>
                </tr>
                <tr>
                    <td class="bold">Descripción:</td>
                    <td>{{ $obra->descripcion }}</td>
                    <td class="bold">Estado:</td>
                    <td>{{ $obra->estado }}</td>
                </tr>
            </tbody>
        </table>
        <h4>MATERIALES</h4>
        <table border="1">
            <thead>
                <tr>
                    <th width="7%">#</th>
                    <th>Material</th>
                    <th>Cantidad Total</th>
                    <th>Disponible</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1;
                @endphp
                @foreach ($obra->materials as $m)
                    <tr>
                        <td>{{ $numero++ }}</td>
                        <td>{{ $m->material->nombre }}</td>
                        <td>{{ $m->total_ingresos }}</td>
                        <td>{{ $m->stock_actual }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h4>HERRAMIENTAS</h4>
        <table border="1">
            <thead>
                <tr>
                    <th width="7%">#</th>
                    <th>Herramienta</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1;
                @endphp
                @foreach ($obra->obra_herramientas as $oh)
                    <tr>
                        <td>{{ $numero++ }}</td>
                        <td>{{ $oh->Herramienta->nombre }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h4>PERSONAL</h4>
        <table border="1">
            <thead>
                <tr>
                    <th width="7%">#</th>
                    <th>Personal</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1;
                @endphp
                @foreach ($obra->obra_personals as $op)
                    <tr>
                        <td>{{ $numero++ }}</td>
                        <td>{{ $op->personal->full_name }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        <h4>NOTAS</h4>
        <table border="1">
            <thead>
                <tr>
                    <th width="7%">#</th>
                    <th>Nota</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $numero = 1;
                @endphp
                @foreach ($obra->nota_obras as $no)
                    <tr>
                        <td>{{ $numero++ }}</td>
                        <td>{{ $no->nota }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        @php
            $cont++;
        @endphp
        @if ($cont < count($obras))
            <div class="break_page"></div>
        @endif
    @endforeach
</body>

</html>
