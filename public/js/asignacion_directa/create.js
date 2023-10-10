let formSolicitud = $("#formSolicitud");
$(document).ready(function () {
    $("#btnEnviaForm").click(function (e) {
        e.preventDefault();

        Swal.fire({
            title: "Confirmación",
            text:
                "¿Estás seguro de realizar la asignación directa a la obra " +
                $("#txtNomObra").val() +
                "?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Si, asignar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#dc3545",
        }).then((result) => {
            if (result.value) {
                if (validaFormulario()) {
                    formSolicitud.submit();
                }
            }
        });
    });

    formSolicitud.on("keypress", "input", function (e) {
        if (e.charCode == 13) {
            e.preventDefault();
        }
    });
});

function validaFormulario() {
    let input_herramientas = contenedor_herramientas.find("input.valores");
    let input_material = contenedor_material.find("input.valores");
    let input_personal = contenedor_personal.find("input.valores");
    let errors = "";
    let enviaForm = true;
    if (input_herramientas.length == 0) {
        errors += "<br>Debes ingresar al menos una herramienta";
        enviaForm = false;
    }
    if (input_material.length == 0) {
        errors += "<br>Debes ingresar al menos una herramienta";
        enviaForm = false;
    }
    if (input_personal.length == 0) {
        errors += "<br>Debes ingresar al menos un personal";
        enviaForm = false;
    }

    if (
        input_herramientas.length > 0 ||
        input_material.length > 0 ||
        input_personal.length > 0
    ) {
        enviaForm = true;
    }

    if (!enviaForm) {
        swal.fire({
            title: "Error",
            icon: "error",
            html: errors,
            confirmButtonText: "Aceptar",
            confirmButtonColor: "#28a745",
        });
    }
    return enviaForm;
}
