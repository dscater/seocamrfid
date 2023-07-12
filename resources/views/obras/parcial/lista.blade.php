@if (count($obras) > 0)
    @foreach ($obras as $obra)
        <div class="elemento">
            <div class="card">
                <div class="card-body">
                    <div class="contenedor_cliente">
                        @if (Auth::user()->tipo == 'ADMINISTRADOR')
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
                        @endif
                        <div class="nombre_cliente">
                            <a href="{{ route('obras.show', $obra->id) }}">{{ $obra->nombre }}</a>
                        </div>
                        <div class="ocupacion_cliente">
                            {{ $obra->descripcion }}
                        </div>
                        <div class="ocupacion_cliente">
                            <span
                                class="badge badge-{{ $obra->estado == 'POR INICIAR' ? 'warning' : ($obra->estado == 'EN PROCESO' ? 'primary' : 'success') }} text-xs">{{ $obra->estado }}</span>
                        </div>
                        <div class="info_adicional">
                            Jefe de Obra: {{ $obra->jefe_obra ? $obra->jefe_obra->full_name : 'S/A' }}
                        </div>
                        <div class="info_adicional">
                            Auxiliar: {{ $obra->auxiliar ? $obra->auxiliar->full_name : 'S/A' }}
                        </div>
                        <div class="info_adicional">
                            Materiales asignados: <span
                                class="badge bg-{{ $obra->c_material > 0 ? 'success' : 'danger' }}">{{ $obra->c_material }}</span>
                        </div>
                        <div class="info_adicional">
                            Materiales con stock bajo: <span
                                class="badge bg-{{ $obra->stock_bajo > 0 ? 'success' : 'danger' }}">{{ $obra->stock_bajo }}</span>
                        </div>
                        <div class="info_adicional">
                            Cantidad Personal: <span
                                class="badge bg-{{ $obra->c_personal > 0 ? 'success' : 'danger' }}">{{ $obra->c_personal }}</span>
                        </div>
                        <div class="info_adicional">
                            Cantidad Herramientas: <span
                                class="badge bg-{{ $obra->c_herramientas > 0 ? 'success' : 'danger' }}">{{ $obra->c_herramientas }}</span>
                        </div>
                        @if (Auth::user()->tipo == 'JEFE DE OBRA')
                            <div class="info_adicional">
                                <a href="{{ route('movimientos.index', $obra->id) }}"
                                    class="btn bg-teal btn-flat btn-block">Administrar Movmientos</a>
                            </div>
                        @endif
                        <div class="info_adicional mt-1">
                            <a href="{{ route('solicitud_obras.solicitudes_obra', $obra->id) }}"
                                class="btn btn-primary text-white btn-flat btn-block">Solicitudes
                                ({{ $obra->c_solicitudes }})
                            </a>
                        </div>
                        <div class="info_adicional mt-1">
                            <a href="{{ route('nota_obras.index', $obra->id) }}"
                                class="btn bg-lime text-white btn-flat btn-block">Notas
                                ({{ count($obra->nota_obras) }})
                            </a>
                        </div>
                        <div class="info_adicional mt-1">
                            <a href="{{ route('obras.show', $obra->id) }}"
                                class="btn btn-info text-white btn-flat btn-block">Ver
                                Obra</a>
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
