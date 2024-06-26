<?php

use App\Http\Controllers\AnimalController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\UserController;
use App\Http\Controllers\CuidadosController;
use App\Http\Controllers\EspecieController;
use App\Http\Controllers\FormacionController;
use App\Http\Controllers\PadrinoController;
use App\Http\Controllers\TareasController;
use App\Http\Controllers\VoluntarioController;
use App\Http\Controllers\AlimentacionController;
use App\Http\Controllers\DireccionController;
use App\Http\Controllers\NecesidadesController;
use App\Http\Controllers\PermisoController;
use App\Http\Controllers\RolController;

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

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
});

// made by Harkaitz

Route::controller(UserController::class)->group(function () {
    Route::post('/register', 'register');
    Route::post('/login', 'login');
    Route::post('/logout', 'logout');
    Route::get('/users', [UserController::class, 'show']);
    Route::post('/createUser',[UserController::class,'create']);

});
// made by Harkaitz

Route::get('/voluntarios/tareas/{id}', [VoluntarioController::class, 'tareas']);
// made by Harkaitz

Route::apiResource('tareas', TareasController::class);
Route::apiResource('voluntarios', VoluntarioController::class);
Route::apiResource('animal', AnimalController::class);
Route::apiResource('especies', EspecieController::class);
Route::apiResource('cuidados', CuidadosController::class);
Route::apiResource('formacion', FormacionController::class);
Route::apiResource('padrino', PadrinoController::class);
Route::apiResource('alimentacion', AlimentacionController::class);
Route::apiResource('direccion', DireccionController::class);
Route::apiResource('necesidades', NecesidadesController::class);
Route::apiResource('rol', RolController::class);
Route::apiResource('permiso', PermisoController::class);
Route::get('necesidades', [NecesidadesController::class, 'index']);
Route::get('alimentaciones', [AlimentacionController::class, 'index']);
Route::get('cuidados', [CuidadosController::class, 'index']);
