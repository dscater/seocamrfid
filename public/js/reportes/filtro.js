$(document).ready(function() {
    usuarios();
    personal();
    ingresos_salidas();
    monitoreo();
});

function usuarios() {
    var tipo = $('#m_usuarios #tipo').parents('.form-group');
    var fecha_ini = $('#m_usuarios #fecha_ini').parents('.form-group');
    var fecha_fin = $('#m_usuarios #fecha_fin').parents('.form-group');

    fecha_ini.hide();
    fecha_fin.hide();
    tipo.hide();
    $('#m_usuarios select#filtro').change(function() {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                tipo.hide();
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'tipo':
                tipo.show();
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'fecha':
                tipo.hide();
                fecha_ini.show();
                fecha_fin.show();
                break;
        }
    });
}

function personal() {
    var obra = $('#m_personal #obra').parents('.form-group');

    obra.hide();
    $('#m_personal select#filtro').change(function() {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                obra.hide();
                break;
            case 'obra':
                obra.show();
                break;
        }
    });
}

function ingresos_salidas() {
    var obra = $('#m_ingresos_salidas #obra').parents('.form-group');
    var fecha_ini = $('#m_ingresos_salidas #fecha_ini').parents('.form-group');
    var fecha_fin = $('#m_ingresos_salidas #fecha_fin').parents('.form-group');

    fecha_ini.hide();
    fecha_fin.hide();
    obra.hide();
    $('#m_ingresos_salidas select#filtro').change(function() {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                obra.hide();
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'obra':
                obra.show();
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'fecha':
                obra.hide();
                fecha_ini.show();
                fecha_fin.show();
                break;
        }
    });
}

function monitoreo() {
    var herramienta = $('#m_monitoreo #herramienta').parents('.form-group');
    var fecha_ini = $('#m_monitoreo #fecha_ini').parents('.form-group');
    var fecha_fin = $('#m_monitoreo #fecha_fin').parents('.form-group');

    fecha_ini.hide();
    fecha_fin.hide();
    herramienta.hide();
    $('#m_monitoreo select#filtro').change(function() {
        let filtro = $(this).val();
        switch (filtro) {
            case 'todos':
                herramienta.hide();
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'herramienta':
                herramienta.show();
                fecha_ini.hide();
                fecha_fin.hide();
                break;
            case 'fecha':
                herramienta.hide();
                fecha_ini.show();
                fecha_fin.show();
                break;
        }
    });
}