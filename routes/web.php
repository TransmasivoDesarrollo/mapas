<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('/');

Route::middleware('auth')->group(function () {
    Route::get('/perfil', [ProfileController::class, 'edit'])->name('perfil');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
    Route::get('/sendWelcomeEmail', '\App\Http\Controllers\Mantenimiento\MantenimientoController@sendWelcomeEmail')->name('sendWelcomeEmail');
    Route::get('/mapas', '\App\Http\Controllers\Controller@mapas')->name('mapas');
    Route::get('/login', '\App\Http\Controllers\Controller@login')->name('login');
    Route::get('/dashboard', '\App\Http\Controllers\Controller@dashboard')->name('dashboard');
    Route::get('/Usuarios', '\App\Http\Controllers\Controller@Usuarios')->name('Usuarios');
    Route::POST('/Usuarios', '\App\Http\Controllers\Controller@Update_usuarios')->name('Update_usuarios');
    //sistemas
    Route::get('/Alta_de_personal', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Alta_de_personal')->name('Alta_de_personal');
    Route::get('/AltaAccesoAlSistema', '\App\Http\Controllers\Sistemas\SistemasController@AltaAccesoAlSistema')->name('AltaAccesoAlSistema');
    Route::POST('/AltaAccesoAlSistema', '\App\Http\Controllers\Sistemas\SistemasController@Registro_de_acceso')->name('Registro_de_acceso');
    //mantenimiento

    
    
    Route::get('/Reporte_de_estado_fisico_y_funcionamiento', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Reporte_de_estado_fisico_y_funcionamiento')->name('Reporte_de_estado_fisico_y_funcionamiento');
    Route::POST('/Reporte_de_estado_fisico_y_funcionamiento', '\App\Http\Controllers\Mantenimiento\MantenimientoController@postReporte_de_estado_fisico_y_funcionamiento')->name('postReporte_de_estado_fisico_y_funcionamiento');

    
    Route::get('/Descarga_reporte_de_estado_fisico_y_funcionamiento', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Descarga_reporte_de_estado_fisico_y_funcionamiento')->name('Descarga_reporte_de_estado_fisico_y_funcionamiento');
    Route::POST('/Descarga_reporte_de_estado_fisico_y_funcionamiento', '\App\Http\Controllers\Mantenimiento\MantenimientoController@postDescarga_reporte_de_estado_fisico_y_funcionamiento')->name('postDescarga_reporte_de_estado_fisico_y_funcionamiento');


    Route::get('/Bitacora_De_Liberacion_De_Unidades', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Revisión')->name('Revisión');
    Route::get('/Bitacora_De_Liberacion_De_Unidadesv1', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Revisiónv1')->name('Revisiónv1');
    Route::get('/Bitacora_De_Liberacion_De_Unidades_express', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Bitacora_De_Liberacion_De_Unidades_express')->name('Bitacora_De_Liberacion_De_Unidades_express');

    
    
    Route::POST('/Bitacora_De_Liberacion_De_Unidades_express', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Alta_de_bitacora_express')->name('Alta_de_bitacora_express');
    Route::POST('/Bitacora_De_Liberacion_De_Unidades', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Alta_de_bitacora')->name('Alta_de_bitacora');
    Route::get('/Bitacora_Liberacion_De_Unidades', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Bitacora_Liberacion_De_Unidades')->name('Bitacora_Liberacion_De_Unidades');
    Route::POST('/Bitacora_Liberacion_De_Unidades', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Consulta_bitacora')->name('Consulta_bitacora');
    Route::get('/Alta_de_unidades', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Alta_de_unidades')->name('Alta_de_unidades');
    Route::POST('/Alta_de_unidades', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Registro_de_unidades')->name('Registro_de_unidades');

    
    Route::get('/Reporte_de_supervisión', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Reporte_de_supervisión')->name('Reporte_de_supervisión');
    Route::POST('/Reporte_de_supervisión', '\App\Http\Controllers\Mantenimiento\MantenimientoController@post_Reporte_de_supervisión')->name('post_Reporte_de_supervisión');
    
    
    
    Route::get('/Liberacion_unidades_electrico', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Liberacion_unidades_electrico')->name('Liberacion_unidades_electrico');
    Route::POST('/Liberacion_unidades_electrico', '\App\Http\Controllers\Mantenimiento\MantenimientoController@registro_Liberacion_unidades_electrico')->name('registro_Liberacion_unidades_electrico');

    
    Route::get('/Bitacora_Liberacion_De_Unidades_electrico', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Bitacora_Liberacion_unidades_electrico')->name('Bitacora_Liberacion_unidades_electrico');
    
    //Almacen
    
    Route::get('/Inventario_caja_herramienta', '\App\Http\Controllers\Almacen\AlmacenController@Inventario_caja_herramienta')->name('Inventario_caja_herramienta');
    
    Route::get('/exportar-a-word', '\App\Http\Controllers\Almacen\AlmacenController@exportToWord');

    //recursos humanos
    Route::get('/check-location', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@checkLocation');
    Route::get('/Contratos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Contratos');
    Route::POST('/Contratos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@generarContratos');

    Route::get('/Renuncias', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Renuncias');
    Route::POST('/Renuncias', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@descargarRenuncia');

    Route::get('/Personal', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Personal')->name('Personal');
    Route::POST('/Personal', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@accionParaPersonal');

    
    Route::get('/Encuesta_de_renuncia', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Encuesta_de_renuncia')->name('Encuesta_de_renuncia');
    Route::POST('/Encuesta_de_renuncia', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Encuesta_de_renuncia_guardar')->name('Encuesta_de_renuncia_guardar');

    
    Route::get('/estadisticas_renuncias', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@estadisticas_renuncias')->name('estadisticas_renuncias');

    Route::get('/geo', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo')->name('geo');
    
    Route::get('/geo2', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo2')->name('geo2');
    Route::POST('/geo2', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@insertar_cordenadas')->name('insertar_cordenadas');


    
    
    Route::POST('/geo_eco1000', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1000')->name('geo_eco1000');
    Route::POST('/geo_eco1011', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1011')->name('geo_eco1011');
    Route::POST('/geo_eco1010', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1010')->name('geo_eco1010');


    Route::get('/geo_ecotodos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_ecotodos')->name('geo_ecotodos');
    Route::get('/geo3', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo3')->name('geo3');

    Route::POST('/geo_eco65', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco65')->name('geo_eco65');
    Route::POST('/geo_eco66', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco66')->name('geo_eco66');
    Route::POST('/geo_eco67', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco67')->name('geo_eco67');
    Route::POST('/geo_eco68', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco68')->name('geo_eco68');
    Route::POST('/geo_eco69', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco69')->name('geo_eco69');
    Route::POST('/geo_eco70', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco70')->name('geo_eco70');
    Route::POST('/geo_eco71', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco71')->name('geo_eco71');
    Route::POST('/geo_eco72', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco72')->name('geo_eco72');
    Route::POST('/geo_eco73', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco73')->name('geo_eco73');
    Route::POST('/geo_eco74', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco74')->name('geo_eco74');
    Route::POST('/geo_eco75', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco75')->name('geo_eco75');
    Route::POST('/geo_eco76', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco76')->name('geo_eco76');
    Route::POST('/geo_eco77', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco77')->name('geo_eco77');
    Route::POST('/geo_eco78', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco78')->name('geo_eco78');

    Route::POST('/geo_eco79', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco79')->name('geo_eco79');
    Route::POST('/geo_eco80', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco80')->name('geo_eco80');
    Route::POST('/geo_eco81', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco81')->name('geo_eco81');
    Route::POST('/geo_eco82', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco82')->name('geo_eco82');
    Route::POST('/geo_eco83', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco83')->name('geo_eco83');
    Route::POST('/geo_eco84', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco84')->name('geo_eco84');
    Route::POST('/geo_eco85', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco85')->name('geo_eco85');
    Route::POST('/geo_eco86', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco86')->name('geo_eco86');
    Route::POST('/geo_eco87', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco87')->name('geo_eco87');
    Route::POST('/geo_eco88', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco88')->name('geo_eco88');
    Route::POST('/geo_eco89', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco89')->name('geo_eco89');
    Route::POST('/geo_eco90', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco90')->name('geo_eco90');
    Route::POST('/geo_eco91', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco91')->name('geo_eco91');

    Route::POST('/geo_eco92', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco92')->name('geo_eco92');
    Route::POST('/geo_eco93', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco93')->name('geo_eco93');
    Route::POST('/geo_eco94', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco94')->name('geo_eco94');
    Route::POST('/geo_eco95', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco95')->name('geo_eco95');
    Route::POST('/geo_eco96', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco96')->name('geo_eco96');
    Route::POST('/geo_eco97', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco97')->name('geo_eco97');
    Route::POST('/geo_eco98', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco98')->name('geo_eco98');
    Route::POST('/geo_eco99', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco99')->name('geo_eco99');

    Route::POST('/geo_eco1001', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1001')->name('geo_eco1001');
    Route::POST('/geo_eco1002', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1002')->name('geo_eco1002');
    Route::POST('/geo_eco1003', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1003')->name('geo_eco1003');
    Route::POST('/geo_eco1004', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1004')->name('geo_eco1004');
    Route::POST('/geo_eco1005', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1005')->name('geo_eco1005');
    Route::POST('/geo_eco1006', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1006')->name('geo_eco1006');
    Route::POST('/geo_eco1007', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1007')->name('geo_eco1007');
    Route::POST('/geo_eco1008', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1008')->name('geo_eco1008');
    Route::POST('/geo_eco1009', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1009')->name('geo_eco1009');
    Route::POST('/geo_eco1012', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1012')->name('geo_eco1012');
    Route::POST('/geo_eco1', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco1')->name('geo_eco1');
    Route::POST('/geo_eco15', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco15')->name('geo_eco15');
    Route::POST('/geo_eco24', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco24')->name('geo_eco24');
    Route::POST('/geo_eco25', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco25')->name('geo_eco25');
    Route::POST('/geo_eco35', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco35')->name('geo_eco35');
    Route::POST('/geo_eco41', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco41')->name('geo_eco41');
    Route::POST('/geo_eco45', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco45')->name('geo_eco45');
    Route::POST('/geo_eco46', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@geo_eco46')->name('geo_eco46');




    
    
    
   

    //operaciones

    
    Route::get('/recorrido', '\App\Http\Controllers\Operaciones\OperacionesController@recorrido')->name('recorrido');
    Route::get('/geodata', '\App\Http\Controllers\Operaciones\OperacionesController@geodata')->name('geodata');
    


    Route::get('/Bitacora_de_operaciones', '\App\Http\Controllers\Operaciones\OperacionesController@Bitacora_de_operaciones')->name('Bitacora_de_operaciones');
    Route::POST('/Bitacora_de_operaciones', '\App\Http\Controllers\Operaciones\OperacionesController@Registro_bitacora_terminal')->name('Registro_bitacora_terminal');
    Route::get('/Alta_de_reporte', '\App\Http\Controllers\Operaciones\OperacionesController@Alta_de_reporte')->name('Alta_de_reporte');
    Route::get('/Alta_de_reporte/subgrupo', '\App\Http\Controllers\Operaciones\OperacionesController@catalogo_subgrupo')->name('catalogo_subgrupo');
    Route::get('/Bitacora_De_Liberacion_De_Unidades/km', '\App\Http\Controllers\Mantenimiento\MantenimientoController@consultakm')->name('consultakm');
    Route::get('/Catalogo_de_fallas', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Catalogo_de_fallas')->name('Catalogo_de_fallas');
    Route::get('/Catalogo_de_fallas/consulta', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Catalogo_de_fallas_consulta')->name('Catalogo_de_fallas_consulta');
    
    Route::POST('/Catalogo_de_fallas', '\App\Http\Controllers\Mantenimiento\MantenimientoController@registro_de_falla')->name('registro_de_falla');
    
    Route::get('/Catalogo_de_fallas/baja', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Catalogo_de_fallas_baja')->name('Catalogo_de_fallas_baja');
    Route::get('/Catalogo_de_fallas/alta', '\App\Http\Controllers\Mantenimiento\MantenimientoController@Catalogo_de_fallas_alta')->name('Catalogo_de_fallas_alta');
    

    
    Route::get('/Autorizacion_check_mantenimiento', '\App\Http\Controllers\Operaciones\OperacionesController@Autorizacion_check_mantenimiento')->name('Autorizacion_check_mantenimiento');
    Route::POST('/Autorizacion_check_mantenimiento', '\App\Http\Controllers\Operaciones\OperacionesController@acciones')->name('Autorizacion_check_mantenimientoacciones');
    
    Route::get('/bannerModulo200', '\App\Http\Controllers\Operaciones\OperacionesController@bannerModulo200')->name('bannerModulo200');
    Route::POST('/bannerModulo200', '\App\Http\Controllers\Operaciones\OperacionesController@subirBannerOperaciones')->name('subirBannerOperaciones');

    Route::get('/modificar_banner_200', '\App\Http\Controllers\Operaciones\OperacionesController@modificar_banner_200')->name('modificar_banner_200');
    Route::POST('/modificar_banner_200', '\App\Http\Controllers\Operaciones\OperacionesController@cambiar_estatus_banner_200')->name('cambiar_estatus_banner_200');
    
    
    

    Route::get('/Inventario', '\App\Http\Controllers\Inventario\InventarioController@Inventario')->name('Inventario');
    Route::POST('/Inventario', '\App\Http\Controllers\Inventario\InventarioController@GuardarInventario')->name('GuardarInventario');
    
    Route::get('/ModificarInventario', '\App\Http\Controllers\Inventario\InventarioController@ModificarInventario')->name('ModificarInventario');
    Route::POST('/ModificarInventario', '\App\Http\Controllers\Inventario\InventarioController@cambios')->name('cambios');
    
    Route::get('/id={id_personal}', '\App\Http\Controllers\Marketing\MarketingController@generadorQR')->name('generadorQR');

    
    Route::get('/Permisos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Permisos')->name('Permisos');
    Route::POST('/Permisos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@PermisosPOST')->name('PermisosPOST');

    
    Route::get('/Consultar_permisos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Consultar_permisos')->name('Consultar_permisos');
    Route::POST('/Consultar_permisos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@postConsultar_permiso')->name('postConsultar_permiso');
    
    
    Route::get('/Gestión_de_permisos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Gestión_de_permisos')->name('Gestión_de_permisos');
    Route::POST('/Gestión_de_permisos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@postGestión_de_permisos')->name('postGestión_de_permisos');
    

    
});

Route::get('/200', '\App\Http\Controllers\Operaciones\OperacionesController@m200')->name('m200');
Route::get('/419', '\App\Http\Controllers\Operaciones\OperacionesController@m419')->name('m419');





Route::get('/geo1011', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1011')->name('insertar_cordenadas1011');
Route::POST('/geo1011', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1011_i')->name('insertar_cordenadas1011_i');

Route::get('/geo65', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas65')->name('insertar_cordenadas65');
Route::POST('/geo65', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas65_i')->name('insertar_cordenadas65_i');
Route::get('/geo66', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas66')->name('insertar_cordenadas66');
Route::POST('/geo66', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas66_i')->name('insertar_cordenadas66_i');
Route::get('/geo67', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas67')->name('insertar_cordenadas67');
Route::POST('/geo67', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas67_i')->name('insertar_cordenadas67_i');
Route::get('/geo68', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas68')->name('insertar_cordenadas68');
Route::POST('/geo68', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas68_i')->name('insertar_cordenadas68_i');
Route::get('/geo69', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas69')->name('insertar_cordenadas69');
Route::POST('/geo69', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas69_i')->name('insertar_cordenadas69_i');
Route::get('/geo70', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas70')->name('insertar_cordenadas70');
Route::POST('/geo70', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas70_i')->name('insertar_cordenadas70_i');
Route::get('/geo71', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas71')->name('insertar_cordenadas71');
Route::POST('/geo71', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas71_i')->name('insertar_cordenadas71_i');
Route::get('/geo72', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas72')->name('insertar_cordenadas72');
Route::POST('/geo72', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas72_i')->name('insertar_cordenadas72_i');
Route::get('/geo73', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas73')->name('insertar_cordenadas73');
Route::POST('/geo73', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas73_i')->name('insertar_cordenadas73_i');
Route::get('/geo74', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas74')->name('insertar_cordenadas74');
Route::POST('/geo74', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas74_i')->name('insertar_cordenadas74_i');

Route::get('/geo75', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas75')->name('insertar_cordenadas75');
Route::POST('/geo75', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas75_i')->name('insertar_cordenadas75_i');
Route::get('/geo76', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas76')->name('insertar_cordenadas76');
Route::POST('/geo76', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas76_i')->name('insertar_cordenadas76_i');
Route::get('/geo77', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas77')->name('insertar_cordenadas77');
Route::POST('/geo77', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas77_i')->name('insertar_cordenadas77_i');
Route::get('/geo78', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas78')->name('insertar_cordenadas78');
Route::POST('/geo78', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas78_i')->name('insertar_cordenadas78_i');
Route::get('/geo79', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas79')->name('insertar_cordenadas79');
Route::POST('/geo79', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas79_i')->name('insertar_cordenadas79_i');
Route::get('/geo80', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas80')->name('insertar_cordenadas80');
Route::POST('/geo80', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas80_i')->name('insertar_cordenadas80_i');
Route::get('/geo81', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas81')->name('insertar_cordenadas81');
Route::POST('/geo81', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas81_i')->name('insertar_cordenadas81_i');
Route::get('/geo82', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas82')->name('insertar_cordenadas82');
Route::POST('/geo82', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas82_i')->name('insertar_cordenadas82_i');
Route::get('/geo83', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas83')->name('insertar_cordenadas83');
Route::POST('/geo83', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas83_i')->name('insertar_cordenadas83_i');
Route::get('/geo84', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas84')->name('insertar_cordenadas84');
Route::POST('/geo84', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas84_i')->name('insertar_cordenadas84_i');

Route::get('/geo85', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas85')->name('insertar_cordenadas85');
Route::POST('/geo85', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas85_i')->name('insertar_cordenadas85_i');
Route::get('/geo86', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas86')->name('insertar_cordenadas86');
Route::POST('/geo86', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas86_i')->name('insertar_cordenadas86_i');
Route::get('/geo87', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas87')->name('insertar_cordenadas87');
Route::POST('/geo87', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas87_i')->name('insertar_cordenadas87_i');
Route::get('/geo88', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas88')->name('insertar_cordenadas88');
Route::POST('/geo88', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas88_i')->name('insertar_cordenadas88_i');
Route::get('/geo89', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas89')->name('insertar_cordenadas89');
Route::POST('/geo89', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas89_i')->name('insertar_cordenadas89_i');
Route::get('/geo90', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas90')->name('insertar_cordenadas90');
Route::POST('/geo90', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas90_i')->name('insertar_cordenadas90_i');
Route::get('/geo91', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas91')->name('insertar_cordenadas91');
Route::POST('/geo91', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas91_i')->name('insertar_cordenadas91_i');
Route::get('/geo92', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas92')->name('insertar_cordenadas92');
Route::POST('/geo92', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas92_i')->name('insertar_cordenadas92_i');
Route::get('/geo93', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas93')->name('insertar_cordenadas93');
Route::POST('/geo93', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas93_i')->name('insertar_cordenadas93_i');
Route::get('/geo94', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas94')->name('insertar_cordenadas94');
Route::POST('/geo94', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas94_i')->name('insertar_cordenadas94_i');

Route::get('/geo95', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas95')->name('insertar_cordenadas95');
Route::POST('/geo95', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas95_i')->name('insertar_cordenadas95_i');
Route::get('/geo96', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas96')->name('insertar_cordenadas96');
Route::POST('/geo96', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas96_i')->name('insertar_cordenadas96_i');
Route::get('/geo97', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas97')->name('insertar_cordenadas97');
Route::POST('/geo97', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas97_i')->name('insertar_cordenadas97_i');
Route::get('/geo98', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas98')->name('insertar_cordenadas98');
Route::POST('/geo98', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas98_i')->name('insertar_cordenadas98_i');
Route::get('/geo99', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas99')->name('insertar_cordenadas99');
Route::POST('/geo99', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas99_i')->name('insertar_cordenadas99_i');
Route::get('/geo1001', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1001')->name('insertar_cordenadas1001');
Route::POST('/geo1001', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1001_i')->name('insertar_cordenadas1001_i');
Route::get('/geo1002', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1002')->name('insertar_cordenadas1002');
Route::POST('/geo1002', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1002_i')->name('insertar_cordenadas1002_i');
Route::get('/geo1003', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1003')->name('insertar_cordenadas1003');
Route::POST('/geo1003', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1003_i')->name('insertar_cordenadas1003_i');
Route::get('/geo1004', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1004')->name('insertar_cordenadas1004');
Route::POST('/geo1004', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1004_i')->name('insertar_cordenadas1004_i');
Route::get('/geo1005', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1005')->name('insertar_cordenadas1005');
Route::POST('/geo1005', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1005_i')->name('insertar_cordenadas1005_i');

Route::get('/geo1006', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1006')->name('insertar_cordenadas1006');
Route::POST('/geo1006', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1006_i')->name('insertar_cordenadas1006_i');
Route::get('/geo1007', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1007')->name('insertar_cordenadas1007');
Route::POST('/geo1007', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1007_i')->name('insertar_cordenadas1007_i');
Route::get('/geo1008', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1008')->name('insertar_cordenadas1008');
Route::POST('/geo1008', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1008_i')->name('insertar_cordenadas1008_i');
Route::get('/geo1009', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1009')->name('insertar_cordenadas1009');
Route::POST('/geo1009', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1009_i')->name('insertar_cordenadas1009_i');
Route::get('/geo1010', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1010')->name('insertar_cordenadas1010');
Route::POST('/geo1010', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1010_i')->name('insertar_cordenadas1010_i');
Route::get('/geo1012', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1012')->name('insertar_cordenadas1012');
Route::POST('/geo1012', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1012_i')->name('insertar_cordenadas1012_i');
Route::get('/geo1', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1')->name('insertar_cordenadas1');
Route::POST('/geo1', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas1_i')->name('insertar_cordenadas1_i');
Route::get('/geo15', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas15')->name('insertar_cordenadas15');
Route::POST('/geo15', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas15_i')->name('insertar_cordenadas15_i');
Route::get('/geo24', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas24')->name('insertar_cordenadas24');
Route::POST('/geo24', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas24_i')->name('insertar_cordenadas24_i');

Route::get('/geo25', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas25')->name('insertar_cordenadas25');
Route::POST('/geo25', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas25_i')->name('insertar_cordenadas25_i');
Route::get('/geo35', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas35')->name('insertar_cordenadas35');
Route::POST('/geo35', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas35_i')->name('insertar_cordenadas35_i');
Route::get('/geo41', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas41')->name('insertar_cordenadas41');
Route::POST('/geo41', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas41_i')->name('insertar_cordenadas41_i');
Route::get('/geo45', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas45')->name('insertar_cordenadas45');
Route::POST('/geo45', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas45_i')->name('insertar_cordenadas45_i');
Route::get('/geo46', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas46')->name('insertar_cordenadas46');
Route::POST('/geo46', '\App\Http\Controllers\Operaciones\CordenadasController@insertar_cordenadas46_i')->name('insertar_cordenadas46_i');

require __DIR__.'/auth.php';
