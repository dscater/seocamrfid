@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0">Solicitud de Obras - Ver</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right bg-white">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('obras.index') }}">Obras</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('solicitud_obras.index') }}">Solicitud de Obras</a>
                            @if (Auth::user()->tipo == 'JEFE DE OBRA')
                        <li class="breadcrumb-item"><a
                                href="{{ route('solicitud_obras.solicitudes_obra', $obra->id) }}">{{ $obra->nombre }}</a>
                        </li>
                        @endif
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
                            <div class="row">
                                <div class="col-md-3">
                                    @if (Auth::user()->tipo == 'JEFE DE OBRA')
                                        <a href="{{ route('solicitud_obras.solicitudes_obra', $obra->id) }}"
                                            class="btn btn-default btn-block"><i class="fa fa-arrow-left"></i> Volver a
                                            {{ $obra->nombre }}</a>
                                    @else
                                        <a href="{{ route('solicitud_obras.index') }}" class="btn btn-default btn-block"><i
                                                class="fa fa-arrow-left"></i> Volver a Solicitudes</a>
                                    @endif
                                </div>
                                <div class="col-md-12">
                                    <h3 class="card-title text-center w-100">Ver Solicitud</h3>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">MATERIALES</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row" id="contenedor_material">
                                                        @if (isset($solicitud_obra))
                                                            @foreach ($solicitud_obra->solicitud_materials as $value)
                                                                <div class="col-md-12 elem">
                                                                    <div class="card contenedor_datos">
                                                                        <div class="card-body pb-1">
                                                                            <p class="mb-1 editable">
                                                                                <strong>Nombre:
                                                                                </strong><span>{{ $value->material->nombre }}</span>
                                                                            </p>
                                                                            <p class="mb-0 editable">
                                                                                <strong>Cantidad: </strong>
                                                                                <span>{{ $value->cantidad }}</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">HERRAMIENTAS</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row" id="contenedor_herramientas">
                                                        @if (isset($solicitud_obra))
                                                            @foreach ($solicitud_obra->solicitud_herramientas as $value)
                                                                <div class="col-md-12 elem">
                                                                    <div class="card contenedor_datos">
                                                                        <div class="card-body pb-1">
                                                                            <p class="mb-0 editable">
                                                                                <strong>Nombre:
                                                                                </strong><span>{{ $value->herramienta->nombre }}</span>
                                                                            </p>
                                                                            <p class="mb-0 editable">
                                                                                <strong>Días uso: </strong>
                                                                                <span>{{ $value->dias_uso }}</span>
                                                                            </p>
                                                                            <p class="mb-0 editable">
                                                                                <strong>Fecha Asignación: </strong>
                                                                                <span>{{ $value->fecha_asignacion }}</span>
                                                                            </p>
                                                                            <p class="mb-0 editable">
                                                                                <strong>Fecha Finalización: </strong>
                                                                                <span>{{ $value->fecha_finalizacion }}</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4 class="card-title">PERSONAL</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="row" id="contenedor_personal">
                                                        @if (isset($solicitud_obra))
                                                            @foreach ($solicitud_obra->solicitud_personals as $value)
                                                                <div class="col-md-12 elem">
                                                                    <div class="card contenedor_datos">
                                                                        <div class="card-body pb-1">
                                                                            <p class="mb-1 editable">
                                                                                <strong>Nombre:
                                                                                </strong><span>{{ $value->personal->full_name }}</span>
                                                                            </p>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                            @endforeach
                                                        @endif

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <!-- /.card-body -->
                        <div class="card-footer">
                            <div class="row">
                                <div class="col-md-12 text-center">
                                    <h4 class="card-title text-center w-100">APROBAR SOLICITUD</h4>
                                </div>
                                <div class="col-md-12 text-center">
                                    <label class="text-sm">ESTADO ACTUAL</label>
                                    <p><strong>Aprobado por Administrador: </strong> <span
                                            class="text-xs badge badge-{{ $solicitud_obra->aprobado_admin ? 'success' : 'danger' }}">{{ $solicitud_obra->aprobado_admin_txt }}</span>
                                    </p>
                                    <p><strong>Aprobado por Auxiliar: </strong> <span
                                            class="text-xs badge badge-{{ $solicitud_obra->aprobado_aux ? 'success' : 'danger' }}">{{ $solicitud_obra->aprobado_aux_txt }}</span>
                                    </p>
                                    <input type="hidden" id="estado"
                                        value="{{ Auth::user()->tipo == 'ADMINISTRADOR' ? $solicitud_obra->aprobado_admin : $solicitud_obra->aprobado_aux }}">
                                </div>
                                <div class="col-md-12 text-center">
                                    @if (Auth::user()->tipo == 'ADMINISTRADOR')
                                        @if ($solicitud_obra->aprobado_admin)
                                            <button type="button" id="btnCambiarEstado" class="btn btn-warning">DESAPROBAR
                                                COMO
                                                {{ Auth::user()->tipo }}</button>
                                        @else
                                            <button type="button" id="btnCambiarEstado" class="btn btn-primary">APROBAR
                                                COMO
                                                {{ Auth::user()->tipo }}</button>
                                        @endif
                                    @elseif(Auth::user()->tipo == 'AUXILIAR')
                                        @if ($solicitud_obra->aprobado_aux)
                                            <button type="button" id="btnCambiarEstado" class="btn btn-warning">DESAPROBAR
                                                COMO
                                                {{ Auth::user()->tipo }}</button>
                                        @else
                                            <button type="button" id="btnCambiarEstado" class="btn btn-primary">APROBAR
                                                COMO
                                                {{ Auth::user()->tipo }}</button>
                                        @endif
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <!-- /.col -->
            </div>
            <!-- /.row -->
        </div>
    </section>
    <input type="hidden" id="urlCambiaEstadoSolicitud"
        value="{{ route('solicitud_obras.cambiaEstado', $solicitud_obra->id) }}">
@endsection

@section('scripts')
    <script>
        let btnCambiarEstado = $("#btnCambiarEstado");
        let estado = $("#estado").val();
        $(document).ready(function() {
            btnCambiarEstado.click(function() {
                let valor = 0;
                let mensaje = "¿Estás seguro(a) de <strong>DESAPROBAR</strong> esta solicitud?"
                if (estado == 0) {
                    mensaje = "¿Estás seguro(a) de <strong>APROBAR</strong> esta solicitud?"
                    valor = 1;
                }
                Swal.fire({
                    title: "Confirmación",
                    html: mensaje,
                    icon: "question",
                    showCancelButton: true,
                    confirmButtonText: "Si, estoy seguro(a)",
                    cancelButtonText: "Cancelar",
                    confirmButtonColor: "#28a745",
                    cancelButtonColor: "#dc3545",
                }).then((result) => {
                    if (result.value) {
                        actualizaEstado(valor)
                    }
                });
            });
        });

        function actualizaEstado(estado) {
            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('#token').val()
                },
                type: "POST",
                url: $("#urlCambiaEstadoSolicitud").val(),
                data: {
                    estado
                },
                dataType: "json",
                success: function(response) {
                    location.reload();
                }
            });
        }
    </script>
@endsection
