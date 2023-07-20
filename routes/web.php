<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes();

Route::get('/', function () {

    return view('auth.login');
})->name('inicio');

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware(['auth'])->group(function () {

    // USUARIOS
    Route::get('users', 'UserController@index')->name('users.index');

    Route::get('users/getByTipo', 'UserController@getByTipo')->name('users.getByTipo');

    Route::get('users/create', 'UserController@create')->name('users.create');

    Route::post('users/store', 'UserController@store')->name('users.store');

    Route::get('users/edit/{usuario}', 'UserController@edit')->name('users.edit');

    Route::put('users/update/{usuario}', 'UserController@update')->name('users.update');

    Route::delete('users/destroy/{user}', 'UserController@destroy')->name('users.destroy');

    // Configuración de cuenta
    Route::GET('users/configurar/cuenta/{user}', 'UserController@config')->name('users.config');

    // contraseña
    Route::PUT('users/configurar/cuenta/update/{user}', 'UserController@cuenta_update')->name('users.config_update');

    // foto de perfil
    Route::POST('users/configurar/cuenta/update/foto/{user}', 'UserController@cuenta_update_foto')->name('users.config_update_foto');

    // CONTROL
    Route::get('users/control', 'UserController@control')->name('users.control');
    Route::get('users/control_create', 'UserController@control_create')->name('users.control_create');
    Route::get('users/control_edit/{user}', 'UserController@control_edit')->name('users.control_edit');
    Route::post('users/control_store', 'UserController@control_store')->name('users.control_store');
    Route::put('users/control_update/{user}', 'UserController@control_update')->name('users.control_update');


    // MONITOREO
    Route::get('monitoreo_herramientas', 'MonitoreoHerramientaController@index')->name('monitoreo_herramientas.index');

    Route::get('monitoreo_herramientas/getAccion', 'MonitoreoHerramientaController@getAccion')->name('monitoreo.getAccion');

    Route::post('monitoreo_herramientas/registraIS', 'MonitoreoHerramientaController@registraIS')->name('monitoreo.registraIS');

    // ESPECIALIDADES
    Route::get('especialidads', 'EspecialidadController@index')->name('especialidads.index');

    Route::get('especialidads/create', 'EspecialidadController@create')->name('especialidads.create');

    Route::post('especialidads/store', 'EspecialidadController@store')->name('especialidads.store');

    Route::get('especialidads/edit/{especialidad}', 'EspecialidadController@edit')->name('especialidads.edit');

    Route::put('especialidads/update/{especialidad}', 'EspecialidadController@update')->name('especialidads.update');

    Route::delete('especialidads/destroy/{especialidad}', 'EspecialidadController@destroy')->name('especialidads.destroy');

    // PERSONAL
    Route::get('personals', 'PersonalController@index')->name('personals.index');

    Route::get('personals/create', 'PersonalController@create')->name('personals.create');

    Route::post('personals/store', 'PersonalController@store')->name('personals.store');

    Route::get('personals/edit/{personal}', 'PersonalController@edit')->name('personals.edit');

    Route::put('personals/update/{personal}', 'PersonalController@update')->name('personals.update');

    Route::delete('personals/destroy/{personal}', 'PersonalController@destroy')->name('personals.destroy');

    // OBRAS
    Route::post('obras/cambiaEstado/{obra}', 'ObraController@cambiaEstado')->name('obras.cambiaEstado');

    Route::get('obras', 'ObraController@index')->name('obras.index');

    Route::get('obras/create', 'ObraController@create')->name('obras.create');

    Route::post('obras/store', 'ObraController@store')->name('obras.store');

    Route::get('obras/edit/{obra}', 'ObraController@edit')->name('obras.edit');

    Route::get('obras/show/{obra}', 'ObraController@show')->name('obras.show');

    Route::put('obras/update/{obra}', 'ObraController@update')->name('obras.update');

    Route::delete('obras/destroy/{obra}', 'ObraController@destroy')->name('obras.destroy');

    Route::post('obras/copiar/{obra}', 'ObraController@copiar')->name('obras.copiar');

    // OBRAS HERRAMIENTAS
    Route::post('obras/herramientas/finalizar', 'ObraHerramientaController@finalizar')->name('obra_herramientas.finalizar');
    Route::get('obras/herramientas/{obra}', 'ObraHerramientaController@index')->name('obra_herramientas.index');
    Route::post('obras/herramientas/asignar', 'ObraHerramientaController@asignar')->name('obra_herramientas.asignar');
    Route::delete('obras/herramientas/destroy', 'ObraHerramientaController@destroy')->name('obra_herramientas.destroy');

    // OBRAS PERSONAL
    Route::get('obras/personals/{obra}', 'ObraPersonalController@index')->name('obra_personals.index');
    Route::post('obras/personals/asignar', 'ObraPersonalController@asignar')->name('obra_personals.asignar');
    Route::delete('obras/personals/destroy', 'ObraPersonalController@destroy')->name('obra_personals.destroy');

    // NOTAS OBRAS
    Route::get('obras/notas/{obra}', 'NotaObrasController@index')->name('nota_obras.index');

    Route::get('obras/notas/create/{obra}', 'NotaObrasController@create')->name('nota_obras.create');

    Route::post('obras/notas/store/{obra}', 'NotaObrasController@store')->name('nota_obras.store');

    Route::get('obras/notas/edit/{nota_obra}', 'NotaObrasController@edit')->name('nota_obras.edit');

    Route::get('obras/notas/show/{nota_obra}', 'NotaObrasController@show')->name('nota_obras.show');

    Route::put('obras/notas/update/{nota_obra}', 'NotaObrasController@update')->name('nota_obras.update');

    Route::delete('obras/notas/destroy/{nota_obra}', 'NotaObrasController@destroy')->name('nota_obras.destroy');

    // MATERIALES
    Route::get('materials', 'MaterialController@index')->name('materials.index');

    Route::get('materials/create', 'MaterialController@create')->name('materials.create');

    Route::post('materials/store', 'MaterialController@store')->name('materials.store');

    Route::get('materials/edit/{material}', 'MaterialController@edit')->name('materials.edit');

    Route::put('materials/update/{material}', 'MaterialController@update')->name('materials.update');

    Route::delete('materials/destroy/{material}', 'MaterialController@destroy')->name('materials.destroy');

    // MATERIAL OBRAS
    Route::get('obras/materiales/{obra}', 'MaterialObraController@index')->name('material_obras.index');

    Route::get('obras/materiales/create/{obra}', 'MaterialObraController@create')->name('material_obras.create');

    Route::post('obras/materiales/store', 'MaterialObraController@store')->name('material_obras.store');

    Route::get('obras/materiales/edit/{material_obra}', 'MaterialObraController@edit')->name('material_obras.edit');

    Route::put('obras/materiales/update/{material_obra}', 'MaterialObraController@update')->name('material_obras.update');

    Route::delete('obras/materiales/destroy/{material_obra}', 'MaterialObraController@destroy')->name('material_obras.destroy');

    // HERRAMIENTAS
    Route::get('herramientas', 'HerramientaController@index')->name('herramientas.index');

    Route::get('herramientas/create', 'HerramientaController@create')->name('herramientas.create');

    Route::post('herramientas/store', 'HerramientaController@store')->name('herramientas.store');

    Route::get('herramientas/edit/{herramienta}', 'HerramientaController@edit')->name('herramientas.edit');

    Route::put('herramientas/update/{herramienta}', 'HerramientaController@update')->name('herramientas.update');

    Route::delete('herramientas/destroy/{herramienta}', 'HerramientaController@destroy')->name('herramientas.destroy');

    // MONITOREO
    Route::get('monitoreo_herramientas', 'MonitoreoHerramientaController@index')->name('monitoreo_herramientas.index');

    Route::get('monitoreo_herramientas/create', 'MonitoreoHerramientaController@create')->name('monitoreo_herramientas.create');

    Route::post('monitoreo_herramientas/store', 'MonitoreoHerramientaController@store')->name('monitoreo_herramientas.store');

    Route::get('monitoreo_herramientas/edit/{monitoreo_herramienta}', 'MonitoreoHerramientaController@edit')->name('monitoreo_herramientas.edit');

    Route::put('monitoreo_herramientas/update/{monitoreo_herramienta}', 'MonitoreoHerramientaController@update')->name('monitoreo_herramientas.update');

    Route::delete('monitoreo_herramientas/destroy/{monitoreo_herramienta}', 'MonitoreoHerramientaController@destroy')->name('monitoreo_herramientas.destroy');

    Route::get('monitoreo_herramientas/lista_estados', 'MonitoreoHerramientaController@lista_estados')->name('monitoreo_herramientas.lista_estados');

    // RAZON SOCIAL
    Route::get('razon_social/index', 'RazonSocialController@index')->name('razon_social.index');

    Route::get('razon_social/edit/{razon_social}', 'RazonSocialController@edit')->name('razon_social.edit');

    Route::put('razon_social/update/{razon_social}', 'RazonSocialController@update')->name('razon_social.update');

    // NOTIFICACIONES
    Route::get('notificacionsUser', 'NotificacionController@notificacionUser')->name('notificacions.user');

    Route::get('notificacions', 'NotificacionController@index')->name('notificacions.index');

    Route::get('notificacions/{notificacion}', 'NotificacionController@show')->name('notificacions.show');

    // MOVIMIENTOS
    Route::get('obras/movimientos/{obra}', 'MovimientoController@index')->name('movimientos.index');

    // SOLICITUD OBRAS
    Route::post('solicitud_obras/cambiaEstado/{solicitud_obra}', 'SolicitudObraController@cambiaEstado')->name('solicitud_obras.cambiaEstado');
    Route::get('solicitud_obras/solicitudes_obra/{obra}', 'SolicitudObraController@solicitudes_obra')->name('solicitud_obras.solicitudes_obra');
    Route::get('solicitud_obras/show/{solicitud_obra}', 'SolicitudObraController@show')->name('solicitud_obras.show');
    Route::get('solicitud_obras', 'SolicitudObraController@index')->name('solicitud_obras.index');
    Route::get('solicitud_obras/create/{obra}', 'SolicitudObraController@create')->name('solicitud_obras.create');
    Route::post('solicitud_obras/store/{obra}', 'SolicitudObraController@store')->name('solicitud_obras.store');
    Route::get('solicitud_obras/edit/{solicitud_obra}', 'SolicitudObraController@edit')->name('solicitud_obras.edit');
    Route::put('solicitud_obras/update/{solicitud_obra}', 'SolicitudObraController@update')->name('solicitud_obras.update');
    Route::delete('solicitud_obras/destroy/{solicitud_obra}', 'SolicitudObraController@destroy')->name('solicitud_obras.destroy');

    // REPORTES
    Route::get('reportes', 'ReporteController@index')->name('reportes.index');

    Route::get('reportes/usuarios', 'ReporteController@usuarios')->name('reportes.usuarios');

    Route::get('reportes/personal', 'ReporteController@personal')->name('reportes.personal');

    Route::get('reportes/materiales_obras', 'ReporteController@materiales_obras')->name('reportes.materiales_obras');
    Route::get('reportes/g_materiales_obras', 'ReporteController@g_materiales_obras')->name('reportes.g_materiales_obras');
    Route::get('reportes/obrasMateriales', 'ReporteController@obrasMateriales')->name('reportes.obrasMateriales');

    Route::get('reportes/infoMateriales', 'ReporteController@infoMateriales')->name('reportes.infoMateriales');

    Route::get('reportes/ingresos_salidas', 'ReporteController@ingresos_salidas')->name('reportes.ingresos_salidas');

    Route::get('reportes/monitoreo', 'ReporteController@monitoreo')->name('reportes.monitoreo');
    Route::get('reportes/g_monitoreo', 'ReporteController@g_monitoreo')->name('reportes.g_monitoreo');
    Route::get('reportes/monitoreoInfo', 'ReporteController@monitoreoInfo')->name('reportes.monitoreoInfo');

    Route::get('reportes/obras', 'ReporteController@obras')->name('reportes.obras');
    Route::get('reportes/g_obras', 'ReporteController@g_obras')->name('reportes.g_obras');
    Route::get('reportes/obrasInfo', 'ReporteController@obrasInfo')->name('reportes.obrasInfo');
});
