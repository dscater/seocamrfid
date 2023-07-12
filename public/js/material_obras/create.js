let principal_ingresos = $("#principal_ingresos");
let principal_salidas = $("#principal_salidas");

$(document).ready(function () {
    btnIngresos.click(function () {
        principal_ingresos.removeClass("oculto");
        principal_salidas.addClass("oculto");
    });
    btnSalidas.click(function () {
        principal_salidas.removeClass("oculto");
        principal_ingresos.addClass("oculto");
    });
});
