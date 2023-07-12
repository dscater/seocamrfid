@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Administrar Movimientos</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Administrar Movimientos</li>
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
                                    <h4 class="card-title">Obra: {{ $obra->nombre }}</h4>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-12 form-group">
                                    <a href="{{ route('material_obras.index', $obra->id) }}"
                                        class="btn btn-primary btn-block">MATERIALES ASIGNADOS
                                        ({{ count($obra->materials) }})</a>
                                </div>
                                <div class="col-md-12 form-group">
                                    <a href="" class="btn btn-primary btn-block">HERRAMIENTAS ASIGNADAS
                                        ({{ count($obra->obra_herramientas) }})</a>
                                </div>
                                <div class="col-md-12 form-group">
                                    <a href="" class="btn btn-primary btn-block">PERSONAL ASIGNADO
                                        ({{ count($obra->obra_personals) }})</a>
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
@endsection

@section('scripts')
    <script></script>
@endsection
