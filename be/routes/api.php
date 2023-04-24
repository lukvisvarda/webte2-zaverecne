<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use \App\Http\Controllers\ParserController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

//Route::post('/auth/login', 'App\Http\Controllers\AuthController@login');
Route::post('/auth/login', [AuthController::class, 'login'])->middleware('cors');

Route::middleware('jwt.auth')->get('auth/me', [AuthController::class, 'me']);

Route::post('/latex', [ParserController::class, 'store']);

