<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ApiController;

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

Route::group([
    'prefix' => 'v1'
], function ($router) {
    Route::get('/games', [ApiController::class, 'index']);
    Route::get('/show', [ApiController::class, 'show']);
    Route::post('/push', [ApiController::class, 'push']);
    Route::post('/update', [ApiController::class, 'update']);
    Route::post('/delete', [ApiController::class, 'delete']);
});
