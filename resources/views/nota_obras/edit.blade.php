@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Solicitud de Obras - Modificar</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('obras.index') }}">Obras</a></li>
                        <li class="breadcrumb-item"><a
                                href="{{ route('nota_obras.index', $obra->id) }}">{{ $obra->nombre }}</a>
                        </li>
                        <li class="breadcrumb-item active">Modificar</li>
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
                                    <a href="{{ route('nota_obras.index', $obra->id) }}"
                                        class="btn btn-default btn-block"><i class="fa fa-arrow-left"></i> Volver a
                                        {{ $obra->nombre }}</a>
                                </div>
                                <div class="col-md-12">
                                    <h3 class="card-title text-center w-100">Modificar Nota</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        {{ Form::model($nota_obra, ['route' => ['nota_obras.update', $nota_obra->id], 'method' => 'put', 'files' => true, 'id' => 'formSolicitud']) }}
                        <div class="card-body">
                            @include('nota_obras.form.form')
                            <button class="btn btn-info" id="btnEnviaForm"><i class="fa fa-save"></i> ACTUALIZAR
                                NOTA</button>
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
@endsection
