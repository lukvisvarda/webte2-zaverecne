<?php

use App\Http\Controllers\AssignThesisController;
use App\Http\Controllers\ParserController;
use App\Http\Controllers\TutorialController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\UserProblemController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;

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

Route::post('auth/login', [AuthController::class, 'login']);
Route::post('auth/register', [AuthController::class, 'register']);



//    Route::post('/auth/login', [AuthController::class, 'login']);

Route::middleware('jwt.auth')->get('auth/me', [AuthController::class, 'me']);

Route::middleware('jwt.auth')->post('/latex', [ParserController::class, 'store']);

Route::middleware('jwt.auth')->get('/latex', [ParserController::class, 'index']);

Route::middleware('jwt.auth')->put('/latex/assign/{id}', [ParserController::class, 'assign']);

Route::middleware('jwt.auth')->post('/latex/assign', [AssignThesisController::class, 'store']);

Route::middleware('jwt.auth')->post('/user/generate', [UserController::class, 'addRandomProblemFromSelectedLatexFiles']);

Route::middleware('jwt.auth')->get('/user/{id}/problems', [UserProblemController::class, 'getProblemsByStudentId']);

Route::middleware('jwt.auth')->get('/user-problem', [UserProblemController::class, 'getAll']);

Route::middleware('jwt.auth')->get('/latex/assign', [AssignThesisController::class, 'getAssignedThesis']);

Route::middleware('jwt.auth')->get('/user/student', [UserController::class, 'getAllStudents']);

Route::middleware('jwt.auth')->get('/latex/assign', [AssignThesisController::class, 'getAssignedThesis']);

Route::middleware('jwt.auth')->post("/user/csv", [UserController::class, "downloadCSV"]);

Route::middleware('jwt.auth')->get("/user/{id}", [UserController::class, "getUserById"]);

Route::middleware('jwt.auth')->get("/tutorial", [TutorialController::class, "getTutorial"]);

Route::middleware('jwt.auth')->put("/tutorial", [TutorialController::class, "updateTutorial"]);
//Route::post('/auth/login', 'App\Http\Controllers\AuthController@login');

Route::middleware('jwt.auth')->get('/problems/{id}', [UserProblemController::class, 'getSingleProblem']);

Route::middleware('jwt.auth')->post('/teacher/upload', [UserController::class, 'uploadImages']);

