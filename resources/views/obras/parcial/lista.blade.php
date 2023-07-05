@if (count($obras) > 0)
    @foreach ($obras as $obra)
        <div class="col-md-2">
            <div class="card">
                <div class="card-body">
                    <div class="contenedor_cliente">
                        <div class="opciones">
                            <div class="dropdown">
                                <button class="btn btn-link dropdown-toggle" type="button" id="dropdownMenu1"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                    <i class="fa fa-ellipsis-v"></i>
                                </button>
                                <div class="dropdown-menu dropdown-menu-left" aria-labelledby="dropdownMenu1">
                                    <a href="{{ route('obras.edit', $obra->id) }}" class="dropdown-item"><i
                                            class="fa fa-edit"></i>
                                        Editar</a>
                                    <a href="#" data-url="{{ route('obras.destroy', $obra->id) }}"
                                        data-info="{{ $obra->nombre }}" data-toggle="modal"
                                        data-target="#modal-eliminar" class="eliminar dropdown-item"><i
                                            class="fa fa-trash"></i>
                                        Eliminar</a>
                                </div>
                            </div>
                        </div>
                        <div class="nombre_cliente">
                            <a href="{{ route('material_obras.index', $obra->id) }}">{{ $obra->nombre }}</a>
                        </div>
                        <div class="ocupacion_cliente">
                            {{ $obra->descripcion }}
                        </div>
                        @php
                            $stock_bajo = count(app\MaterialObra::where('obra_id', $obra->id)->where('estado',1)->where('estado_stock','BAJO')->get());
                            $asignados = count(app\MaterialObra::where('obra_id', $obra->id)->where('estado',1)->get());
                        @endphp
                        <div class="info_adicional">
                            Materiales asignados: <span class="badge bg-green">{{ $asignados }}</span>
                        </div>

                        <div class="info_adicional">
                            Materiales con stock bajo: <span class="badge bg-red">{{ $stock_bajo }}</span>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@else
    <div class="col-md-12">
        NO SE ENCONTRARON REGISTROS
    </div>
@endif
