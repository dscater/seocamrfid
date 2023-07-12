let listaSolicitudIngresos = $("#listaSolicitudIngresos");
let contenedor_ingresos = $("#contenedor_ingresos");
$(document).ready(function () {
    listaSolicitudIngresos.on("click", "tr td.accion button", function () {
        let nuevo_elemento = $(elemento_ingreso).clone();
        let fila = $(this).parents("tr.fila");
        let id = fila.attr("data-id");
        let disponible = fila.attr("data-disponible");
        if (!existeElementoIngreso(id) && parseFloat(disponible) > 0) {
            nuevo_elemento.attr("data-id", id);
            let solicitud_id = id;
            let material_id = fila.attr("data-material");
            let cantidad_disp = disponible;
            nuevo_elemento.attr("data-disponible", cantidad_disp);
            nuevo_elemento.find("input.i_solicitud_id").val(solicitud_id);
            nuevo_elemento.find("input.i_ingreso_material_id").val(material_id);
            nuevo_elemento.find("input.i_ingreso_cantidad").val(cantidad_disp);
            contenedor_ingresos.append(nuevo_elemento);
        } else {
            swal.fire({
                title: "Error",
                icon: "error",
                html: "Este material ya se encuentra en la lista o no cuenta con cantidad disponible",
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#28a745",
            });
        }
    });

    contenedor_ingresos.on(
        "keyup change",
        "input.i_ingreso_cantidad",
        function () {
            let disponible = $(this).parents(".elemento").attr("data-disponible");
            let valor = $(this).val();
            console.log("AAA");
            console.log(disponible);
            console.log(valor);
            if (parseFloat(valor) > parseFloat(disponible)) {
                swal.fire({
                    title: "Error",
                    icon: "error",
                    html: "La cantidad permitida es de: " + disponible,
                    confirmButtonText: "Aceptar",
                    confirmButtonColor: "#28a745",
                });
                $(this).val(disponible);
            }
        }
    );
});

function existeElementoIngreso(id) {
    let encontrado = contenedor_ingresos.find(`.elemento[data-id="${id}"]`);
    if (encontrado.length > 0) {
        return true;
    }
    return false;
}
