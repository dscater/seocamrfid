@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Personal</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
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
                            {{-- <h3 class="card-title"></h3> --}}
                            <a href="{{ route('personals.create') }}" class="btn btn-info"><i class="fa fa-plus"></i>
                                Nuevo</a>
                        </div>
                        <!-- /.card-header -->
                        <div class="card-body">
                            <table id="example2" class="table data-table table-bordered table-hover">
                                <thead>
                                    <tr>
                                        <th>Nº</th>
                                        <th>Nombre</th>
                                        <th>C.I.</th>
                                        <th>Celular</th>
                                        <th>Foto</th>
                                        <th>Domicilio</th>
                                        <th>Habilitado</th>
                                        <th>Fecha Registro</th>
                                        <th>Opciones</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $cont = 1;
                                    @endphp
                                    @foreach ($personals as $personal)
                                        <tr>
                                            <td>{{ $cont++ }}</td>
                                            <td>{{ $personal->nombre }} {{ $personal->paterno }} {{ $personal->materno }}
                                            </td>
                                            <td>{{ $personal->ci }} {{ $personal->ci_exp }}</td>
                                            <td>{{ $personal->cel }}</td>
                                            <td><img src="{{ asset('imgs/personals/' . $personal->foto) }}" alt="Foto"
                                                    class="img-table"></td>
                                            <td>{{ $personal->domicilio }}</td>
                                            <td><span
                                                    class="text-xs badge{{ $personal->habilitado ? ' badge-success' : ' badge-danger' }}">{{ $personal->habilitado_txt }}</span>
                                            </td>
                                            <td>{{ $personal->fecha_registro }}</td>
                                            <td class="btns-opciones">
                                                <a href="{{ route('personals.edit', $personal->id) }}" class="modificar"><i
                                                        class="fa fa-edit" data-toggle="tooltip" data-placement="left"
                                                        title="Modificar"></i></a>
                                                <a href="#"
                                                    data-url="{{ route('personals.destroy', $personal->id) }}"
                                                    data-toggle="modal" data-target="#modal-eliminar" class="eliminar"><i
                                                        class="fa fa-trash" data-toggle="tooltip" data-placement="left"
                                                        title="Eliminar"></i></a>
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
                {
                    width: "15%"
                },
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
            let personal = $(this).parents('tr').children('td').eq(1).text();
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar al personal <b>${personal}</b>?`);
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
