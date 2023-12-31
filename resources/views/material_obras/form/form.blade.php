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
<div class="row mb-2">
    <div class="col-md-6">
        <button type="button" id="btnIngresos" class="btn bg-teal btn-block"><i class="fa fa-sign-in-alt"></i>
            INGRESOS</button>
    </div>
    <div class="col-md-6">
        <button type="button" id="btnSalidas" class="btn bg-teal btn-block"><i class="fa fa-sign-out-alt"></i>
            SALIDAS</button>
    </div>
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
@include('material_obras.parcial.ingresos')
@include('material_obras.parcial.salidas')
