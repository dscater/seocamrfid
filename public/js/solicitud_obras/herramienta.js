// HERRAMIENTA
let contenedor_herramientas = $("#contenedor_herramientas");
let herramienta_id = $("#herramienta_id");
let select_herramientas = $("#select_herramientas");
let dias_uso = $("#dias_uso");
let fecha_asignacion = $("#fecha_asignacion");
let fecha_finalizacion = $("#fecha_finalizacion");
let btnAgregarHerramienta = $("#btnAgregarHerramienta");

$(document).ready(function () {
    // HERRAMIENTAS
    // agregar
    btnAgregarHerramienta.click(function () {
        $(this).prop("disabled", true);
        if (validaHerramienta()) {
            let herramienta = herramienta_id.val();
            let herramienta_txt = herramienta_id.select2("data")[0].text;
            let dias = dias_uso.val();
            let fasignacion = fecha_asignacion.val();
            let ffinalizacion = fecha_finalizacion.val();
            let clon_elem = $(elem_herramienta).clone();
            let input_hide = clon_elem.find(".card-body").find("input.valores");
            let span_nombre = clon_elem
                .find(".card-body")
                .children("p.editable")
                .eq(0)
                .children("span");
            let span_dias = clon_elem
                .find(".card-body")
                .children("p.editable")
                .eq(1)
                .children("span");
            let span_fasignacion = clon_elem
                .find(".card-body")
                .children("p.editable")
                .eq(2)
                .children("span");
            let span_ffinalizacion = clon_elem
                .find(".card-body")
                .children("p.editable")
                .eq(3)
                .children("span");
            // asignando valores
            let valor = `0|${herramienta}|${dias}|${fasignacion}|${ffinalizacion}`;
            span_nombre.text(herramienta_txt);
            span_dias.text(dias);
            span_dias.siblings("input").val(dias);
            span_fasignacion.text(fasignacion);
            span_fasignacion.siblings("input").val(fasignacion);
            span_ffinalizacion.text(ffinalizacion);
            span_ffinalizacion.siblings("input").val(ffinalizacion);
            input_hide.val(valor);
            contenedor_herramientas.append(clon_elem);
            // vaciar valores
            herramienta_id.val("").trigger("change");
            dias_uso.val("");
            fecha_asignacion.val("");
            fecha_finalizacion.val("");
        }
        let self = $(this);
        setTimeout(function () {
            self.removeAttr("disabled");
        }, 300);
    });
    // editar
    contenedor_herramientas.on("click", ".editar", function () {
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
        let h_id = array_valores[1];
        // let h_dias = array_valores[2];
        // let h_fasignacion = array_valores[3];
        // let h_ffinalizacion = array_valores[4];

        editables.each(function (index) {
            $(this).children("span").addClass("oculto");
            if (index == 0) {
                // Obtener el HTML de los options del select de herramientaes
                let optionsHtml = select_herramientas.html();
                // Llenar el select de acuerdo al select de herramientaes
                let select_elem = $(this).children(".input_form");
                select_elem.html(optionsHtml);
                select_elem.addClass("oculto");
                // Inicializar select2 en el select de destino
                select_elem.select2();
                select_elem.val(h_id).trigger("change");
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
    contenedor_herramientas.on("click", ".cancelar", function () {
        cancelarHerramienta();
    });
    // actualizar
    contenedor_herramientas.on("click", ".actualizar", function () {
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
            cancelarHerramienta(true);
            return true;
        }
    });
    // eliminar
    contenedor_herramientas.on("click", ".eliminar", function () {
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
                    let input_el_clone = $(
                        input_eliminado_herramientas
                    ).clone();
                    input_el_clone.val(array_valores[0]);
                    eliminados_herramientas.append(input_el_clone);
                }
                contenedor_elem.remove();
            }
        });
    });
});

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

function cancelarHerramienta(actualiza_campos = false) {
    let contenedor_datos = contenedor_herramientas.find(".contenedor_datos");
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
