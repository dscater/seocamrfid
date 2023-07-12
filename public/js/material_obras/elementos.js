let elemento_ingreso = `<div class="col-md-12 elemento" data-id="0" data-disponible="">
<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col-md-12">
                <button class="quitar btn btn-danger btn-xs float-right"><i
                        class="text-xs fa fa-times"></i></button>
                <span class="font-weight-bold nombre_material">Material 1</span>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row">
            <div class="col-md-12 el_ingreso">
                <label>Cantidad que ingresara:</label>
                <input type="hidden" class="form-control i_solicitud_id" name="solicitud_id_ingresos[]">
                <input type="hidden" class="form-control i_ingreso_material_id" name="material_id_ingresos[]">
                <input type="number" class="form-control i_ingreso_cantidad" name="cantidad_ingresos[]">
            </div>
        </div>
    </div>
</div>
</div>`;
