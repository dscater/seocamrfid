<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label>Nombre Material*</label>
            {{ Form::text('nombre', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Stock Mínimo*</label>
            {{ Form::number('stock_minimo', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>

<div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Descripción</label>
            {{ Form::text('descripcion', null, ['class' => 'form-control']) }}
        </div>
    </div>
</div>
