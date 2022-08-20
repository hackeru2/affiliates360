<?php
use \App\Http\Controllers\ProjectController;
use Illuminate\Support\Facades\Route;
use \App\Http\Controllers\TodoController;

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





Route::group(['prefix' => 'api/'] , function(){
    Route::resource('todos', TodoController::class);
    Route::resource('projects', ProjectController::class);
//   Route::get('users' , UsersController::class);
    Route::get('/users', \App\Http\Controllers\UserController::class);
    Route::put('todos/{todo}/views', [TodoController::class, 'updateViews']);


});
Route::get('{any}', function () {
    return view('welcome');
})->where('any', '.*');
