@extends('layouts.app')

@section('content')

    <!-- Content Header (Page header) -->
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Inicio</h1>
                </div><!-- /.col -->
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item active">Inicio</li>
                    </ol>
                </div><!-- /.col -->
            </div><!-- /.row -->
        </div><!-- /.container-fluid -->
    </div>
    <!-- /.content-header -->

    <!-- Main content -->
    <section class="content">
        <div class="container-fluid">

            @if (Auth::user()->tipo == 'ADMINISTRADOR')
                @include('includes.home.home_admin')
            @endif
            @if (Auth::user()->tipo == 'AUXILIAR')
                @include('includes.home.home_auxiliar')
            @endif
            @if (Auth::user()->tipo == 'JEFE DE OBRA')
                @include('includes.home.home_jo')
            @endif

            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                        <div class="card-header">
                            <h4>Materiales en Obras</h4>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Seleccione Obra:</label>
                                        <select name="obra" id="obra" class="form-control">
                                            <option value="todos">Todos</option>
                                            @foreach ($_obras as $o)
                                                <option value="{{ $o->id }}">{{ $o->nombre }}</option>
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
        <!--/. container-fluid -->
    </section>
    <!-- /.content -->
    <input type="hidden" value="{{ route('reportes.infoMateriales') }}" id="urlInfoGrafico">
@endsection

@section('scripts')
    <script>
        $(document).ready(function() {
            cargaGrafico();
            $('#obra').change(cargaGrafico);
        });

        function cargaGrafico() {
            $.ajax({
                type: "GET",
                url: $('#urlInfoGrafico').val(),
                data: {
                    obra: $('#obra').val(),
                },
                dataType: "json",
                success: function(response) {
                    Highcharts.chart('contenedorGrafico', {
                        chart: {
                            type: 'column'
                        },
                        title: {
                            text: 'MATERIALES EN OBRAS'
                        },
                        subtitle: {
                            text: response.fecha
                        },
                        xAxis: {
                            categories: response.categorias,
                            crosshair: true,
                        },
                        yAxis: {
                            min: 0,
                            title: {
                                text: 'Cantidad'
                            }
                        },
                        tooltip: {
                            headerFormat: '<span style="font-size:10px">{point.key}</span><table>',
                            pointFormat: '<tr><td style="color:{series.color};padding:0">{series.name}: </td>' +
                                '<td style="padding:0"><b>{point.y:.0f}</b></td></tr>',
                            footerFormat: '</table>',
                            shared: true,
                            useHTML: true
                        },
                        plotOptions: {
                            column: {
                                pointPadding: 0.2,
                                borderWidth: 0
                            }
                        },
                        series: response.series,
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
