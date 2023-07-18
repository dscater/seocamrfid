let listaSolicitudSalidas = $("#listaSolicitudSalidas");
let contenedor_salidas = $("#contenedor_salidas");
$(document).ready(function () {
    contarSalidas();
    listaSolicitudSalidas.on("click", "tr td.accion button", function () {
        let nuevo_elemento = $(elemento_salida).clone();
        let fila = $(this).parents("tr.fila");
        let id = fila.attr("data-id");
        let nombre = fila.children("td").eq(1).text();
        let disponible = fila.attr("data-disponible");
        if (!existeElementoSalida(id) && parseFloat(disponible) > 0) {
            nuevo_elemento.attr("data-id", id);
            let material_obra_id = id;
            let material_id = fila.attr("data-material");
            let cantidad_disp = disponible;
            nuevo_elemento.attr("data-disponible", cantidad_disp);
            nuevo_elemento.find(".nombre_material").text(nombre);
            nuevo_elemento
                .find("input.i_material_obra_id")
                .val(material_obra_id);
            nuevo_elemento.find("input.i_salida_material_id").val(material_id);
            nuevo_elemento.find("input.i_salida_cantidad").val(cantidad_disp);
            contenedor_salidas.append(nuevo_elemento);
            toastr.success("Registro agregado");
            contarSalidas();
        } else {
            swal.fire({
                title: "Error",
                icon: "error",
                html: "Este material ya se encuentra en la lista",
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#28a745",
            });
        }
    });

    contenedor_salidas.on(
        "keyup change",
        "input.i_salida_cantidad",
        function () {
            let disponible = $(this)
                .parents(".elemento")
                .attr("data-disponible");
            let valor = $(this).val();
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

    // quitar
    contenedor_salidas.on("click", ".elemento button.quitar", function (e) {
        e.preventDefault();
        let elemento = $(this).parents(".elemento");
        elemento.remove();
        contarSalidas();
    });
});

function existeElementoSalida(id) {
    let encontrado = contenedor_salidas.find(`.elemento[data-id="${id}"]`);
    if (encontrado.length > 0) {
        return true;
    }
    return false;
}

function contarSalidas() {
    let elementos = $("#contenedor_salidas").children(".elemento");
    if (elementos.length > 0) {
        $(".principal_salidas").removeClass("oculto");
    } else {
        $(".principal_salidas").addClass("oculto");
    }
}
