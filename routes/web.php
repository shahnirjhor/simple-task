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
    return redirect('login');
});

Auth::routes();

Route::group(['middleware' => ['auth']], function () {

    Route::resources([
        'roles' => App\Http\Controllers\RoleController::class,
        'users' => App\Http\Controllers\UserController::class,
        'item' => App\Http\Controllers\ItemController::class,
        'posts' => App\Http\Controllers\PostController::class,
    ]);

    Route::get('/apsetting', [
        'uses' => 'App\Http\Controllers\ApplicationSettingController@index',
        'as' => 'apsetting'
    ]);

    Route::post('/apsetting/update', [
        'uses' => 'App\Http\Controllers\ApplicationSettingController@update',
        'as' => 'apsetting.update'
    ]);
});

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
