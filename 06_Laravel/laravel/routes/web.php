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
Route::get('/notperm', function () {
    return view('notperm');
});

Route::group(['middleware' => 'auth'], function () {
    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::view(uri: 'profile', view: 'profile')->name(name: 'profile');
    Route::put('profile', [\App\Http\Controllers\ProfileController::class, 'update'])
        ->name('profile.update');


    //Route::resource(name: 'listusers', controller: \App\Http\Controllers\ListusersController::class)->middleware('role');
    Route::get('/listusers','\App\Http\Controllers\ListusersController@index') ->name('listusers.index');
    Route::get('/listusers/create','\App\Http\Controllers\ListusersController@create') ->name('listusers.create')->middleware('role');
    Route::post('/listusers','\App\Http\Controllers\ListusersController@store') ->name('listusers.store')->middleware('role');
    Route::put('/listusers/{id}','\App\Http\Controllers\ListusersController@update') ->name('listusers.update')->middleware('role');
    Route::delete('/listusers/{id}','\App\Http\Controllers\ListusersController@destroy') ->name('listusers.destroy')->middleware('role');
    Route::get('/listusers/{id}','\App\Http\Controllers\ListusersController@show') ->name('listusers.show');
    Route::get('/listusers/{id}/edit','\App\Http\Controllers\ListusersController@edit') ->name('listusers.edit')->middleware('role');

    Route::resource(name: 'messages', controller: \App\Http\Controllers\MessagesController::class);
    Route::resource(name: 'fileattach', controller: \App\Http\Controllers\FileAttachController::class);
    Route::resource(name: 'assignment', controller: \App\Http\Controllers\AssignmentController::class);
    Route::resource(name: 'submission', controller: \App\Http\Controllers\SubmissionController::class);
    Route::resource(name: 'game', controller: \App\Http\Controllers\GameController::class);

//     +--------+-----------+-------------------+---------------+---------------------------------------------+--------------+
// | Domain | Method    | URI               | Name          | Action                                      | Middleware   |
// +--------+-----------+-------------------+---------------+---------------------------------------------+--------------+
// |        | GET|HEAD  | api/user          |               | Closure                                     | api,auth:api |
// |        | GET|HEAD  | blogs             | blogs.index   | App\Http\Controllers\BlogController@index   | web          |
// |        | POST      | blogs             | blogs.store   | App\Http\Controllers\BlogController@store   | web          |
// |        | GET|HEAD  | blogs/create      | blogs.create  | App\Http\Controllers\BlogController@create  | web          |
// |        | GET|HEAD  | blogs/{blog}      | blogs.show    | App\Http\Controllers\BlogController@show    | web          |
// |        | PUT|PATCH | blogs/{blog}      | blogs.update  | App\Http\Controllers\BlogController@update  | web          |
// |        | DELETE    | blogs/{blog}      | blogs.destroy | App\Http\Controllers\BlogController@destroy | web          |
// |        | GET|HEAD  | blogs/{blog}/edit | blogs.edit    | App\Http\Controllers\BlogController@edit    | web          |
// +--------+-----------+-------------------+---------------+---------------------------------------------+--------------+
});

require __DIR__ . '/auth.php';
