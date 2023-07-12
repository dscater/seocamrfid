<div class="row oculto" id="principal_salidas">
    <div class="col-md-12">
        <h4 class="card-title">Materiales Solicitados</h4>
    </div>
    <div class="col-md-12">
        <table class="table table-bordered">
            <thead>
                <tr>
                    <th>#</th>
                    <th>Material</th>
                    <th>Stock Actual</th>
                    <th>Acción</th>
                </tr>
            </thead>
            <tbody id="listaSolicitudSalidas">
                @if (count($obra->materials) > 0)
                    @php
                        $cont = 1;
                    @endphp
                    @foreach ($obra->materials as $key => $material_obra)
                        <tr data-id="{{ $material_obra->id }}" data-material="{{ $material_obra->material->id }}"
                            data-disponible="{{ $material_obra->stock_actual }}" class="fila">
                            <td>{{ $cont++ }}</td>
                            <td>{{ $material_obra->material->nombre }}</td>
                            <td>{{ $material_obra->stock_actual }}</td>
                            <td class="text-center accion">
                                @if ($material_obra->stock_actual > 0)
                                    <button type="button" class="btn btn-primary btn-xs btn_ingresa">Agregar</button>
                                @else
                                    Sin stock
                                @endif
                            </td>
                        </tr>
                    @endforeach
                @else
                    <tr>
                        <td colspan="4" class="text-center font-weight-bold">NO SE ENCONTRÓ NINGUN MATERIAL</td>
                    </tr>
                @endif
            </tbody>
        </table>
    </div>
    <div class="col-md-12">
        {{ Form::open(['route' => 'material_obras.store', 'method' => 'post', 'files' => true]) }}
        <div class="row">
            <div class="col-md-12">
                <h4 class="text-center font-weight-bold">Lista de Materiales Agregados para Salida</h4>
                <hr>
            </div>
        </div>
        <input type="hidden" name="obra_id"value="{{ $obra->id }}">
        <input type="hidden" name="tipo"value="SALIDA">
        <div class="row mb-3" id="contenedor_salidas">
        </div>
        <button class="btn btn-primary"><i class="fa fa-sign-out-alt"></i> REGISTRAR SALIDAS</button>
        {{ Form::close() }}
    </div>
</div>
