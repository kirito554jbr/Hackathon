<?php

use App\Http\Controllers\AssessmentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HackathoneController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\TeamController;
use App\Http\Controllers\UserController;
use App\Models\Assessment;
use App\Models\Team;
use PHPUnit\TextUI\XmlConfiguration\Logging\TeamCity;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
    Route::post('/logout', 'logout');
    Route::get('/refresh', 'refresh');

})->middleware('auth:jwt');

Route::controller(HackathoneController::class)->group(function () {
    Route::get('hackathon', 'index');
    Route::post('hackathon/create', 'create')->middleware("organisateur");
    Route::get('hackathon/show/{id}', 'show');
    Route::put('hackathon/update/{id}', 'update')->middleware("organisateur");
    Route::delete('hackathon/delete/{id}', 'delete');
})->middleware('auth:jwt');




Route::controller(TeamController::class)->group(function () {
    Route::get('team', 'index');
    Route::post('team/create', 'create');
    Route::get('team/show/{id}', 'show');
    Route::put('team/update/{id}', 'update');
    Route::delete('team/delete/{id}', 'delete');
})->middleware('auth:jwt');


Route::controller(AssessmentController::class)->group(function () {
    Route::get('assessment', 'index');
    Route::post('assessment/create', 'create')->middleware('jury');
    Route::get('assessment/show/{id}', 'show');
    Route::put('assessment/update/{id}', 'update')->middleware('jury');
    Route::delete('assessment/delete/{id}', 'delete');
})->middleware('auth:jwt');



Route::controller(ProjectController::class)->group(function () {
    Route::get('project', 'index');
    Route::post('project/create', 'create');
    Route::get('project/show/{id}', 'show');
    Route::put('project/update/{id}', 'update');
    Route::delete('project/delete/{id}', 'delete');
})->middleware('auth:jwt');



Route::controller(UserController::class)->group(function () {
    Route::get('user', 'index');
    Route::post('user/create', 'create');
    Route::get('user/show/{id}', 'show');
    Route::put('user/update/{id}', 'update');
    Route::delete('user/delete/{id}', 'delete');
})->middleware('auth:jwt');



Route::controller(RoleController::class)->group(function () {
    Route::get('role', 'index');
    Route::post('role/create', 'create')->middleware('Admin');
    Route::get('role/show/{id}', 'show');
    Route::put('role/update/{id}', 'update')->middleware('Admin');
    Route::delete('role/delete/{id}', 'delete')->middleware('Admin');
})->middleware('auth:jwt');
    
    
    Route::post('inscription', [HackathoneController::class, 'inscription']);
Route::post('joinAteam', [TeamController::class, 'joinAteam']);

// Route::get('/role/create', [RoleController::class, 'create']);   
