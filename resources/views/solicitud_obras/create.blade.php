@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Obras</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('obras.index') }}">Obras</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('solicitud_obras.index') }}">Solicitud de Obras</a>
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
                                    <a href="{{ route('solicitud_obras.solicitudes_obra', $obra->id) }}"
                                        class="btn btn-default btn-block"><i class="fa fa-arrow-left"></i> Volver a
                                        {{ $obra->nombre }}</a>
                                </div>
                                <div class="col-md-12">
                                    <h3 class="card-title text-center w-100">Nueva Solicitud</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        {{ Form::open(['route' => ['solicitud_obras.store', $obra->id], 'method' => 'post', 'files' => true]) }}
                        <div class="card-body">
                            @include('solicitud_obras.form.form')
                            <button class="btn btn-info"><i class="fa fa-save"></i> REGISTRAR SOLICITUD</button>
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
