<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Oauth2\AuthController;
use App\Http\Controllers\Api\CurrencyController;
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

Route::middleware(['request.json'])->group(  function () {
    Route::get('test', function(){
        return 'test';
    });
    Route::middleware('auth:api')->get('/user', function (Request $request) {
        return $request->user();
    });

    Route::post('register', [AuthController::class, 'register']);
    Route::post('login', [AuthController::class, 'login']);    
    Route::middleware('auth:api')->group(function () {
        Route::resource('currencies', CurrencyController::class );
        Route::get('currency/{date}', [CurrencyController::class, 'fetch'] );
    });
});