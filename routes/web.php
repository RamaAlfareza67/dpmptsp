<?php

use App\Http\Controllers\AdminController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\Home;

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

Route::get('/', [Home::class, 'home']);
Route::get('/berita', [Home::class, 'berita']);
Route::get('/struktur_organisasi', [Home::class, 'struktur_organisasi']);
Route::get('/visi_misi', [Home::class, 'visi_misi']);
Route::get('/layanan_dinas', [Home::class, 'layanan_dinas']);


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('custom-login', [LoginController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [LoginController::class, 'signOut'])->name('signout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/user', [AdminController::class, 'index'])->middleware('user_access');
    Route::get('/user/dashboard', [AdminController::class, 'dashboard'])->middleware('user_access');
    Route::get('/user/get_count', [AdminController::class, 'get_count'])->middleware('user_access');
    Route::get('/user/artikel', [AdminController::class, 'artikel'])->middleware('user_access');
    Route::post('/user/artikel_', [AdminController::class, 'artikel_'])->middleware('user_access');
    Route::post('/user/create_artikel', [AdminController::class, 'create_artikel'])->middleware('user_access');
    Route::post('/user/update_artikel', [AdminController::class, 'update_artikel'])->middleware('user_access');
    Route::post('/user/delete_artikel', [AdminController::class, 'delete_artikel'])->middleware('user_access');
    Route::get('/user/pegawai', [AdminController::class, 'pegawai'])->middleware('user_access');
    Route::post('/user/pegawai_', [AdminController::class, 'pegawai_'])->middleware('user_access');
    Route::post('/user/create_pegawai', [AdminController::class, 'create_pegawai'])->middleware('user_access');
    Route::post('/user/update_pegawai', [AdminController::class, 'update_pegawai'])->middleware('user_access');
    Route::post('/user/delete_pegawai', [AdminController::class, 'delete_pegawai'])->middleware('user_access');
    Route::get('/user/visi_misi', [AdminController::class, 'visi_misi'])->middleware('user_access');
    Route::post('/user/create_visi_misi', [AdminController::class, 'create_visi_misi'])->middleware('user_access');
    Route::get('/user/struktur_organisasi', [AdminController::class, 'struktur_organisasi'])->middleware('user_access');
    Route::post('/user/create_st_organisasi', [AdminController::class, 'create_st_organisasi'])->middleware('user_access');
    Route::get('/user/profil_dinas', [AdminController::class, 'profil_dinas'])->middleware('user_access');
    Route::post('/user/create_profil_dinas', [AdminController::class, 'create_profil_dinas'])->middleware('user_access');
    Route::get('/user/layanan_dinas', [AdminController::class, 'layanan_dinas'])->middleware('user_access');
    Route::post('/user/layanan_dinas_', [AdminController::class, 'layanan_dinas_'])->middleware('user_access');
    Route::post('/user/create_layanan_dinas', [AdminController::class, 'create_layanan_dinas'])->middleware('user_access');
    Route::post('/user/update_layanan_dinas', [AdminController::class, 'update_layanan_dinas'])->middleware('user_access');
    Route::post('/user/delete_layanan_dinas', [AdminController::class, 'delete_layanan_dinas'])->middleware('user_access');
    Route::get('/user/profil', [AdminController::class, 'profil'])->middleware('user_access');
    Route::post('/user/update_profil', [AdminController::class, 'update_profil'])->middleware('user_access');
});
