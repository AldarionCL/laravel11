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

use App\Http\Controllers\Dyp\DypController;
use App\Http\Controllers\Dyp\FlujoController;
Route::get('dyps/leerQr/', [DypController::class, 'leerQr'])->name('leerQr');
Route::get('dyps/compruebaQr/', [DypController::class, 'compruebaQR'])->name('compruebaQR');
Route::get('dyps/pruebaresponsable/{id}', [DypController::class, 'pruebaresponsable'])->name('pruebaresponsable');


Route::prefix('dyp')->group(function() {
    Route::get('/', [DypController::class, 'index'])->name('dyp');
    Route::get('/mistareas/', [FlujoController::class, 'mistareas'])->name('mistareasdyp');
    Route::get('/nuevodyp/', [FlujoController::class, 'nuevo_dyp'])->name('nuevodyp');
    Route::post('/guardadyp/', [DypController::class, 'store'])->name('guardardyp');
    Route::any('/asignarpuesto/', [FlujoController::class, 'asignar_puesto'])->name('asignarpuesto');
    Route::any('/actualizarpuesto/', [FlujoController::class, 'actualizar_puesto'])->name('actualizarpuestodyp');
    Route::any('/reasignaresponsable/', [FlujoController::class, 'reasignarResponsable'])->name('reasignarResponsable');
    Route::get('/vehiculostaller', [FlujoController::class, 'vehiculos_taller'])->name('vehiculostaller');
    Route::get('/tarea/{id}', [FlujoController::class, 'tarea'])->name('tareadyp');
    Route::get('/taller/{id}', [FlujoController::class, 'taller'])->name('tallerdyp');
    Route::any('/completartarea/{id}/{msj?}', [FlujoController::class, 'completarTarea'])->name('completartareadyp');
    Route::get('/reabrirtarea/{id}/{msj?}', [FlujoController::class, 'reabrirTarea'])->name('reabrirtarea');
    Route::get('/eliminartarea/{id}/{msj?}', [FlujoController::class, 'eliminarTarea'])->name('eliminartarea');
    Route::post('/eliminartrabajo/', [FlujoController::class, 'eliminarTrabajo'])->name('eliminartrabajo');
    Route::get('/despostergartarea/{id}/{msj?}', [FlujoController::class, 'despostergarTarea'])->name('despostergartarea');
    Route::get('/flujo/{id}', [FlujoController::class, 'index'])->name('flujodyp');

    // formularios
    Route::get('/guardarcliente/{id?}', [DypController::class, 'guardarCliente'])->name('guardarCliente');
    Route::get('/guardarvehiculo/{id?}', [DypController::class, 'guardarVehiculo'])->name('guardarVehiculo');
    Route::get('/guardarsiniestro/{id?}', [DypController::class, 'guardarSiniestro'])->name('guardarSiniestro');
    Route::post('/guardararchivos', [DypController::class, 'guardarArchivos'])->name('guardarArchivos');
    Route::post('/eliminadetalleorden', [FlujoController::class, 'eliminarDetalleOrden'])->name('eliminarDetalleOrden');
    Route::post('/agregarDetalleOrden', [FlujoController::class, 'agregarDetalleOrden'])->name('agregarDetalleOrden');

    // utiles
    Route::get('/creatareadyp/{id}', [DypController::class, 'creaTareaDYP'])->name('creaTareaDYP');
    Route::get('/ordentrabajo/{id}', [FlujoController::class, 'ordenTrabajo'])->name('ordenTrabajo');
    Route::get('/crealogdyp/{id}', [DypController::class, 'creaLogDYP'])->name('creaLogDYP');
    Route::get('/cambiafechaegreso/{id}', [FlujoController::class, 'cambiarFechaEgreso'])->name('cambiarFechaEgreso');
    Route::get('/downloadFile/{id}', [FlujoController::class, 'downloadFile'])->name('bajarArchivo');

    Route::prefix('reporte')->group(function() {
        Route::get('/etapas/', [DypController::class, 'reporte_tiempos'])->name('reportetiempos');
    });
});
