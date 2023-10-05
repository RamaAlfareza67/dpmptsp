<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;

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

Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('custom-login', [LoginController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [LoginController::class, 'signOut'])->name('signout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/', [AdminController::class, 'index'])->middleware('user_access');
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->middleware('user_access');
    Route::get('/get_count', [AdminController::class, 'get_count'])->middleware('user_access');
    Route::get('/artikel', [AdminController::class, 'artikel'])->middleware('user_access');
    Route::post('/artikel_', [AdminController::class, 'artikel_'])->middleware('user_access');
    Route::post('/create_artikel', [AdminController::class, 'create_artikel'])->middleware('user_access');
    Route::post('/update_artikel', [AdminController::class, 'update_artikel'])->middleware('user_access');
    Route::post('/delete_artikel', [AdminController::class, 'delete_artikel'])->middleware('user_access');
    Route::get('/pegawai', [AdminController::class, 'pegawai'])->middleware('user_access');
});
