<div class="row oculto" id="principal_ingresos">
    <div class="col-md-12">
        <h4 class="card-title">Materiales Solicitados</h4>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Material</th>
                    <th>Cantidad Solicitada</th>
                    <th>Disponible</th>
                    <th>Usado</th>
                    <th>Aprobado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="listaSolicitudIngresos">
                @if ($obra->solicitud_obra)
                    @php
                        $cont = 1;
                    @endphp
                    @foreach ($obra->solicitud_obra->solicitud_materials as $sm)
                        <tr data-id="{{ $sm->id }}" data-material="{{ $sm->material->id }}"
                            data-disponible="{{ $sm->disponible }}" class="fila">
                            <td>{{ $cont++ }}</td>
                            <td>{{ $sm->material->nombre }}</td>
                            <td>{{ $sm->cantidad }}</td>
                            <td>{{ $sm->disponible }}</td>
                            <td>{{ $sm->cantidad_usada }}</td>
                            <td>
                                <span
                                    class="text-xs badge badge-{{ $sm->aprobado ? 'success' : 'danger' }}">{{ $sm->aprobado ? 'SI' : 'NO' }}</span>
                            </td>
                            <td class="text-center accion">
                                @if ($sm->aprobado)
                                    @if ($sm->disponible > 0)
                                        <button type="button" class="btn btn-primary btn-xs btn_ingresa">Ingresar a la
                                            obra</button>
                                    @else
                                        No disponible
                                    @endif
                                @else
                                    Esperando aprobación
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="8" class="text-center font-weight-bold">NO SE REALZÓ NINGUNA SOLICITUD</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        {{ Form::open(['route' => 'material_obras.store', 'method' => 'post', 'files' => true]) }}
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center font-weight-bold">Lista de Materiales a Ingresar</h4>
                <hr>
            </div>
        </div>
        <input type="hidden" name="obra_id"value="{{ $obra->id }}">
        <input type="hidden" name="tipo"value="INGRESO">
        <div class="row mb-3" id="contenedor_ingresos">
        </div>
        <button class="btn btn-primary"><i class="fa fa-save"></i> REGISTRAR INGRESOS</button>
        {{ Form::close() }}
    </div>
</div>
