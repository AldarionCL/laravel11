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

use App\Http\Controllers\Tdrive\TdriveController;
use App\Http\Controllers\Tdrive\FlujoTdriveController;
Route::get('tdrives/leerQr/', [TdriveController::class, 'leerQr'])->name('leerQrTdrive');
Route::get('tdrives/compruebaQr/', [TdriveController::class, 'compruebaQR'])->name('compruebaQRTdrive');


Route::prefix('tdrive')->group(function() {
    Route::get('/', [TdriveController::class, 'index'])->name('tdrive');
    Route::get('/mistareas/', [FlujoTdriveController::class, 'mistareas'])->name('mistareastdrive');
    Route::get('/nuevotdrive/', [FlujoTdriveController::class, 'nuevo_tdrive'])->name('nuevotdrive');
    Route::post('/guardatdrive/', [TdriveController::class, 'store'])->name('guardartdrive');
    Route::any('/asignarpuesto/', [FlujoTdriveController::class, 'asignar_puesto'])->name('asignarpuestotdrive');
    Route::any('/reasignaresponsable/', [FlujoTdriveController::class, 'reasignarResponsable'])->name('reasignarResponsabletdrive');
    Route::get('/vehiculostaller/{id}', [FlujoTdriveController::class, 'vehiculos_taller'])->name('vehiculostallertdrive');
    Route::get('/tarea/{id}', [FlujoTdriveController::class, 'tarea'])->name('tareatdrive');
    Route::get('/taller/{id}', [FlujoTdriveController::class, 'taller'])->name('tallertdrive');
    Route::any('/completartarea/{id}/{msj?}', [FlujoTdriveController::class, 'completarTarea'])->name('completartareatdrive');
    Route::get('/reabrirtarea/{id}/{msj?}', [FlujoTdriveController::class, 'reabrirTarea'])->name('reabrirtareatdrive');
    Route::get('/despostergartarea/{id}/{msj?}', [FlujoTdriveController::class, 'despostergarTarea'])->name('despostergartareatdrive');
    Route::get('/flujo/{id}', [FlujoTdriveController::class, 'index'])->name('flujotdrive');

    // formularios
    Route::get('/guardarcliente/{id?}', [TdriveController::class, 'guardarCliente'])->name('guardarClientetdrive');
    Route::get('/guardarvehiculo/{id?}', [TdriveController::class, 'guardarVehiculo'])->name('guardarVehiculotdrive');
    Route::get('/guardarsiniestro/{id?}', [TdriveController::class, 'guardarSiniestro'])->name('guardarSiniestrotdrive');
    Route::post('/guardararchivos', [TdriveController::class, 'guardarArchivos'])->name('guardarArchivostdrive');

    // utiles
    Route::get('/creatareatdrive/{id}', [TdriveController::class, 'creaTareaTDRIVE'])->name('creaTareaTDRIVE');
    Route::get('/ordentrabajo/{id}', [FlujoTdriveController::class, 'ordenTrabajo'])->name('ordenTrabajotdrive');
    Route::get('/crealogtdrive/{id}', [TdriveController::class, 'creaLogTDRIVE'])->name('creaLogTDRIVE');
    Route::get('/cambiafechaegreso/{id}', [FlujoTdriveController::class, 'cambiarFechaEgreso'])->name('cambiarFechaEgresotdrive');
    Route::get('/downloadFile/{id}', [FlujoTdriveController::class, 'downloadFile'])->name('bajarArchivotdrive');

    Route::prefix('reporte')->group(function() {
        Route::get('/etapas/', [TdriveController::class, 'reporte_tiempos'])->name('reportetiempostdrive');
    });
});
