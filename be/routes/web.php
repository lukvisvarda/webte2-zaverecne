<?php

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'jwt.auth'], function () {
    Route::get('/profile', 'ProfileController@index');
    Route::get('/ahoj', function() {
        $ahoj = [
            'meno' => "kokot",
            "priezvisko" => "aosdjaos"
        ];
        return response()->json($ahoj);
    });
});


