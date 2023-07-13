@extends('layouts.app')

@section('css')
    <style>
        .boton_reporte {
            width: 100% !important;
            margin-left: auto;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .boton_reporte a {
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reportes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('reportes.index') }}">Reportes</a></li>
                        <li class="breadcrumb-item active">Monitoreo de Herramientas de Trabajo</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content" id="contenedorReportes">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <div class="row">
                            <div class="col-12">
                                <h3>Reportes - Monitoreo Herramientas Días Uso</h3>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group">
                                                    <label>Seleccione Herramienta:</label>
                                                    <select name="herramienta" id="herramienta" class="form-control">
                                                        <option value="todos">Todos</option>
                                                        @foreach ($herramientas as $herramienta)
                                                            <option value="{{ $herramienta->id }}">
                                                                {{ $herramienta->nombre }}</option>
                                                        @endforeach
                                                    </select>
                                                </div>
                                            </div>
                                        </div>

                                    </div>
                                    <div class="card-body">
                                        <div id="contenedorGrafico"></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <input type="hidden" value="{{ route('reportes.monitoreoInfo') }}" id="urlInfoGrafico">
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            cargaGrafico();
            $('#herramienta').change(cargaGrafico);
        });

        function cargaGrafico() {
            $.ajax({
                type: "GET",
                url: $('#urlInfoGrafico').val(),
                data: {
                    herramienta: $('#herramienta').val(),
                },
                dataType: "json",
                success: function(response) {
                    Highcharts.chart('contenedorGrafico', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'MONITOREO DE HERRAMIENTAS DÍAS USO'
                        },
                        subtitle: {
                            text: response.fecha
                        },
                        xAxis: {
                            type: 'category'
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Cantidad'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><br><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.2f}</b></td></tr>',
                            footerFormat: '</table>',
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: [response.series],
                        lang: {
                            downloadCSV: 'Descargar CSV',
                            downloadJPEG: 'Descargar imagen JPEG',
                            downloadPDF: 'Descargar Documento PDF',
                            downloadPNG: 'Descargar imagen PNG',
                            downloadSVG: 'Descargar vector de imagen SVG ',
                            downloadXLS: 'Descargar XLS',
                            viewFullscreen: 'Ver pantalla completa',
                            printChart: 'Imprimir',
                            exitFullscreen: 'Salir de pantalla completa'
                        }
                    });

                }
            });
        }
    </script>
@endsection
