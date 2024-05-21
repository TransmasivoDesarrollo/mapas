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
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    
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
    Route::get('/Contratos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Contratos');
    Route::POST('/Contratos', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@generarContratos');
    Route::get('/Personal', '\App\Http\Controllers\Recursos_Humanos\RecursosHumanosControlador@Personal');
   

    //operaciones
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
    
    
    
});

require __DIR__.'/auth.php';
