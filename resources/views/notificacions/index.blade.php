@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Notificaciones</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Notificaciones</li>
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
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table data-table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Tipo</th>
                                        <th>Registro</th>
                                        <th>Mensaje</th>
                                        <th>Acción</th>
                                        <th>Fecha Hora</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($notificacions as $notificacion)
                                        <tr>
                                            <td>{{ $cont++ }}</td>
                                            <td>{{ $notificacion->notificacion->tipo }}</td>
                                            @if ($notificacion->notificacion->tipo == 'MATERIAL')
                                                <td>{{ $notificacion->notificacion->material->mo->material->nombre }}</td>
                                            @else
                                                <td>{{ $notificacion->notificacion->monitoreo->herramienta->nombre }}</td>
                                            @endif
                                            <td>{{ $notificacion->notificacion->mensaje }}</td>
                                            <td>{{ $notificacion->notificacion->accion }}</td>
                                            <td>{{ date('d/m/Y H:i a', strtotime($notificacion->notificacion->fecha . ' ' . $notificacion->notificacion->hora)) }}
                                            </td>
                                            <td class="btns-opciones">
                                                <a href="{{ route('notificacions.show', $notificacion->id) }}"
                                                    class="evaluar"><i class="fa fa-eye" data-toggle="tooltip"
                                                        data-placement="left" title="Ver"></i></a>
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
            mensajeNotificacion('{{ session('bien') }}','success');
        @endif

        @if (session('info'))
            mensajeNotificacion('{{ session('info') }}','info');
        @endif

        @if (session('error'))
            mensajeNotificacion('{{ session('error') }}','error');
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
                {
                    width: "5%"
                },
            ],
            scrollCollapse: true,
            language: lenguaje,
            pageLength: 25
        });


        // ELIMINAR
        $(document).on('click', 'table tbody tr td.btns-opciones a.eliminar', function(e) {
            e.preventDefault();
            let notificacion = $(this).parents('tr').children('td').eq(1).text();
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar la notificacion <b>${notificacion}</b>?`);
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
