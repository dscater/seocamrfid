@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Monitoreo de Herramientas</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Monitoreo de Herramientas</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">
            <div class="row">
                <div class="col-12">
                    <div class="card">
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">

                                <div class="col-md-6">
                                    <h4>ESTADO DE HERRAMIENTAS</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr class="bg-teal">
                                                <th>Herramienta</th>
                                                <th>Rfid</th>
                                                <th>Estado</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($herramientas as $herramienta)
                                                @php
                                                    $color_estado = 'ingreso';
                                                    if ($herramienta->estado == 'SALIDA') {
                                                        $color_estado = 'salida';
                                                    }
                                                @endphp
                                                <tr class="{{ $color_estado }}" id="herramienta{{ $herramienta->id }}">
                                                    <td>{{ $herramienta->nombre }}</td>
                                                    <td>{{ $herramienta->rfid }}</td>
                                                    <td>{{ $herramienta->estado }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>

                                <div class="col-md-6">
                                    <h4>INGRESOS Y SALIDAS</h4>
                                    <table id="example2" class="table table-bordered">
                                        <thead>
                                            <tr class="bg-gray">
                                                <th>Fecha Registro</th>
                                                <th>Herramienta</th>
                                                <th>Acción</th>
                                            </tr>
                                        </thead>
                                        <tbody id="contenedorLista">
                                            @include('herramientas.parcial.lista_is')
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <input type="hidden" value="{{ route('monitoreo_herramientas.lista_estados') }}" id="urlListaEstados">
@endsection
@section('scripts')
    <script src="{{ asset('js/herramientas/monitoreo.js') }}"></script>
@endsection
