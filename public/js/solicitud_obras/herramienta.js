// HERRAMIENTA
let contenedor_herramientas = $("#contenedor_herramientas");
let herramienta_id = $("#herramienta_id");
let select_herramientas = $("#select_herramientas");
let dias_uso = $("#dias_uso");
let fecha_asignacion = $("#fecha_asignacion");
let fecha_finalizacion = $("#fecha_finalizacion");
let btnAgregarHerramienta = $("#btnAgregarHerramienta");

$(document).ready(function () {});

function validaHerramienta() {
    if (
        herramienta_id.val().trim() != "" &&
        dias_uso.val().trim() != "" &&
        fecha_asignacion.val().trim() != "" &&
        fecha_finalizacion.val().trim() != ""
    ) {
        return true;
    }
    swal.fire({
        title: "Error",
        icon: "error",
        text: "Debes llenar todo el formulario",
        confirmButtonText: "Aceptar",
        confirmButtonColor: "#28a745",
    });
    return false;
}
