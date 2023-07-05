@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Asignación de Materiales de Obras</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('material_obras.index', $obra->id) }}">Asignación de
                                Materiales
                                de Obras</a></li>
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
                            <h3 class="card-title">Modificar Registro</h3>
                        </div>
                        <!-- /.card-header -->
                        {{ Form::model($material_obra, ['route' => ['material_obras.update', $material_obra->id], 'method' => 'put', 'files' => true]) }}
                        <div class="card-body">
                            @include('material_obras.form.form')
                            <button class="btn btn-info"><i class="fa fa-update"></i> ACTUALIZAR</button>
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
    <script>
        @if (session('bien'))
            mensajeNotificacion('{{ session('bien') }}','success');
        @endif

        @if (session('info'))
            mensajeNotificacion('{{ session('info') }}','info');
        @endif

        @if (session('error'))
            mensajeNotificacion('{{ session('error') }}','error');
        @endif
    </script>
@endsection
