// PERSONAL
let contenedor_personal = $("#contenedor_personal");
let personal_id = $("#personal_id");
let select_personal = $("#select_personal");
let btnAgregarPersonal = $("#btnAgregarPersonal");

$(document).ready(function () {});

function validaPersonal() {
    if (personal_id.val().trim() != "") {
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
