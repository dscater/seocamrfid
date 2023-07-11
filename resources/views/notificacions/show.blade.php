@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Notificaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('notificacions.index') }}">Notificaciones</a></li>
                        <li class="breadcrumb-item active">Ver</li>
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
                            <h3 class="card-title">Ver notificación</h3>
                        </div>
                        <div class="card-body">
                            <p><b>Tipo:</b> {{ $notificacion->notificacion->tipo }}
                                @if ($notificacion->notificacion->tipo == 'MATERIAL')
                                    <p><b>Registro:</b> {{ $notificacion->notificacion->material->mo->material->nombre }}
                                    </p>
                                @elseif($notificacion->notificacion->tipo == 'HERRAMIENTA')
                                    <p><b>Registro:</b> {{ $notificacion->notificacion->monitoreo->herramienta->nombre }}
                                    </p>
                                @endif
                            <p><b>Acción:</b> {{ $notificacion->notificacion->accion }}</p>
                            <p><b>Mensaje:</b> {{ $notificacion->notificacion->mensaje }}</p>
                            <p><b>Fecha Hora:</b>
                                {{ date('d/m/Y H:i a', strtotime($notificacion->notificacion->fecha . ' ' . $notificacion->notificacion->hora)) }}
                            </p>
                            @if ($notificacion->notificacion->tipo == 'SOLICITUD')
                                <p><a href="{{ route('solicitud_obras.show', $notificacion->notificacion->registro_id) }}" class="btn btn-primary">Ver
                                        solicitud</a></p>
                            @endif
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
@endsection

@section('scripts')
@endsection
