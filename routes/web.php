<?php

use App\Http\Controllers\TeambuilderController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ServantController;
use App\Http\Controllers\CraftessenceController;
use App\Http\Controllers\MaterialController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\CharacterPlannerController;


Route::get('/login', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::resource('servants', ServantController::class);
Route::resource('craftessences', CraftessenceController::class);
Route::resource('materials', MaterialController::class);
Route::resource('teambuilders', TeambuilderController::class);
Route::resource('character-planner', CharacterPlannerController::class);
Route::get('materials/lookup', [MaterialController::class, 'lookup'])->name('materials.lookup');
Route::get('/craftessences/{craftessence}/image', [CraftessenceController::class, 'showImage'])
    ->name('craftessences.image');
Route::get('/materials/{material}/image', [MaterialController::class, 'showImage'])
    ->name('materials.image');
Route::post('/servants/{servant}/upload-photo', [ServantController::class, 'uploadPhoto'])
    ->name('servants.upload-photo');
Route::get('/servants/{servant}/remove-photo', [ServantController::class, 'removePhoto'])
    ->name('servants.remove-photo');
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');
Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);
Route::resource('teambuilders', TeambuilderController::class);
Route::resource('character-planner', CharacterPlannerController::class)
    ->only(['index', 'create', 'store', 'destroy']);


