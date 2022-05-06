<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\CommentsController;
use App\Http\Controllers\PublicationsController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

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

Auth::routes();

Route::get('/', function (){
    return redirect('/publication');
});

Route::get('/setting', [UserController::class, 'edit'])->name('setting');
Route::put('/setting/{id}', [UserController::class, 'update'])->name('user.update');
Route::get('/filtered/{id}', [PublicationsController::class, 'getByCategory'])->name('filtered');

Route::resource('publications', PublicationsController::class, [
    'only' => ['index', 'show']
]);

Route::post('/comment/{id}', [CommentsController::class, 'store']);

Route::resource('comments', CommentsController::class);
Route::resource('categories', CategoriesController::class, [
    'except' => ['destroy']
]);

Route::group(['prefix' => 'admin', 'middleware' => 'admin'], function () {
    Route::get('/', [AdminController::class, 'index'])->name('admin');
    Route::resource('publications', PublicationsController::class, [
        'except' => ['index', 'show']
    ]);
    Route::resource('categories', CategoriesController::class, [
        'only' => ['destroy']
    ]);
});
