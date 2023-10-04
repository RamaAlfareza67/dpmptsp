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
});
