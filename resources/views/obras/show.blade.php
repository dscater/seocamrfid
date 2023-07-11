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
                            <h3 class="card-title">Ver Obra</h3>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <p><strong>Nombre: </strong> {{ $obra->nombre }}</p>
                                    <p><strong>Jefe de Obra: </strong> {{ $obra->jefe_obra->full_name }}</p>
                                    <p><strong>Auxiliar: </strong> {{ $obra->auxiliar->full_name }}</p>
                                    <p><strong>Fecha de Obra: </strong> {{ $obra->fecha_obra }}</p>
                                    <p><strong>Descripción: </strong> {{ $obra->descripcion }}</p>
                                    <p><strong>Estado: </strong> {{ $obra->estado }}</p>
                                </div>
                                <div class="col-md-4">
                                    <a href="{{ route('obras.index') }}" class="btn btn-default"><i
                                            class="fa fa-arrow-left"></i> Volver a Obras</a>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        @if (Auth::user()->tipo == 'ADMINISTRADOR')
                            <div class="card-footer">
                                <form action="{{ route('obras.update', $obra->id) }}" method="post">
                                    <input type="hidden" name="_token" value="{{ csrf_token() }}">
                                    <input type="hidden" name="_method" value="put">
                                    <div class="row">
                                        <div class="col-md-12 form-group">
                                            <label>Actualizar Estado:</label>
                                            <select name="estado" class="form-control" required>
                                                <option value="">Seleccione...</option>
                                                <option value="POR INICIAR">POR INICIAR</option>
                                                <option value="EN PROCESO">EN PROCESO</option>
                                                <option value="CONCLUIDA">CONCLUIDA</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-md-4 ml-auto mr-auto">
                                            <button class="btn btn-primary btn-block"><i class="fa fa-save"></i> Guardar
                                                Cambios</button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        @endif
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
