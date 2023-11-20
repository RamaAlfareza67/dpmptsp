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
Route::get('/berita/detail/{id}', [Home::class, 'berita_detail']);
Route::get('/struktur_organisasi', [Home::class, 'struktur_organisasi']);
Route::get('/visi_misi', [Home::class, 'visi_misi']);
Route::get('/layanan_dinas', [Home::class, 'layanan_dinas']);
Route::get('/kontak', [Home::class, 'kontak']);
// Route::get('/berita_detail', [Home::class, 'berita_detail']);
Route::get('/pengaduan', [Home::class, 'pengaduan']);
Route::get('/wbs', [Home::class, 'wbs']);
Route::post('/create_pengaduan', [Home::class, 'create_pengaduan']);
Route::post('/create_wbs', [Home::class, 'create_wbs']);
Route::post('/grafik_realisasi_investasi_publik', [Home::class, 'grafik_realisasi_investasi_publik']);


Route::get('login', [LoginController::class, 'index'])->name('login');
Route::post('custom-login', [LoginController::class, 'customLogin'])->name('login.custom');
Route::get('signout', [LoginController::class, 'signOut'])->name('signout');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/user', [AdminController::class, 'index'])->middleware('user_access');
    Route::get('/user/dashboard', [AdminController::class, 'dashboard'])->middleware('user_access');
    Route::get('/user/dashboard_investasi', [AdminController::class, 'dashboard_investasi'])->middleware('user_access');
    Route::get('/user/get_count', [AdminController::class, 'get_count'])->middleware('user_access');
    Route::get('/user/grafik_pengaduan', [AdminController::class, 'grafik_pengaduan'])->middleware('user_access');
    Route::get('/user/grafik_pengaduan_wbs', [AdminController::class, 'grafik_pengaduan_wbs'])->middleware('user_access');
    Route::post('/user/get_new_artikel_', [AdminController::class, 'get_new_artikel_'])->middleware('user_access');
    Route::post('/user/grafik_realisasi_investasi', [AdminController::class, 'grafik_realisasi_investasi'])->middleware('user_access');

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
    Route::get('/user/informasi_publik', [AdminController::class, 'informasi_publik'])->middleware('user_access');
    Route::post('/user/informasi_publik_', [AdminController::class, 'informasi_publik_'])->middleware('user_access');
    Route::post('/user/create_informasi_publik', [AdminController::class, 'create_informasi_publik'])->middleware('user_access');
    Route::post('/user/update_informasi_publik', [AdminController::class, 'update_informasi_publik'])->middleware('user_access');
    Route::post('/user/delete_informasi_publik', [AdminController::class, 'delete_informasi_publik'])->middleware('user_access');
    Route::get('/user/pengaduan', [AdminController::class, 'pengaduan'])->middleware('user_access');
    Route::post('/user/pengaduan_', [AdminController::class, 'pengaduan_'])->middleware('user_access');
    Route::post('/user/accept_rejact_pengaduan', [AdminController::class, 'accept_rejact_pengaduan'])->middleware('user_access');
    Route::get('/user/detail_pengadu/{id}', [AdminController::class, 'detail_pengadu'])->middleware('user_access');
    Route::post('/user/get_detail_pengaduan', [AdminController::class, 'get_detail_pengaduan'])->middleware('user_access');
    Route::get('/user/jenis_pengaduan', [AdminController::class, 'jenis_pengaduan'])->middleware('user_access');
    Route::post('/user/jenis_pengaduan_', [AdminController::class, 'jenis_pengaduan_'])->middleware('user_access');
    // Route::post('/user/get_select_jenis', [AdminController::class, 'get_select_jenis'])->middleware('user_access');
    Route::post('/user/create_jenis_pengaduan', [AdminController::class, 'create_jenis_pengaduan'])->middleware('user_access');
    Route::post('/user/update_jenis_pengaduan', [AdminController::class, 'update_jenis_pengaduan'])->middleware('user_access');
    Route::post('/user/delete_jenis_pengaduan', [AdminController::class, 'delete_jenis_pengaduan'])->middleware('user_access');
    Route::get('/user/user_management', [AdminController::class, 'user_management'])->middleware('user_access');
    Route::post('/user/user_management_', [AdminController::class, 'user_management_'])->middleware('user_access');
    Route::post('/user/create_user_management', [AdminController::class, 'create_user_management'])->middleware('user_access');
    Route::post('/user/update_user_management', [AdminController::class, 'update_user_management'])->middleware('user_access');
    Route::post('/user/delete_user_management', [AdminController::class, 'delete_user_management'])->middleware('user_access');

    Route::get('/user/investasi', [AdminController::class, 'investasi'])->middleware('user_access');
    Route::post('/user/investasi_', [AdminController::class, 'investasi_'])->middleware('user_access');
    Route::post('/user/create_investasi', [AdminController::class, 'create_investasi'])->middleware('user_access');
    Route::post('/user/update_investasi', [AdminController::class, 'update_investasi'])->middleware('user_access');
    Route::post('/user/delete_investasi', [AdminController::class, 'delete_investasi'])->middleware('user_access');
    Route::get('/user/get_tahun_investasi', [AdminController::class, 'get_tahun_investasi'])->middleware('user_access');

    Route::get('/user/wbs', [AdminController::class, 'wbs'])->middleware('user_access');
    Route::post('/user/wbs_', [AdminController::class, 'wbs_'])->middleware('user_access');
    Route::post('/user/accept_rejact_wbs', [AdminController::class, 'accept_rejact_wbs'])->middleware('user_access');
    Route::post('/user/process_wbs', [AdminController::class, 'process_wbs'])->middleware('user_access');
    Route::get('/user/detail_pengadu_wbs/{id}', [AdminController::class, 'detail_pengadu_wbs'])->middleware('user_access');
    Route::post('/user/get_detail_wbs', [AdminController::class, 'get_detail_wbs'])->middleware('user_access');
});
