<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">MATERIALES</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Seleccione:</label>
                        <select name="" id="material_id" class="form-control select2">
                            <option value="">Material...</option>
                            @foreach ($materiales as $value)
                                <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Cantidad:</label>
                        <input type="number" class="form-control" id="cantidad_material">
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-flat btn-block btn-sm"
                            type="button"id="btnAgregarMaterial"><i class="fa fa-plus"></i> Agregar</button>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="contenedor_material">
                            @if (isset($solicitud_obra))
                                @foreach ($solicitud_obra->solicitud_materials as $value)
                                    <div class="col-md-12 elem">
                                        <div class="card contenedor_datos">
                                            <div class="card-body pb-1">
                                                <input type="hidden" name="materials[]" class="valores"
                                                    value="{{ $value->id }}|{{ $value->material_id }}|{{ $value->cantidad }}">
                                                <p class="mb-1 editable">
                                                    <strong>Nombre: </strong><span>{{ $value->material->nombre }}</span>
                                                    <select name="" id="" data-index="1"
                                                        class="input_form oculto">
                                                    </select>
                                                </p>
                                                <p class="mb-0 editable">
                                                    <strong>Cantidad: </strong> <span>{{ $value->cantidad }}</span>
                                                    <input type="number" data-index="2" value="{{ $value->cantidad }}"
                                                        class="input_form oculto">
                                                </p>
                                            </div>
                                            @if ($obra->estado != 'CONCLUIDA')
                                                <div class="card-footer">
                                                    <button type="button" class="btn btn-xs btn-danger eliminar"><i
                                                            class="fa fa-trash"></i></button>
                                                    <button type="button" class="btn btn-xs btn-warning editar"><i
                                                            class="fa fa-edit"></i></button>
                                                    <button type="button"
                                                        class="btn btn-xs btn-success actualizar oculto"><i
                                                            class="fa fa-check"></i></button>
                                                    <button type="button"
                                                        class="btn btn-xs btn-info cancelar oculto"><i
                                                            class="fa fa-times"></i></button>
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">HERRAMIENTAS</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Seleccione:</label>
                        <select name="" id="herramienta_id" class="form-control select2 oculto">
                            <option value="">Herramienta...</option>
                            @foreach ($herramientas as $value)
                                <option value="{{ $value->id }}">{{ $value->nombre }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12 form-group">
                        <label>Días Uso:</label>
                        <input type="number" class="form-control" id="dias_uso">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Fecha Asignación:</label>
                        <input type="date" class="form-control" id="fecha_asignacion">
                    </div>
                    <div class="col-md-6 form-group">
                        <label>Fecha Finalización:</label>
                        <input type="date" class="form-control" id="fecha_finalizacion">
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-flat btn-block btn-sm"
                            type="button"id="btnAgregarHerramienta"><i class="fa fa-plus"></i> Agregar</button>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="contenedor_herramientas">
                            @if (isset($solicitud_obra))
                                @foreach ($solicitud_obra->solicitud_herramientas as $value)
                                    <div class="col-md-12 elem">
                                        <div class="card contenedor_datos">
                                            <div class="card-body pb-1">
                                                <input type="hidden" name="herramientas[]" class="valores"
                                                    value="{{ $value->id }}|{{ $value->herramienta_id }}|{{ $value->dias_uso }}|{{ $value->fecha_asignacion }}|{{ $value->fecha_finalizacion }}">
                                                <p class="mb-0 editable">
                                                    <strong>Nombre:
                                                    </strong><span>{{ $value->herramienta->nombre }}</span>
                                                    <select name="" id="" data-index="1"
                                                        class="input_form oculto">
                                                    </select>
                                                </p>
                                                <p class="mb-0 editable">
                                                    <strong>Días uso: </strong> <span>{{ $value->dias_uso }}</span>
                                                    <input type="number" data-index="2"
                                                        value="{{ $value->dias_uso }}" class="input_form oculto">
                                                </p>
                                                <p class="mb-0 editable">
                                                    <strong>Fecha Asignación: </strong>
                                                    <span>{{ $value->fecha_asignacion }}</span>
                                                    <input type="date" data-index="3"
                                                        value="{{ $value->fecha_asignacion }}"
                                                        class="input_form oculto">
                                                </p>
                                                <p class="mb-0 editable">
                                                    <strong>Fecha Finalización: </strong>
                                                    <span>{{ $value->fecha_finalizacion }}</span>
                                                    <input type="date" data-index="4"
                                                        value="{{ $value->fecha_finalizacion }}"
                                                        class="input_form oculto">
                                                </p>
                                            </div>
                                            @if ($obra->estado != 'CONCLUIDA')
                                                <div class="card-footer">
                                                    @if (!$value->asignado)
                                                        <button type="button"
                                                            class="btn btn-xs btn-danger eliminar"><i
                                                                class="fa fa-trash"></i></button>
                                                        <button type="button"
                                                            class="btn btn-xs btn-warning editar"><i
                                                                class="fa fa-edit"></i></button>
                                                        <button type="button"
                                                            class="btn btn-xs btn-success actualizar oculto"><i
                                                                class="fa fa-check"></i></button>
                                                        <button type="button"
                                                            class="btn btn-xs btn-info cancelar oculto"><i
                                                                class="fa fa-times"></i></button>
                                                    @else
                                                        <span class="text-md badge badge-info">Asignado</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">
                <h4 class="card-title">PERSONAL</h4>
            </div>
            <div class="card-body">
                <div class="row">
                    <div class="col-md-12 form-group">
                        <label>Seleccione:</label>
                        <select name="" id="personal_id" class="form-control select2">
                            <option value="">Personal...</option>
                            @foreach ($personals as $value)
                                <option value="{{ $value->id }}">{{ $value->full_name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-md-12">
                        <button class="btn btn-primary btn-flat btn-block btn-sm"
                            type="button"id="btnAgregarPersonal"><i class="fa fa-plus"></i> Agregar</button>
                    </div>
                    <div class="col-md-12">
                        <hr>
                    </div>
                    <div class="col-md-12">
                        <div class="row" id="contenedor_personal">
                            @if (isset($solicitud_obra))
                                @foreach ($solicitud_obra->solicitud_personals as $value)
                                    <div class="col-md-12 elem">
                                        <div class="card contenedor_datos">
                                            <div class="card-body pb-1">
                                                <input type="hidden" name="personals[]" class="valores"
                                                    value="{{ $value->id }}|{{ $value->personal_id }}">
                                                <p class="mb-1 editable">
                                                    <strong>Nombre:
                                                    </strong><span>{{ $value->personal->full_name }}</span>
                                                    <select name="" id="" data-index="1"
                                                        class="input_form oculto">
                                                        <option value="">Personal...</option>
                                                    </select>
                                                </p>
                                            </div>
                                            @if ($obra->estado != 'CONCLUIDA')
                                                <div class="card-footer">
                                                    @if (!$value->asignado)
                                                        <button type="button"
                                                            class="btn btn-xs btn-danger eliminar"><i
                                                                class="fa fa-trash"></i></button>
                                                        <button type="button"
                                                            class="btn btn-xs btn-warning editar"><i
                                                                class="fa fa-edit"></i></button>
                                                        <button type="button"
                                                            class="btn btn-xs btn-success actualizar oculto"><i
                                                                class="fa fa-check"></i></button>
                                                        <button type="button"
                                                            class="btn btn-xs btn-info cancelar oculto"><i
                                                                class="fa fa-times"></i></button>
                                                    @else
                                                        <span class="text-md badge badge-info">Asignado</span>
                                                    @endif
                                                </div>
                                            @endif
                                        </div>
                                    </div>
                                @endforeach
                            @endif

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="eliminados_material" class="oculto"></div>
<div id="eliminados_herramientas" class="oculto"></div>
<div id="eliminados_personal" class="oculto"></div>
<div id="eliminados_notas" class="oculto"></div>
{{-- datos para jquery --}}
<select id="select_materiales" class="oculto">
    @foreach ($materiales as $value)
        <option value="{{ $value->id }}">{{ $value->nombre }}</option>
    @endforeach
</select>

<select name="" id="select_herramientas" class="oculto">
    @foreach ($herramientas as $value)
        <option value="{{ $value->id }}">{{ $value->nombre }}</option>
    @endforeach
</select>
<select name="" id="select_personal" class="oculto">
    @foreach ($personals as $value)
        <option value="{{ $value->id }}">{{ $value->full_name }}</option>
    @endforeach
</select>
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
