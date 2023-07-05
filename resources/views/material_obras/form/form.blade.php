<div class="row">
    <div class="col-md-12">
        <table class="table table-bordered">
            <tbody>
                <tr>
                    <td class="bg-teal" width="150px">Nombre: </td>
                    <td>{{ $obra->nombre }}</td>
                </tr>
                <tr>
                    <td class="bg-teal">Descripción: </td>
                    <td>{{ $obra->descripcion }}</td>
                </tr>
            </tbody>
        </table>
    </div>
</div>
<div class="row">
    @if (Auth::user()->tipo == 'JEFE DE OBRA')
        <div class="col-md-12">
            <div class="alert alert-success bg-teal">REGISTRAR SALIDA DE MATERIALES</div>
        </div>
        <input type="hidden" name="tipo" value="SALIDA">
    @else
        <div class="col-md-12">
            <div class="alert alert-success bg-teal">REGISTRAR INGRESO DE MATERIALES</div>
        </div>
        <input type="hidden" name="tipo" value="INGRESO">
    @endif
    </div>
<input type="hidden" name="obra_id" value="{{ $obra->id }}">
<div class="row">
    <div class="col-md-8">
        <div class="form-group">
            <label>Seleccionar Material*</label>
            {{ Form::select('material_id', $array_materials, null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
    <div class="col-md-4">
        <div class="form-group">
            <label>Cantidad*</label>
            {{ Form::number('cantidad', null, ['class' => 'form-control', 'required']) }}
        </div>
    </div>
</div>

{{-- <div class="row">
    <div class="col-md-12">
        <div class="form-group">
            <label>Tipo*</label>
            {{ Form::select(
    'tipo',
    [
        '' => 'Seleccione...',
        'INGRESO' => 'INGRESO',
        'SALIDA' => 'SALIDA',
    ],
    null,
    ['class' => 'form-control'],
) }}
        </div>
    </div>
</div> --}}
