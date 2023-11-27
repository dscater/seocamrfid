<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <title>HistorialUsuario</title>
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
            padding: 3px;
            word-wrap: break-word;
        }

        table thead tr th {
            font-size: 9pt;
        }

        tbody tr td {
            font-size: 8pt;
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

        .img_celda {
            padding: 0px;
            text-align: center;
        }

        .img_celda img {
            width: 90px;
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
    @foreach ($usuarios as $user)
        <div class="encabezado">
            <div class="logo">
                <img src="{{ asset('imgs/' . app\RazonSocial::first()->logo) }}">
            </div>
            <h2 class="titulo">
                {{ app\RazonSocial::first()->nombre }}
            </h2>
            <h4 class="texto">HISTORIAL DE USUARIO</h4>
            <h4 class="fecha">Expedido: {{ date('Y-m-d') }}</h4>
        </div>
        <table border="1">
            <tbody>
                <tr>
                    <td class="bold" width="14%">Usuario:</td>
                    <td>{{ $user->usuario }}</td>
                    <td class="img_celda" colspan="2" rowspan="4"><img src="{{ $user->user->url_foto }}"
                            alt="Foto"></td>
                </tr>
                <tr>
                    <td class="bold">Nombre: </td>
                    <td>{{ $user->nombre }} {{ $user->paterno }} {{ $user->materno }}</td>
                </tr>
                <tr>
                    <td class="bold">C.I.: </td>
                    <td>{{ $user->ci }} {{ $user->ci_exp }}</td>
                </tr>
                <tr>
                    <td class="bold">Celular:</td>
                    <td>{{ $user->cel }}</td>
                </tr>
                <tr>
                    <td class="bold">Correo:</td>
                    <td>{{ $user->email }}</td>
                    <td class="bold" width="14%">Dirección:</td>
                    <td>{{ $user->dir }}</td>
                </tr>
                <tr>
                    <td class="bold">Fecha de registro:</td>
                    <td>{{ $user->fecha_registro }}</td>
                    <td class="bold">TIpo:</td>
                    <td>{{ $user->tipo }}</td>
                </tr>
                <tr>
                    <td class="bold">Habilitado:</td>
                    <td colspan="3">{{ $user->habilitado_txt }}</td>
                </tr>
            </tbody>
        </table>

        @if ($user->tipo == 'AUXILIAR' || $user->tipo == 'JEFE DE OBRA')
            <h4>OBRAS ASIGNADAS</h4>
            <table border="1">
                <thead>
                    <tr>
                        <th width="7%">#</th>
                        <th>Obra</th>
                        <th width="13%">Fecha</th>
                        <th width="10%">Material</th>
                        <th width="10%">Herramientas</th>
                        <th width="10%">Personal</th>
                        <th width="10%">Notas</th>
                    </tr>
                </thead>
                <tbody>
                    @php
                        $numero = 1;
                    @endphp
                    @foreach ($user->obras_asignadas as $oa)
                        @php
                            $muestra = true;
                            if ($filtro == 'fecha') {
                                $muestra = false;
                                if (date('Y-m-d', strtotime($oa->created_at)) >= $fecha_ini && date('Y-m-d', strtotime($oa->created_at)) <= $fecha_fin) {
                                    $muestra = true;
                                }
                            }
                        @endphp
                        @if ($muestra)
                            <tr>
                                <td class="centreado">{{ $numero++ }}</td>
                                <td>{{ $oa->nombre }}</td>
                                <td>{{ $oa->fecha_obra }}</td>
                                <td class="centreado">{{ $oa->c_material }}</td>
                                <td class="centreado">{{ $oa->c_herramientas }}</td>
                                <td class="centreado">{{ $oa->c_personal }}</td>
                                <td class="centreado">{{ count($oa->nota_obras) }}</td>
                            </tr>
                        @endif
                    @endforeach
                </tbody>
            </table>
        @endif
        @php
            $cont++;
        @endphp
        @if ($cont < count($usuarios))
            <div class="break_page"></div>
        @endif
    @endforeach
</body>

</html>
