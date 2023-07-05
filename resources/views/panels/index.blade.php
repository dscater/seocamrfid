@extends('layouts.app')

@section('css')
<link rel="stylesheet" href="{{asset('css/panels/index.css')}}">
@endsection

@section('content')
<div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0 text-dark">Panel de Control</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('home')}}">Inicio</a></li>
                    <li class="breadcrumb-item active">Panel de Control</li>
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
                                    <th>Rfid</th>
                                    <th>Ubicación</th>
                                    <th>Activo</th>
                                    <th>Imagen</th>
                                    <th>Estado</th>
                                    <th>Usuario</th>
                                    <th>Opciones</th>
                                </tr>
                            </thead>
                            <tbody id="contenedor_panel">
                                @php
                                    $cont = 1;
                                @endphp
                                @foreach($panels as $panel)
                                @php
                                    $class_estado = 'fuera';
                                    if($panel->estado != 'FUERA DE LA UBICACIÓN')
                                    {
                                        $class_estado = 'dentro';
                                    }
                                @endphp
                                <tr id="ac{{$panel->id}}">
                                    <td>{{$cont++}}</td>
                                    <td>{{$panel->activo->rfid}}</td>
                                    <td>{{$panel->activo->ubicacion->unidad->nombre}} - {{$panel->activo->ubicacion->edificio->nombre}} - {{$panel->activo->ubicacion->piso->nombre}} - {{$panel->activo->ubicacion->oficina->nombre}}</td>
                                    <td>{{$panel->activo->item}} ({{$panel->activo->descripcion? :'S/D'}}) - {{$panel->activo->nro_item}} - {{$panel->activo->nro_serie}}</td>
                                    <td><img src="{{asset('imgs/activos/'.$panel->activo->foto)}}" alt="Foto" class="img-table"></td>
                                    <td class="estado {{$class_estado}}">{{$panel->estado}}</td>
                                    <td>{{$panel->user->name}}</td>
                                    <td class="btns-opciones">
                                        @if(Auth::user()->tipo == 'ADMINISTRADOR')
                                        <a href="#" class="evaluar" data-url="{{route('panels.update',$panel->id)}}"><i class="fa fa-key" data-toggle="tooltip" data-placement="left" title="Usuario"></i></a>
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

@include('modal.user_control')
<input type="hidden" id="urlListaEstados" value="{{route('panels.listaEstados')}}">
@section('scripts')
<script src="{{asset('js/panels/index.js')}}"></script>
<script>
    @if(session('bien'))
    mensajeNotificacion('{{session('bien')}}','success');
    @endif

    @if(session('info'))
    mensajeNotificacion('{{session('info')}}','info');
    @endif

    @if(session('error'))
    mensajeNotificacion('{{session('error')}}','error');
    @endif


     $('table.data-table').DataTable({
        responsive: true,
        columns : [
            {width:"5%"},
            null,
            null,
            null,
            null,
            null,
            null,
            {width:"5%"},
        ],
        scrollCollapse: true,
        language: lenguaje,
        pageLength:25
    });

 
    // ELIMINAR
    $(document).on('click','table tbody tr td.btns-opciones a.evaluar',function(e){
        e.preventDefault();
        let url = $(this).attr('data-url');
        console.log($(this).attr('data-url'));
        $('#formUpdateControl').prop('action',url);
        $('#modal-user_control').modal('toggle');
    });

    $('#btnActualizaControl').click(function(){
        // $('#formUpdateControl').submit();
    });

</script>
@endsection

@endsection
