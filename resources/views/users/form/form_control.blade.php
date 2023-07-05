<div class="row">
    <div class="col-md-6">
        <div class="form-group">
            <label>Nombre Control*</label>
            {{ Form::text('name', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-6">
        <div class="form-group">
            @if (isset($user))
                <label>Contraseña</label>
                {{ Form::text('contrasenia', null, ['class' => 'form-control']) }}
            @else
                <label>Contraseña*</label>
                {{ Form::text('contrasenia', null, ['class' => 'form-control', 'required']) }}
            @endif
        </div>
    </div>
</div>
