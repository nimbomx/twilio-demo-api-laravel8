<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProvidersController;
use App\Http\Controllers\TwilioController;
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

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum')->get('/providers', [ProvidersController::class, 'index']);
Route::middleware('auth:sanctum')->post('/twilio/callme', [TwilioController::class, 'callme']);
Route::middleware('auth:sanctum')->post('/twilio/connect_call', [TwilioController::class, 'connectCall']);
Route::get('/twilio/sse/{id}', [TwilioController::class, 'sse']);
Route::post('/twilio/admin_events/{id}', [TwilioController::class, 'adminEvents']);
Route::post('/twilio/provider_events/{id}', [TwilioController::class, 'providerEvents']);
Route::get('/twilio/outbound/{phone}/{id}', [TwilioController::class, 'outbound']);

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});
