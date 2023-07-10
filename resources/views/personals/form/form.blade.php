<div class="row">
    <div class="col-md-4">
        <div class="form-group">
            <label>Nombre*</label>
            {{ Form::text('nombre', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Paterno*</label>
            {{ Form::text('paterno', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Materno</label>
            {{ Form::text('materno', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>C.I.*</label>
            {{ Form::number('ci', null, ['class' => 'form-control', 'required']) }}
            @if ($errors->has('ci'))
                <span class="invalid-feedback" style="color:red;display:block" role="alert">
                    <strong>{{ $errors->first('ci') }}</strong>
                </span>
            @endif
        </div>
    </div>
    <div class="col-md-2">
        <div class="form-group">
            <label>Expedido*</label>
            {{ Form::select(
                'ci_exp',
                [
                    '' => 'Seleccione...',
                    'LP' => 'LA PAZ',
                    'CB' => 'COCHABAMBA',
                    'SC' => 'SANTA CRUZ',
                    'PT' => 'POTOSI',
                    'OR' => 'ORURO',
                    'CH' => 'CHUQUISACA',
                    'TJ' => 'TARIJA',
                    'BN' => 'BENI',
                    'PD' => 'PANDO',
                ],
                null,
                ['class' => 'form-control', 'required'],
            ) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            <label>Domicilio*</label>
            {{ Form::text('domicilio', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Celular</label>
            {{ Form::text('cel', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Foto</label>
            <input type="file" name="foto" class="form-control">
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Familiar Referencia</label>
            {{ Form::text('familiar_referencia', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Teléfono</label>
            {{ Form::text('fono_familiar', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Celular</label>
            {{ Form::text('cel_familiar', null, ['class' => 'form-control']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cargo*</label>
            {{ Form::text('cargo', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Habilitado*</label>
            <input type="checkbox" name="habilitado" value="1"
                {{ isset($personal) && $personal->habilitado ? 'checked' : '' }} data-bootstrap-switch
                data-off-color="danger" data-on-color="success" data-on-text="SI" data-off-text="NO">
        </div>
    </div>
</div>
