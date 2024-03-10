<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\ReservaController;
use App\Http\Controllers\Api\GiftCardController;
use App\Http\Controllers\Api\AuxiliaresController;

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

Route::post('/login',[AuthController::class,'login']);
Route::get('/envio-email',[AuthController::class,'envioEmail']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('reservas',[ReservaController::class,'index'])->middleware('auth:sanctum');
Route::post('reservas',[ReservaController::class,'store']);
Route::get('reservas',[ReservaController::class,'store']);

Route::get('estadisticas',[ReservaController::class,'estadisticas'])->middleware('auth:sanctum');

// Route::get('giftcard-api', [GiftcardController::class,'index'] ); // Probando la ruta para visualizar


Route::get('giftcard', [GiftCardController::class,'index'] );

Route::prefix("giftcard")->group(function(){

    Route::post('giftcard', [GiftCardController::class,'store'] );
    Route::post('guardar_masivo', [GiftCardController::class,'guardar_masivo'] );

    Route::get('/filtros/{id}/{tipo}', [GiftCardController::class,'filtros'])->name('api.filtros') ;
    Route::get('/generar_qr', [GiftCardController::class,'generar_qr'])->name('api.generar_qr');  //;
    Route::get('/revisar_qr/{id}', [GiftCardController::class,'revisar_qr'])->name('api.revisar_qr');  //;
    Route::post('/estado_pago', [GiftCardController::class,'estado_pago'] );
});

Route::prefix("auxiliares")->group(function(){
    Route::get('/gift_estados',[AuxiliaresController::class, 'gift_estados']);
    Route::get('/gift_estado_pagos',[AuxiliaresController::class, 'gift_estado_pagos']);
    Route::get('/gift_credito',[AuxiliaresController::class, 'gift_credito']);
    Route::get('/gift_formas_pago',[AuxiliaresController::class, 'gift_formas_pago']);
});


// Route::get('users/{id}', function ($id) {

// });

