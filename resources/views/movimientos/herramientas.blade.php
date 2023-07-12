@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Obra Herramientas - {{ $obra->nombre }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('movimientos.index', $obra->id) }}">Movimientos</a>
                        </li>
                        <li class="breadcrumb-item active">Herramientas</li>
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
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('obras.index') }}" class="btn btn-default btn-block"><i
                                            class="fa fa-arrow-left"></i> Volver a Obras</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('movimientos.index', $obra->id) }}"
                                        class="btn btn-default btn-block"><i class="fa fa-arrow-left"></i> Volver a
                                        Movimientos</a>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Herramientas asignadas: {{ count($obra->obra_herramientas) }}</h4>
                                </div>
                            </div>
                            <div class="row contenedor_notas">
                                @foreach ($obra->obra_herramientas as $value)
                                    <div class="card col-md-12">
                                        <div class="card-body">
                                            <p><strong>Herramienta: </strong>{{ $value->herramienta->nombre }}</p>
                                            <p><strong>Fecha de asignación:
                                                </strong>{{ $value->herramienta->fecha_registro }}</p>
                                        </div>
                                    </div>
                                @endforeach
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

    @include('modal.eliminar')

@section('scripts')
    <script></script>
@endsection
@endsection
