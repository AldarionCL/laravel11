<?php

use App\Http\Controllers\Api\ClientController;
use App\Http\Controllers\Api\LandbotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::middleware('with_api_key')->post('/clientes', [ClientController::class, 'store']);

Route::apiResource('/landbot', LandbotController::class);

