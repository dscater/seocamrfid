// PERSONAL
let contenedor_personal = $("#contenedor_personal");
let personal_id = $("#personal_id");
let select_personal = $("#select_personal");
let btnAgregarPersonal = $("#btnAgregarPersonal");

$(document).ready(function () {
    // PERSONAL
    // agregar
    btnAgregarPersonal.click(function () {
        $(this).prop("disabled", true);
        if (validaPersonal()) {
            let personal = personal_id.val();
            let personal_txt = personal_id.select2("data")[0].text;
            let clon_elem = $(elem_personal).clone();
            let input_hide = clon_elem.find(".card-body").find("input.valores");
            let span_nombre = clon_elem
                .find(".card-body")
                .children("p.editable")
                .eq(0)
                .children("span");
            // asignando valores
            let valor = `0|${personal}`;
            span_nombre.text(personal_txt);
            input_hide.val(valor);
            contenedor_personal.append(clon_elem);
            // vaciar valores
            personal_id.val("").trigger("change");
        }
        let self = $(this);
        setTimeout(function () {
            self.removeAttr("disabled");
        }, 300);
    });
    // editar
    contenedor_personal.on("click", ".editar", function () {
        // Ocultar este boton y mostar botones actualizar y cancelar
        $(this).addClass("oculto");
        let btnActualizar = $(this).siblings(".actualizar");
        let btnCancelar = $(this).siblings(".cancelar");
        btnActualizar.removeClass("oculto");
        btnCancelar.removeClass("oculto");

        let contenedor_datos = $(this).parents(".contenedor_datos");
        let card_body = contenedor_datos.children(".card-body");
        let editables = card_body.children("p.editable");
        // valores asignados
        let array_valores = card_body.children(".valores").val().split("|");
        // let id = array_valores[0];
        let p_id = array_valores[1];

        editables.each(function (index) {
            $(this).children("span").addClass("oculto");
            if (index == 0) {
                // Obtener el HTML de los options del select de personales
                let optionsHtml = select_personal.html();
                // Llenar el select de acuerdo al select de personales
                let select_elem = $(this).children(".input_form");
                select_elem.html(optionsHtml);
                select_elem.addClass("oculto");
                // Inicializar select2 en el select de destino
                select_elem.select2();
                select_elem.val(p_id).trigger("change");
            }
            if (index >= 1) {
                $(this)
                    .children(".input_form")
                    .val(
                        array_valores[
                            $(this).children(".input_form").attr("data-index")
                        ]
                    );
            }
            $(this).children(".input_form").removeClass("oculto");
        });
    });
    // cancelar
    contenedor_personal.on("click", ".cancelar", function () {
        cancelarPersonal();
    });
    // actualizar
    contenedor_personal.on("click", ".actualizar", function () {
        let errors = false;
        let contenedor_datos = $(this).parents(".contenedor_datos");
        let card_body = contenedor_datos.children(".card-body");
        let editables = card_body.children("p.editable");
        // valores asignados
        let input_valores = card_body.children(".valores");
        let array_valores = input_valores.val().split("|");

        editables.each(function (index) {
            if (index == 0) {
                let select_elem = $(this).children(".input_form");
                array_valores[select_elem.attr("data-index")] =
                    select_elem.val();
            }
            if (index >= 1) {
                let input = $(this).children(".input_form");
                if (input.val().trim() != "") {
                    array_valores[input.attr("data-index")] = input.val();
                } else {
                    errors = true;
                }
            }
        });
        if (errors) {
            swal.fire({
                title: "Error",
                icon: "error",
                text: "Debes llenar todos los campos",
                confirmButtonText: "Aceptar",
                confirmButtonColor: "#28a745",
            });
            return false;
        } else {
            input_valores.val(array_valores.join("|"));
            cancelarPersonal(true);
            return true;
        }
    });
    // eliminar
    contenedor_personal.on("click", ".eliminar", function () {
        Swal.fire({
            title: "Confirmación",
            text: "¿Estás seguro(a) de eliminar el registro?",
            icon: "question",
            showCancelButton: true,
            confirmButtonText: "Aceptar",
            cancelButtonText: "Cancelar",
            confirmButtonColor: "#28a745",
            cancelButtonColor: "#dc3545",
        }).then((result) => {
            if (result.value) {
                let contenedor_elem = $(this).parents(".elem");
                let contenedor_datos = $(this).parents(".contenedor_datos");
                let card_body = contenedor_datos.children(".card-body");
                // valores asignados
                let input_valores = card_body.children(".valores");
                let array_valores = input_valores.val().split("|");
                if (array_valores[0] != "0") {
                    let input_el_clone = $(input_eliminado_personal).clone();
                    input_el_clone.val(array_valores[0]);
                    eliminados_personal.append(input_el_clone);
                }
                contenedor_elem.remove();
            }
        });
    });
});

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

function cancelarPersonal(actualiza_campos = false) {
    let contenedor_datos = contenedor_personal.find(".contenedor_datos");
    // Ocultar este boton y mostar botones actualizar y cancelar
    let btnCancelar = contenedor_datos.find(".cancelar");
    let btnActualizar = contenedor_datos.find(".actualizar");
    let btnEditar = contenedor_datos.find(".editar");
    btnCancelar.addClass("oculto");
    btnActualizar.addClass("oculto");
    btnEditar.removeClass("oculto");
    let card_body = contenedor_datos.children(".card-body");
    let editables = card_body.children("p.editable");
    let valor_input = "";
    editables.each(function (index) {
        $(this).children(".input_form").addClass("oculto");
        if (index == 0) {
            let select_elem = $(this).children(".select2");
            let select_input = $(this).children(".input_form");
            valor_input = select_input.select2("data")[0].text;
            select_elem.remove();
        } else {
            valor_input = $(this).children(".input_form").val();
        }
        if (actualiza_campos) {
            $(this).children("span").text(valor_input);
        }
        $(this).children("span").removeClass("oculto");
    });
}
