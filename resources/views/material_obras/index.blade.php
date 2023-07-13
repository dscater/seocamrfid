@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Asignación de Materiales de Obras</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Asignación de Materiales de Obras</li>
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
                            {{-- <h3 class="card-title"></h3> --}}
                            <div class="row">
                                <div class="col-md-3">
                                    <a href="{{ route('movimientos.index', $obra->id) }}"
                                        class="btn btn-default btn-block"><i class="fa fa-arrow-left"></i>
                                        Volver a Movimientos</a>
                                </div>
                                <div class="col-md-3">
                                    <a href="{{ route('material_obras.create', $obra->id) }}"
                                        class="btn btn-info btn-block"><i class="fa fa-sync"></i>
                                        Nuevo Movimiento</a>

                                </div>

                            </div>
                            <!-- /.card-header -->
                            <div class="card-body">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="bg-teal" width="150px">Nombre: </td>
                                                    <td>{{ $obra->nombre }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-teal">Descripción: </td>
                                                    <td>{{ $obra->descripcion }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    @php
                                        $stock_bajo = count(
                                            app\MaterialObra::where('obra_id', $obra->id)
                                                ->where('estado_stock', 'BAJO')
                                                ->where('estado', 1)
                                                ->get(),
                                        );
                                    @endphp
                                    <div class="col-md-6">
                                        <table class="table table-bordered">
                                            <tbody>
                                                <tr>
                                                    <td class="bg-teal" width="165px">Materiales asignados: </td>
                                                    <td>{{ count($obra->materials) }}</td>
                                                </tr>
                                                <tr>
                                                    <td class="bg-teal">Materiales con stock bajo: </td>
                                                    <td>{{ $stock_bajo }}</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <h4>MATERIALES ASIGNADOS</h4>
                                        <small class="text-gray d-flex w-100 justify-content-end">Para una busqueda mas especifica use comillas("Texto")</small>
                                        <table class="datatable1 table table-bordered">
                                            <thead>
                                                <tr class="bg-teal">
                                                    <th>Fecha Registro</th>
                                                    <th>Material</th>
                                                    <th>Stock Mínimo</th>
                                                    <th>Stock Actual</th>
                                                    <th>Estado Stock</th>
                                                    <th>Opciones</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @foreach ($material_obras as $material_obra)
                                                    @php
                                                        $color_stock = '';
                                                        if ($material_obra->estado_stock == 'BAJO') {
                                                            $color_stock = 'stock_bajo';
                                                        }
                                                    @endphp
                                                    <tr class="{{ $color_stock }}">
                                                        <td>{{ $material_obra->fecha_registro }}</td>
                                                        <td>{{ $material_obra->material->nombre }}</td>
                                                        <td>{{ $material_obra->stock_minimo }}</td>
                                                        <td>{{ $material_obra->stock_actual }}</td>
                                                        <td>{{ $material_obra->estado_stock }}</td>
                                                        <td class="btns-opciones">
                                                            {{-- <a href="{{ route('material_obras.edit', $material_obra->id) }}"
                                                            class="modificar"><i class="fa fa-edit" data-toggle="tooltip"
                                                                data-placement="left" title="Modificar"></i></a> --}}
                                                            @if (!$material_obra->existe_salida_material)
                                                                <a href="#"
                                                                    data-url="{{ route('material_obras.destroy', $material_obra->id) }}"
                                                                    data-toggle="modal" data-target="#modal-eliminar"
                                                                    class="eliminar"><i class="fa fa-trash"
                                                                        data-toggle="tooltip" data-placement="left"
                                                                        title="Eliminar"></i></a>
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
                                    </div>

                                    <div class="col-md-6">
                                        <h4>INGRESOS Y SALIDAS</h4>
                                        <table id="example2" class="datatable2 table table-bordered">
                                            <thead>
                                                <tr class="bg-gray">
                                                    <th>Fecha Registro</th>
                                                    <th>Material</th>
                                                    <th>Cantidad</th>
                                                    <th>Tipo</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                @php
                                                    $cont = 1;
                                                    $ingresos_salidas = app\IngresoSAlida::where('obra_id', $obra->id)
                                                        ->where('estado', 1)
                                                        ->orderBy('created_at', 'desc')
                                                        ->get();
                                                @endphp
                                                @foreach ($ingresos_salidas as $ingreso_salida)
                                                    <tr>
                                                        <td>{{ $ingreso_salida->fecha_registro }}</td>
                                                        <td>{{ $ingreso_salida->mo->material->nombre }}</td>
                                                        <td>{{ $ingreso_salida->cantidad }}</td>
                                                        <td>{{ $ingreso_salida->tipo }}</td>
                                                    </tr>
                                                @endforeach
                                            </tbody>
                                        </table>
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

    @include('modal.eliminar')

@section('scripts')
    <script>
        @if (session('bien'))
            mensajeNotificacion('{{ session('bien') }}', 'success');
        @endif

        @if (session('info'))
            mensajeNotificacion('{{ session('info') }}', 'info');
        @endif

        @if (session('error'))
            mensajeNotificacion('{{ session('error') }}', 'error');
        @endif

        $('table.datatable1').DataTable({
            columns: [
                null,
                null,
                null,
                null,
                null,
                {
                    width: "10%"
                },
            ],
            scrollCollapse: true,
            language: lenguaje,
            pageLength: 25
        });

        $('table.datatable2').DataTable({
            columns: [
                null,
                null,
                null,
                {
                    width: "10%"
                },
            ],
            scrollCollapse: true,
            language: lenguaje,
            pageLength: 25
        });


        // ELIMINAR
        $(document).on('click', 'table tbody tr td.btns-opciones a.eliminar', function(e) {
            e.preventDefault();
            let material = $(this).parents('tr').children('td').eq(1).text();
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar al material <b>${material}</b>?`);
            let url = $(this).attr('data-url');
            console.log($(this).attr('data-url'));
            $('#formEliminar').prop('action', url);
        });

        $('#btnEliminar').click(function() {
            $('#formEliminar').submit();
        });
    </script>
@endsection

@endsection
