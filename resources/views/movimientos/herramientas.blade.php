@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Obra Herramientas - {{ $obra->nombre }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('movimientos.index', $obra->id) }}">Movimientos</a>
                        </li>
                        <li class="breadcrumb-item active">Herramientas</li>
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
                                <div class="col-md-3">
                                    <a href="{{ route('movimientos.index', $obra->id) }}"
                                        class="btn btn-default btn-block"><i class="fa fa-arrow-left"></i> Volver a
                                        Movimientos</a>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Herramientas asignadas en la Obra: {{ count($obra->obra_herramientas) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row contenedor_notas">
                                @foreach ($obra->obra_herramientas as $value)
                                    <div class="card col-md-12">
                                        <div class="card-body">
                                            <p><strong>Herramienta: </strong>{{ $value->herramienta->nombre }}</p>
                                            <p><strong>Fecha de asignación:
                                                </strong>{{ $value->herramienta->fecha_registro }}</p>
                                        </div>
                                        <div class="card-footer">
                                            <div class="row">
                                                @if ($value->estado == 1)
                                                    <div class="col-md-6">
                                                        <button type="button" onclick="finalizarUso({{ $value->id }})"
                                                            class="btn btn-sm btn-info btn-block"><i
                                                                class="fa fa-check"></i>
                                                            FINALIZAR USO</button>
                                                    </div>
                                                @elseif($value->estado == 2)
                                                    <div class="col-md-6">
                                                        <span class="badge badge-success text-md">DEVUELTO</span>
                                                    </div>
                                                @endif
                                                @if ($obra->estado != 'CONCLUIDA' && !$value->usos)
                                                    <div class="col-md-6">
                                                        <button type="button" onclick="quitarRegistro({{ $value->id }})"
                                                            class="btn btn-sm btn-danger btn-block">QUITAR DE
                                                            LA
                                                            OBRA</button>
                                                    </div>
                                                @endif
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->
                </div>
                <div class="col-6">
                    <div class="card">
                        <div class="card-header">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4>Herramientas solicitadas: {{ $obra->total_herramientas_solicitadas }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row contenedor_notas">
                                @if ($obra->solicitud_obra)
                                    @foreach ($obra->solicitud_obra->solicitud_herramientas as $sh)
                                        <div class="card col-md-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p><strong>Herramienta: </strong>{{ $sh->herramienta->nombre }}</p>
                                                        <p><strong>Asignado: </strong><span
                                                                class="text-sm badge badge-{{ $sh->asignado ? 'success' : 'danger' }}">{{ $sh->asignado ? 'SI' : 'NO' }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (!$sh->asignado && $obra->estado != 'CONCLUIDA')
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button"
                                                                onclick="asignarRegistro({{ $sh->id }})"
                                                                class="btn btn-sm btn-primary btn-block">ASIGNAR A LA
                                                                OBRA</button>
                                                        </div>
                                                    </div>
                                                </div>
                                            @endif
                                        </div>
                                    @endforeach
                                @endif
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

    <input type="hidden" value="{{ route('obra_herramientas.finalizar') }}" id="urlFinalizar">
    <input type="hidden" value="{{ route('obra_herramientas.destroy') }}" id="urlQuitar">
    <input type="hidden" value="{{ route('obra_herramientas.asignar') }}" id="urlAsignar">
@endsection
@section('scripts')
    <script>
        function finalizarUso(id) {
            Swal.fire({
                title: "Confirmación",
                text: "¿Estás seguro(a) de dar por terminado el uso de esta herramienta?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Si, terminar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#dc3545",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('#token').val()
                        },
                        type: "POST",
                        url: $("#urlFinalizar").val(),
                        data: {
                            id
                        },
                        dataType: "json",
                        success: function(response) {
                            if (response.sw) {
                                swal.fire({
                                    title: "Correcto",
                                    icon: "success",
                                    text: "Operación éxitosa",
                                    showCancelButton: false,
                                    showConfirmButton: false,
                                });
                                setTimeout(() => {
                                    location.reload();
                                }, 1000);
                            } else {
                                swal.fire({
                                    title: "Atención",
                                    icon: "info",
                                    text: response.message,
                                    confirmButtonText: "Aceptar",
                                    confirmButtonColor: "#28a745",
                                });
                            }

                        }
                    });
                }
            });
        }

        function asignarRegistro(id) {
            Swal.fire({
                title: "Confirmación",
                text: "¿Estás seguro(a) de asignar el registro a la obra?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Si, asignar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#dc3545",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('#token').val()
                        },
                        type: "POST",
                        url: $("#urlAsignar").val(),
                        data: {
                            id
                        },
                        dataType: "json",
                        success: function(response) {
                            swal.fire({
                                title: "Correcto",
                                icon: "success",
                                text: "Operación éxitosa",
                                showCancelButton: false,
                                showConfirmButton: false,
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                }
            });
        }

        function quitarRegistro(id) {
            Swal.fire({
                title: "Confirmación",
                text: "¿Estás seguro(a) de eliminar el registro de la obra?",
                icon: "question",
                showCancelButton: true,
                confirmButtonText: "Aceptar",
                cancelButtonText: "Cancelar",
                confirmButtonColor: "#28a745",
                cancelButtonColor: "#dc3545",
            }).then((result) => {
                if (result.value) {
                    $.ajax({
                        headers: {
                            'X-CSRF-TOKEN': $('#token').val()
                        },
                        type: "DELETE",
                        url: $("#urlQuitar").val(),
                        data: {
                            id
                        },
                        dataType: "json",
                        success: function(response) {
                            swal.fire({
                                title: "Correcto",
                                icon: "success",
                                text: "Operación éxitosa",
                                showCancelButton: false,
                                showConfirmButton: false,
                            });
                            setTimeout(() => {
                                location.reload();
                            }, 1000);
                        }
                    });
                }
            });
        }
    </script>
@endsection
