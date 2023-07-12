<div class="row" id="principal_ingresos">
    <div class="col-md-12">
        <h4 class="card-title">Materiales Solicitados</h4>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Nro. Solicitud</th>
                    <th>Material</th>
                    <th>Cantidad Solicitada</th>
                    <th>Disponible</th>
                    <th>Usado</th>
                    <th>Aprobado</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="listaSolicitudIngresos">
                @if (count($obra->solicitud_obras) > 0)
                    @php
                        $cont = 1;
                    @endphp
                    @foreach ($obra->solicitud_obras as $key => $solicitud)
                        @foreach ($solicitud->solicitud_materials as $sm)
                            <tr data-id="{{ $sm->id }}" data-material="{{ $sm->material->id }}"
                                data-disponible="{{ $sm->disponible }}" class="fila">
                                <td>{{ $cont++ }}</td>
                                <td>{{ $key + 1 }}</td>
                                <td>{{ $sm->material->nombre }}</td>
                                <td>{{ $sm->cantidad }}</td>
                                <td>{{ $sm->disponible }}</td>
                                <td>{{ $sm->cantidad_usada }}</td>
                                <td>
                                    <div>
                                        <p><strong>Administrador:</strong><span
                                                class="text-xs badge badge-{{ $sm->aprobado_admin ? 'success' : 'danger' }}">{{ $sm->aprobado_admin ? 'SI' : 'NO' }}</span>
                                        </p>
                                        <p><strong>Auxiliar:</strong><span
                                                class="text-xs badge badge-{{ $sm->aprobado_aux ? 'success' : 'danger' }}">{{ $sm->aprobado_aux ? 'SI' : 'NO' }}</span>
                                        </p>
                                    </div>
                                </td>
                                <td class="text-center accion">
                                    @if ($sm->aprobado_admin && $sm->aprobado_aux)
                                        <button type="button" class="btn btn-primary btn-xs btn_ingresa"
                                            {{ $sm->disponible <= 0 ? 'disabled' : '' }}>Ingresar a la
                                            obra</button>
                                    @else
                                        Esperando aprobación
                                    @endif
                                </td>
                            </tr>
                        @endforeach
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
        <form action="">
            <div class="row">
                <div class="col-md-12">
                    <h4>Lista de Materiales a Ingresar</h4>
                </div>
            </div>
            <div class="row" id="contenedor_ingresos">

            </div>
            @if ($errors->any())
                <div class="row">
                    <div class="col-md-12 alert alert-danger">
                        Tienes los sgtes. errores:
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>
            @endif
            <button class="btn btn-primary"><i class="fa fa-save"></i> REGISTRAR INGRESOS</button>
        </form>
    </div>
</div>
