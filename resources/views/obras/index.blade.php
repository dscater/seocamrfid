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
                        <li class="breadcrumb-item active">Obras</li>
                    </ol>
                </div>
            </div>
        </div>
    </div>

    <section class="content">
        <div class="container-fluid">

            <div class="row mb-2">
                @if (Auth::user()->tipo == 'ADMINISTRADOR')
                    <div class="col-md-3">
                        <a href="{{ route('obras.create') }}" class="btn btn-primary btn-block">
                            <i class="fa fa-plus"></i>
                            <span>Nueva Obra</span>
                        </a>
                    </div>
                @endif
                @if (Auth::user()->tipo == 'ADMINISTRADOR' || Auth::user()->tipo == 'AUXILIAR')
                    <div class="col-md-3">
                        <a href="{{ route('solicitud_obras.index') }}" class="btn btn-primary btn-block">
                            <i class="fa fa-list-alt"></i>
                            <span>Solicitudes</span>
                        </a>
                    </div>
                @endif
            </div>
            <div class="row mb-1">
                <div class="col-md-4" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <div class="row">
                            <div class="col-md-12">
                                <input type="text" id="txtBusca" class="form-control" placeholder="Nombre Obra...">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-md-2" style="margin-top:5px;">
                    <div class="panel panel-default">
                        <div class="row">
                            <div class="col-md-12">
                                <button class="btn btn-default" type="button" id="btnBuscar" style="width:100%;"><i
                                        class="fa fa-search"></i> BUSCAR</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row mt-1 contenedor_lista" id="contenedorLista">
                @include('obras.parcial.lista')
            </div>
        </div>
    </section>

    @include('modal.eliminar')
    @include('modal.copiar')
    <input type="hidden" value="{{ route('obras.index') }}" id="urlLista">

@section('scripts')
    <script>
        @if (session('bien'))
            mensajeNotificacion('{{ session('bien') }}', 'success');
            let mensaje = `{{ session('bien') }}`;
            @if (session('no_asignadas') == 'si')
                mensaje += "<br>Herramientas no asignadas:<br>{!! session('herramientas_no_asignadas') !!}";
            @endif
            swal.fire({
                title: "Correcto",
                icon: "success",
                html: mensaje,
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#28a745",
            });
        @endif

        @if (session('info'))
            mensajeNotificacion('{{ session('info') }}', 'info');
        @endif

        @if (session('error'))
            mensajeNotificacion('{{ session('error') }}', 'error');
        @endif

        // COPIAR
        $(document).on('click', '.opciones .dropdown a.copiar', function(e) {
            e.preventDefault();
            $("#txtNombre").val("");
            let registro = $(this).attr('data-info');
            $('#mensajeCopiar').html(`¿Está seguro(a) de copiar al registro <b>${registro}</b>?`);
            let url = $(this).attr('data-url');
            $('#formCopiar').prop('action', url);
        });

        $('#btnCopiar').click(function() {
            $(this).prop("disabled", true);
            $(this).text("Copiando...");
            if ($("#txtNombre").val().trim() != "") {
                $('#formCopiar').submit();
            } else {
                swal.fire({
                    title: "Error",
                    icon: "error",
                    text: "Debes llenar todos los campos",
                    confirmButtonText: "Aceptar",
                    confirmButtonColor: "#28a745",
                });
                $(this).removeAttr("disabled");
                $(this).text("Si, copiar");
            }
        });

        // ELIMINAR-NUEVO
        $(document).on('click', '.opciones .dropdown a.eliminar', function(e) {
            e.preventDefault();
            let registro = $(this).attr('data-info');
            $('#mensajeEliminar').html(`¿Está seguro(a) de eliminar al registro <b>${registro}</b>?`);
            let url = $(this).attr('data-url');
            $('#formEliminar').prop('action', url);
        });

        $('#btnEliminar').click(function() {
            $('#formEliminar').submit();
        });

        $('#btnBuscar').click(cargaLista);

        $('#txtBusca').on('keyup', function() {
            cargaLista();
        });

        function cargaLista() {
            $('#contenedorLista').html('<div class="col-md-12">Cargando...</div>');
            $.ajax({
                type: "GET",
                url: $('#urlLista').val(),
                data: {
                    texto: $('#txtBusca').val(),
                    fecha: $('#txtFecha').val(),
                },
                dataType: "json",
                success: function(response) {
                    $('#contenedorLista').html(response.html);
                }
            });
        }
    </script>
@endsection
@endsection
