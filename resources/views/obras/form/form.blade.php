<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nombre*</label>
            {{ Form::text('nombre', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Fecha*</label>
            {{ Form::date('fecha_obra', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Jefe de Obra*</label>
            {{ Form::select('jefe_id', $array_jefes, null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Auxiliar*</label>
            {{ Form::select('auxiliar_id', $array_auxiliars, null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-8">
        <div class="form-group">
            <label>Descripción</label>
            {{ Form::text('descripcion', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
