<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Response;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view(uri: 'profile', view: 'profile')->name(name: 'profile');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])
        ->name('profile.update');

    Route::resource(name: 'listusers', controller: \App\Http\Controllers\ListusersController::class);
    Route::resource(name: 'messages', controller: \App\Http\Controllers\MessagesController::class);
    Route::resource(name: 'fileattach', controller: \App\Http\Controllers\FileAttachController::class);
    Route::resource(name: 'assignment', controller: \App\Http\Controllers\AssignmentController::class);
    Route::resource(name: 'submission', controller: \App\Http\Controllers\SubmissionController::class);
    Route::resource(name: 'game', controller: \App\Http\Controllers\GameController::class);
});

require __DIR__ . '/auth.php';
