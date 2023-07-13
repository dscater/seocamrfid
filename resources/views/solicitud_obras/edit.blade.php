@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Solicitud de Obras - Reenviar Solicitud</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('obras.index') }}">Obras</a></li>
                        @if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'AUXILIAR')
                            <li class="breadcrumb-item"><a href="{{ route('solicitud_obras.index') }}">Solicitud de
                                    Obras</a>
                        @endif
                        <li class="breadcrumb-item active">Reenviar Solicitud</li>
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
                                    <h3 class="card-title text-center w-100">Reenviar Solicitud</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        {{ Form::model($solicitud_obra, ['route' => ['solicitud_obras.update', $solicitud_obra->id], 'method' => 'put', 'files' => true, 'id' => 'formSolicitud']) }}
                        <div class="card-body">
                            @include('solicitud_obras.form.form')
                            @if ($obra->estado != 'CONCLUIDA')
                                <button class="btn btn-info" id="btnEnviaForm"><i class="fa fa-paper-plane"></i> REENVIAR
                                    SOLICITUD</button>
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
@endsection

@section('scripts')
    <script src="{{ asset('js/solicitud_obras/elementos.js') }}"></script>
    <script src="{{ asset('js/solicitud_obras/material.js') }}"></script>
    <script src="{{ asset('js/solicitud_obras/herramienta.js') }}"></script>
    <script src="{{ asset('js/solicitud_obras/personal.js') }}"></script>
    <script src="{{ asset('js/solicitud_obras/create.js') }}"></script>
@endsection
