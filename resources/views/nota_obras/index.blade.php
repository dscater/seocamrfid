@extends('layouts.app')

@section('css')
@endsection

@section('content')
    <div class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class="m-0 text-dark">Obras - Notas {{ $obra->nombre }}</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{ route('home') }}">Inicio</a></li>
                        <li class="breadcrumb-item active">Materiales</li>
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
                                        <a href="{{ route('nota_obras.create', $obra->id) }}"
                                            class="btn btn-primary btn-block"><i class="fa fa-plus"></i> Nueva Nota
                                            {{ $obra->nombre }}</a>
                                    </div>
                                @endif
                            </div>
                        </div>
                        <div class="card-body">
                            <div class="row contenedor_notas">
                                @foreach ($nota_obras as $value)
                                    <div class="card col-md-12">
                                        <div class="card-body">
                                            <p><strong>Nota: </strong><span>{{ $value->nota }}</span></p>
                                            <p class="mb-0"><strong>Fecha de registro:
                                                </strong>{{ $value->fecha_registro }}</p>
                                        </div>
                                        @if (Auth::user()->tipo == 'JEFE DE OBRA')
                                            <div class="card-footer">
                                                <div class="row">
                                                    <div class="col-md-12">
                                                        <a href="{{ route('nota_obras.edit', $value->id) }}"
                                                            class="btn btn-warning modificar"><i class="fa fa-edit"
                                                                data-toggle="tooltip" data-placement="left"
                                                                title="Modificar"></i></a>
                                                        <a href="#"
                                                            data-url="{{ route('nota_obras.destroy', $value->id) }}"
                                                            data-toggle="modal" data-target="#modal-eliminar"
                                                            class="eliminar btn btn-danger text-sm"><i class="fa fa-trash"
                                                                data-toggle="tooltip" data-placement="left"
                                                                title="Eliminar"></i></a>
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

        // ELIMINAR
        $(document).on('click', '.contenedor_notas a.eliminar', function(e) {
            e.preventDefault();
            let nota = $(this).parents('.card').find('p').eq(0).children("span").text();
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar la nota <b>${nota}</b>?`);
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
