<?php

use App\Http\Controllers\ComputerCourseController;
use App\Http\Controllers\NonComputerCourseController;
use App\Http\Controllers\SubjectController;
use App\Models\NonComputerCourse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::controller(ComputerCourseController::class)->prefix('computer-course')->group(function(){
    Route::get('list/{id}','list')->name('list');
    Route::post('create','create')->name('create');
    Route::post('update','update')->name('update');
    Route::post('delete/{id}','delete')->name('delete');
    Route::get('show/{id}','show')->name('show');
});

Route::controller(NonComputerCourseController::class)->prefix('noncomputer-course')->group(function(){
    Route::get('list/{id}','list')->name('list');
    Route::post('create','create')->name('create');
    Route::post('update','update')->name('update');
    Route::post('delete/{id}','delete')->name('delete');
    Route::get('show/{id}','show')->name('show');
});

Route::controller(SubjectController::class)->prefix('subject')->group(function(){
    Route::get('list/{id}','list')->name('list');
    Route::post('create','create')->name('create');
    Route::post('update','update')->name('update');
    Route::post('delete/{id}','delete')->name('delete');
    Route::get('show/{id}','show')->name('show');
});



