<?php

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

use App\Http\Controllers\Cpd\CpdController;
use App\Http\Controllers\Cpd\FlujoCpdController;
Route::get('cpds/leerQr/', [CpdController::class, 'leerQr'])->name('leerQrCpd');
Route::get('cpds/compruebaQr/', [CpdController::class, 'compruebaQR'])->name('compruebaQRcpd');


Route::prefix('cpd')->group(function() {
    Route::get('/', [CpdController::class, 'index'])->name('cpd');
    Route::get('/mistareas/', [FlujoCpdController::class, 'mistareas'])->name('mistareascpd');
    Route::get('/nuevocpd/', [FlujoCpdController::class, 'nuevo_cpd'])->name('nuevocpd');
    Route::post('/guardacpd/', [CpdController::class, 'store'])->name('guardarcpd');
    Route::any('/asignarpuesto/', [FlujoCpdController::class, 'asignar_puesto'])->name('asignarpuestocpd');
    Route::any('/actualizarpuesto/', [FlujoCpdController::class, 'actualizar_puesto'])->name('actualizarpuestocpd');
    Route::any('/reasignaresponsable/', [FlujoCpdController::class, 'reasignarResponsable'])->name('reasignarResponsablecpd');
    Route::get('/vehiculostaller/{id}', [FlujoCpdController::class, 'vehiculos_taller'])->name('vehiculostallercpd');
    Route::get('/tarea/{id}', [FlujoCpdController::class, 'tarea'])->name('tareacpd');
    Route::get('/wip/{id}', [FlujoCpdController::class, 'wip'])->name('wipcpd');
    Route::any('/completartarea/{id}/{msj?}', [FlujoCpdController::class, 'completarTarea'])->name('completartareacpd');
    Route::get('/reabrirtarea/{id}/{msj?}', [FlujoCpdController::class, 'reabrirTarea'])->name('reabrirtareacpd');
    Route::get('/eliminartarea/{id}/{msj?}', [FlujoCpdController::class, 'eliminarTarea'])->name('eliminartareacpd');
    Route::get('/despostergartareacpd/{id}/{msj?}', [FlujoCpdController::class, 'despostergarTarea'])->name('despostergartareacpd');
    Route::get('/flujo/{id}', [FlujoCpdController::class, 'index'])->name('flujocpd');
    Route::get('/getoptions/{id}', [FlujoCpdController::class, 'getOptions'])->name('getoptions');

    // formularios
    Route::get('/guardarcliente/{id?}', [CpdController::class, 'guardarCliente'])->name('guardarClientecpd');
    Route::get('/guardarvehiculo', [CpdController::class, 'guardarVehiculo'])->name('guardarVehiculocpd');
    Route::get('/guardarsiniestro/{id?}', [CpdController::class, 'guardarSiniestro'])->name('guardarSiniestrocpd');
    Route::post('/guardararchivos', [CpdController::class, 'guardarArchivos'])->name('guardarArchivoscpd');

    // utiles
    Route::get('/creatareacpd/{id}', [CpdController::class, 'creaTareaCPD'])->name('creaTareaCPD');
    Route::get('/formulariocalidad/{id}', [FlujoCpdController::class, 'FormularioCalidad'])->name('formulariocalidadcpd');
    Route::get('/formularioinspeccion/{id}', [FlujoCpdController::class, 'FormularioInspeccion'])->name('formularioinspeccioncpd');
    Route::get('/crealogcpd/{id}', [CpdController::class, 'creaLogCPD'])->name('creaLogCPD');
    Route::get('/cambiafechaegreso/{id}', [FlujoCpdController::class, 'cambiarFechaEgreso'])->name('cambiarFechaEgresocpd');
    Route::get('/downloadFile/{id}', [FlujoCpdController::class, 'downloadFile'])->name('bajarArchivocpd');

    Route::prefix('reporte')->group(function() {
        Route::get('/etapas/', [CpdController::class, 'reporte_tiempos'])->name('reportetiemposcpd');
        Route::get('/wip/', [CpdController::class, 'reporte_wip'])->name('reportewipcpd');
        Route::get('/preparacion/', [CpdController::class, 'reporte_preparacion'])->name('reportepreparacioncpd');
        Route::get('/comite/', [CpdController::class, 'reporte_comite'])->name('reportecomite');
        Route::get('/mayorista/', [CpdController::class, 'reporte_mayorista'])->name('reportemayorista');
        Route::get('/judicial/', [CpdController::class, 'reporte_judicial'])->name('reportejudicial');
    });
});
