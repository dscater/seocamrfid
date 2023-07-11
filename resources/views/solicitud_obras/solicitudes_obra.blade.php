@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Solicitud de Obras - {{ $obra->nombre }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item"><a href="{{ route('obras.index') }}">Obras</a></li>
                        <li class="breadcrumb-item active">Solicitud de Obras</li>
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
                                @if (Auth::user()->tipo == 'JEFE DE OBRA' && $obra->estado != 'CONCLUIDA')
                                    <div class="col-md-3">
                                        <a href="{{ route('solicitud_obras.create', $obra->id) }}"
                                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Nueva Solicitud
                                            {{ $obra->nombre }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <table id="example2" class="table data-table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Obra</th>
                                        <th>Materiales</th>
                                        <th>Herramientas</th>
                                        <th>Personal</th>
                                        <th>Aprobado por Administrador</th>
                                        <th>Aprobado por Auxiliar</th>
                                        <th>Fecha Registro</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($solicitud_obras as $solicitud_obra)
                                        <tr>
                                            <td>{{ $cont++ }}</td>
                                            <td>{{ $solicitud_obra->obra->nombre }}</td>
                                            <td>{{ $solicitud_obra->c_material }}</td>
                                            <td>{{ $solicitud_obra->c_herramientas }}</td>
                                            <td>{{ $solicitud_obra->c_personal }}</td>
                                            <td><span
                                                    class="text-xs badge badge-{{ strtolower($solicitud_obra->aprobado_admin ? 'success' : 'danger') }}">{{ $solicitud_obra->aprobado_admin_txt }}</span>
                                            </td>
                                            <td><span
                                                    class="text-xs badge badge-{{ strtolower($solicitud_obra->aprobado_aux ? 'success' : 'danger') }}">{{ $solicitud_obra->aprobado_aux_txt }}</span>
                                            </td>
                                            <td>{{ $solicitud_obra->fecha_registro }}</td>
                                            <td class="btns-opciones">
                                                <a href="{{ route('solicitud_obras.show', $solicitud_obra->id) }}"
                                                    class="ir-evaluacion"><i class="fa fa-eye" data-toggle="tooltip"
                                                        data-placement="left" title="Ver Solicitud"></i></a>
                                                @if (Auth::user()->tipo == 'JEFE DE OBRA' && $solicitud_obra->obra->estado != 'CONCLUIDA')
                                                    <a href="{{ route('solicitud_obras.edit', $solicitud_obra->id) }}"
                                                        class="modificar"><i class="fa fa-edit" data-toggle="tooltip"
                                                            data-placement="left" title="Modificar"></i></a>
                                                    <a href="#"
                                                        data-url="{{ route('solicitud_obras.destroy', $solicitud_obra->id) }}"
                                                        data-toggle="modal" data-target="#modal-eliminar"
                                                        class="eliminar"><i class="fa fa-trash" data-toggle="tooltip"
                                                            data-placement="left" title="Eliminar"></i></a>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
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

        $('table.data-table').DataTable({
            columns: [{
                    width: "5%"
                },
                null,
                null,
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

        // ELIMINAR
        $(document).on('click', 'table tbody tr td.btns-opciones a.eliminar', function(e) {
            e.preventDefault();
            let material = $(this).parents('tr').children('td').eq(1).text();
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar la solicitud?`);
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
