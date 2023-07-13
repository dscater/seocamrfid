@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Obra Personal - {{ $obra->nombre }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('movimientos.index', $obra->id) }}">Movimientos</a>
                        </li>
                        <li class="breadcrumb-item active">Personal</li>
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
                                    <h4>Personal asignado en la Obra: {{ count($obra->obra_personals) }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row contenedor_notas">
                                @foreach ($obra->obra_personals as $value)
                                    <div class="card col-md-12">
                                        <div class="card-body">
                                            <p><strong>Personal: </strong>{{ $value->personal->full_name }}</p>
                                            <p><strong>Fecha de asignación:
                                                </strong>{{ $value->personal->fecha_registro }}</p>
                                        </div>
                                        @if ($obra->estado != 'CONCLUIDA')
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <button type="button" onclick="quitarRegistro({{ $value->id }})"
                                                            class="btn btn-sm btn-danger btn-block">QUITAR DE
                                                            LA
                                                            OBRA</button>
                                                    </div>
                                                </div>
                                            </div>
                                        @endif

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
                                    <h4>Personal solicitado: {{ $obra->total_personal_solicitado }}</h4>
                                </div>
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row contenedor_notas">
                                @if ($obra->solicitud_obra)
                                    @foreach ($obra->solicitud_obra->solicitud_personals as $sp)
                                        <div class="card col-md-12">
                                            <div class="card-body">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <p><strong>Personal: </strong>{{ $sp->personal->full_name }}</p>
                                                        <p><strong>Asignado: </strong><span
                                                                class="text-sm badge badge-{{ $sp->asignado ? 'success' : 'danger' }}">{{ $sp->asignado ? 'SI' : 'NO' }}</span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                            @if (!$sp->asignado)
                                                <div class="card-footer">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <button type="button"
                                                                onclick="asignarRegistro({{ $sp->id }})"
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

    <input type="hidden" value="{{ route('obra_personals.destroy') }}" id="urlQuitar">
    <input type="hidden" value="{{ route('obra_personals.asignar') }}" id="urlAsignar">
@endsection
@section('scripts')
    <script>
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
