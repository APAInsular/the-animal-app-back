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


Route::resource('species', App\Http\Controllers\SpeciesController::class)->only('index', 'create', 'store');

Route::resource('races', App\Http\Controllers\RaceController::class)->only('index', 'create', 'store');

Route::resource('zones', App\Http\Controllers\ZoneController::class)->only('index', 'create', 'store');

Route::resource('animals', App\Http\Controllers\AnimalController::class)->only('index', 'create', 'store');

Route::resource('documents', App\Http\Controllers\DocumentController::class)->only('index', 'create', 'store');

Route::resource('users', App\Http\Controllers\UserController::class)->only('index', 'create', 'store');

Route::resource('microchips', App\Http\Controllers\MicrochipController::class)->only('index', 'create', 'store');

Route::resource('medical-histories', App\Http\Controllers\MedicalHistoryController::class)->only('index', 'create', 'store');

Route::resource('treatments', App\Http\Controllers\TreatmentController::class)->only('index', 'create', 'store');

Route::resource('medicines', App\Http\Controllers\MedicineController::class)->only('index', 'create', 'store');

Route::resource('cares', App\Http\Controllers\CareController::class)->only('index', 'create', 'store');

Route::resource('tasks', App\Http\Controllers\TaskController::class)->only('index', 'create', 'store');

Route::resource('feeds', App\Http\Controllers\FeedController::class)->only('index', 'create', 'store');

Route::resource('needs', App\Http\Controllers\NeedsController::class)->only('index', 'create', 'store');

Route::resource('roles', App\Http\Controllers\RoleController::class)->only('index', 'create', 'store');
