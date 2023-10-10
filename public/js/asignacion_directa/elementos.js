let elem_material = ` <div class="col-md-12 elem">
<div class="card contenedor_datos">
    <div class="card-body pb-1">
        <input type="hidden" name="materials[]" class="valores" value="0|1|20">
        <p class="mb-1 editable">
            <strong>Nombre: </strong><span>Material #1</span>
            <select name="" id="" data-index="1" class="input_form oculto">
            </select>
        </p>
        <p class="mb-0 editable">
            <strong>Cantidad: </strong> <span>1</span>
            <input type="number" data-index="2" value="1" class="input_form oculto">
        </p>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-xs btn-danger eliminar"><i
                class="fa fa-trash"></i></button>
        <button type="button" class="btn btn-xs btn-warning editar"><i
                class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-xs btn-success actualizar oculto"><i
                class="fa fa-check"></i></button>
        <button type="button" class="btn btn-xs btn-info cancelar oculto"><i
                class="fa fa-times"></i></button>
    </div>
</div>
</div>`;

let elem_herramienta = `  <div class="col-md-12 elem">
<div class="card contenedor_datos">
    <div class="card-body pb-1">
        <input type="hidden" name="herramientas[]" class="valores" value="0|1|10|2023-07-10|2023-07-20">
        <p class="mb-0 editable">
            <strong>Nombre: </strong><span>Herramienta #1</span>
            <select name="" id="" data-index="1" class="input_form oculto">
            </select>
        </p>
        <p class="mb-0 editable">
            <strong>Días uso: </strong> <span>1</span>
            <input type="number" data-index="2" value="2" class="input_form oculto">
        </p>
        <p class="mb-0 editable">
            <strong>Fecha Asignación: </strong> <span>2023-07-10</span>
            <input type="date" data-index="3" value="2023-07-10" class="input_form oculto">
        </p>
        <p class="mb-0 editable">
            <strong>Fecha Finalización: </strong> <span>2023-07-20</span>
            <input type="date" data-index="4" value="2023-07-20" class="input_form oculto">
        </p>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-xs btn-danger eliminar"><i
                class="fa fa-trash"></i></button>
        <button type="button" class="btn btn-xs btn-warning editar"><i
                class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-xs btn-success actualizar oculto"><i
                class="fa fa-check"></i></button>
        <button type="button" class="btn btn-xs btn-info cancelar oculto"><i
                class="fa fa-times"></i></button>
    </div>
</div>
</div>`;

let elem_personal = ` <div class="col-md-12 elem">
<div class="card contenedor_datos">
    <div class="card-body pb-1">
        <input type="hidden" name="personals[]" class="valores" value="0|1">
        <p class="mb-1 editable">
            <strong>Nombre: </strong><span>Juan Perez</span>
            <select name="" id="" data-index="1" class="input_form oculto">
                <option value="">Personal...</option>
            </select>
        </p>
    </div>
    <div class="card-footer">
        <button type="button" class="btn btn-xs btn-danger eliminar"><i
                class="fa fa-trash"></i></button>
        <button type="button" class="btn btn-xs btn-warning editar"><i
                class="fa fa-edit"></i></button>
        <button type="button" class="btn btn-xs btn-success actualizar oculto"><i
                class="fa fa-check"></i></button>
        <button type="button" class="btn btn-xs btn-info cancelar oculto"><i
                class="fa fa-times"></i></button>
    </div>
</div>
</div>`;

let eliminados_material = $("#eliminados_material");
let input_eliminado_material = `<input type="text" name="eliminados_material[]">`;
let eliminados_herramientas = $("#eliminados_herramientas");
let input_eliminado_herramientas = `<input type="text" name="eliminados_herramientas[]">`;
let eliminados_personal = $("#eliminados_personal");
let input_eliminado_personal = `<input type="text" name="eliminados_personal[]">`;