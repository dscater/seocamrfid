@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Obrass - Asignación directa</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('obras.index') }}">Obras</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('solicitud_obras.solicitudes_obra', $obra->id) }}">{{ $obra->nombre }}</a>
                        </li>
                        <li class="breadcrumb-item active">Nuevo</li>
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
                                <div class="col-md-12">
                                    <h3 class="card-title text-center w-100">Formulario de asignación directa</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        {{ Form::open(['route' => ['asignacion_directa.store', $obra->id], 'method' => 'post', 'files' => true, 'id' => 'formSolicitud']) }}
                        <div class="card-body">
                            @include('solicitud_obras.form.form')
                            @if ($obra->estado != 'CONCLUIDA')
                                <button class="btn btn-info" id="btnEnviaForm"><i class="fa fa-check-circle"></i> APROBAR Y
                                    ASIGNAR</button>
                            @endif
                        </div>
                        {{ Form::close() }}
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <input type="hidden" id="txtNomObra" value="{{ $obra->nombre }}">
@endsection

@section('scripts')
    <script src="{{ asset('js/asignacion_directa/elementos.js') }}"></script>
    <script src="{{ asset('js/asignacion_directa/material.js') }}"></script>
    <script src="{{ asset('js/asignacion_directa/herramienta.js') }}"></script>
    <script src="{{ asset('js/asignacion_directa/personal.js') }}"></script>
    <script src="{{ asset('js/asignacion_directa/create.js') }}"></script>
@endsection
