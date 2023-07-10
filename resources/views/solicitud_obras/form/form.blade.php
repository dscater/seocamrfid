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

                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<div id="eliminados" class="oculto">

</div>
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
