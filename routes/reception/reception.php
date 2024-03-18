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

use App\Http\Controllers\RecepcionController;

Route::prefix('recepcion')->group(function() {
    Route::get('/', [ RecepcionController::class,  'index' ])->name("recepcion");
    Route::get('asistencia_diaria',[ RecepcionController::class,  'asistencia_diaria' ])->name("asistencia_diaria");
    Route::get('agendamiento_diario', [ RecepcionController::class,  'agendamiento_diario' ])->name("agendamiento_diario");
    Route::get('marcar_salida/{ID?}', [ RecepcionController::class,  'marcar_salida' ])->name("marcar_salida");
});
