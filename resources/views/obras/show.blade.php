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
                                <div class="col-md-6">
                                    <p><strong>Nombre: </strong> {{ $obra->nombre }}</p>
                                    <p><strong>Jefe de Obra: </strong> {{ $obra->jefe_obra->full_name }}</p>
                                    <p><strong>Auxiliar: </strong> {{ $obra->auxiliar->full_name }}</p>
                                    <p><strong>Fecha de Obra: </strong> {{ $obra->fecha_obra }}</p>
                                    <p><strong>Descripción: </strong> {{ $obra->descripcion }}</p>
                                    <p><strong>Estado: </strong> {{ $obra->estado }}</p>
                                </div>
                                <div class="col-md-6">
                                    <h4>Material en la obra</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Material</th>
                                                <th>Cantidad Actual</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($obra->materials as $mo)
                                                <tr class={{ $mo->stock_actual <= $mo->stock_minimo ? 'bg-danger' : '' }}>
                                                    <td>{{ $mo->material->nombre }}</td>
                                                    <td>{{ $mo->stock_actual }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <h4>Herramientas en la obra</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Herramienta</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($obra->obra_herramientas as $oh)
                                                <tr>
                                                    <td>{{ $oh->herramienta->nombre }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
                                    <h4>Personal en la obra</h4>
                                    <table class="table table-bordered">
                                        <thead>
                                            <tr>
                                                <th>Personal</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach ($obra->obra_personals as $op)
                                                <tr>
                                                    <td>{{ $op->personal->full_name }}</td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                    </table>
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
                                                @if ($obra->check_jefe == 1 && $obra->check_aux == 1)
                                                    <option value="CONCLUIDA">
                                                        CONCLUIDA</option>
                                                @endif
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
                        @elseif(Auth::user()->tipo == 'AUXILIAR' || Auth::user()->tipo == 'JEFE DE OBRA')
                            <div class="card-footer">
                                <div class="row">
                                    <div class="col-md-12 text-center">
                                        <h4 class="card-title text-center w-100">CONCLUIR OBRA</h4>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <label class="text-sm">ESTADO ACTUAL</label>
                                        <p><strong>Obra concluida - Jefe de Obra: </strong> <span
                                                class="text-xs badge badge-{{ $obra->check_jefe ? 'success' : 'danger' }}"><i
                                                    class="fa fa-{{ $obra->check_jefe ? 'check' : 'times' }}"></i></span>
                                        </p>
                                        <p><strong>Obra concluida - Auxiliar: </strong> <span
                                                class="text-xs badge badge-{{ $obra->check_aux ? 'success' : 'danger' }}"><i
                                                    class="fa fa-{{ $obra->check_aux ? 'check' : 'times' }}"></i></span>
                                        </p>
                                        <input type="hidden" id="estado"
                                            value="{{ Auth::user()->tipo == 'JEFE DE OBRA' ? $obra->check_jefe : $obra->check_aux }}">
                                    </div>
                                    <div class="col-md-12 text-center">
                                        @if (Auth::user()->tipo == 'JEFE DE OBRA')
                                            @if ($obra->check_jefe)
                                                <button type="button" id="btnCambiarEstado" class="btn btn-warning">QUITAR
                                                    CHECK</button>
                                            @else
                                                <button type="button" id="btnCambiarEstado"
                                                    class="btn btn-primary">CONCLUIR OBRA</button>
                                            @endif
                                        @elseif(Auth::user()->tipo == 'AUXILIAR')
                                            @if ($obra->check_aux)
                                                <button type="button" id="btnCambiarEstado" class="btn btn-warning">QUITAR
                                                    CHECK</button>
                                            @else
                                                <button type="button" id="btnCambiarEstado"
                                                    class="btn btn-primary">CONCLUIR OBRA</button>
                                            @endif
                                        @endif
                                    </div>
                                </div>
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
    <input type="hidden" id="urlCambiaEstadoSolicitud" value="{{ route('obras.cambiaEstado', $obra->id) }}">
@endsection
@section('scripts')
    <script>
        let btnCambiarEstado = $("#btnCambiarEstado");
        let estado = $("#estado").val();
        $(document).ready(function() {
            btnCambiarEstado.click(function() {
                let valor = 0;
                let mensaje = "¿Estás seguro(a) de marcar como <strong>NO TERMINADA</strong> LA OBRA?"
                if (estado == 0) {
                    mensaje = "¿Estás seguro(a) de marcar como <strong>TERMINADA</strong> LA OBRA?";
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
