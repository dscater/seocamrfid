@extends('layouts.app')

@section('css')
    <style>
        .boton_reporte {
            width: 100% !important;
            margin-left: auto;
            margin-top: 10px;
            margin-bottom: 10px;
        }

        .boton_reporte a {
            width: 100%;
        }

    </style>
@endsection

@section('content')

    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Reportes</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Reportes</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <div class="content" id="contenedorReportes">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-body">
                        <h3>Reportes</h3>
                        @if (Auth::user()->tipo == 'ADMINISTRADOR')
                            @include('includes.reporte.reporte_admin')
                        @endif
                        @if (Auth::user()->tipo == 'AUXILIAR')
                            @include('includes.reporte.reporte_auxiliar')
                        @endif
                        @if (Auth::user()->tipo == 'JEFE DE OBRA')
                            @include('includes.reporte.reporte_jo')
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>

    @include('reportes.modal.m_usuarios')
    @include('reportes.modal.m_personal')
    @include('reportes.modal.m_materiales_obras')
    @include('reportes.modal.m_ingresos_salidas')
    @include('reportes.modal.m_monitoreo')
    @include('reportes.modal.m_obras')
@endsection

@section('scripts')
    <script src="{{ asset('js/reportes/filtro.js') }}"></script>
@endsection
