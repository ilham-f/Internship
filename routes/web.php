<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\SdmkController;

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

Route::get('/', [HomeController::class, 'index']);
Route::get('/seksi', [HomeController::class, 'seksi']);
Route::get('/lowongan', [HomeController::class, 'lowongan']);
Route::post('/logout', [AuthController::class, 'logout']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/register', [AuthController::class, 'register']);


Route::group(['middleware' => 'auth'], function() {
    Route::group(['middleware' => 'cekrole:mahasiswa'], function() {
        Route::get('/profil', [UserController::class, 'profil']);
        Route::post('/ubahProfil', [UserController::class, 'ubahProfil']);
        Route::get('/kegiatanku', [UserController::class, 'kegiatanku']);
        Route::post('/pendaftaran', [UserController::class, 'pendaftaran']);
        Route::post('/deletepermohonanku', [UserController::class, 'deletepermohonanku']);
        Route::get('/evaluasi', [HomeController::class, 'evaluasi']);
        Route::post('/evaluasi', [UserController::class, 'evaluasi']);
        Route::get('/daftar/{id}', [HomeController::class, 'daftar']);
    });

    Route::group(['middleware' => 'cekrole:admin'], function() {
        Route::get('/admin', [AdminController::class, 'index']);
        Route::get('/mahasiswa', [AdminController::class, 'mahasiswa']);
        Route::get('/kebutuhan', [AdminController::class, 'kebutuhan']);
        Route::post('/addkebutuhan', [AdminController::class, 'addkebutuhan']);
        Route::post('/editkebutuhan', [AdminController::class, 'editkebutuhan']);
        Route::post('/deletekebutuhan', [AdminController::class, 'deletekebutuhan']);
    });

    Route::group(['middleware' => 'cekrole:sdmk'], function() {
        Route::get('/sdmk', [SdmkController::class, 'index']);
        Route::get('/hasilevaluasi', [SdmkController::class, 'hasilevaluasi']);
        Route::get('/semuakebutuhan', [SdmkController::class, 'kebutuhan']);
        Route::get('/kebutuhanku', [SdmkController::class, 'kebutuhanku']);
        Route::post('/addkebutuhanku', [SdmkController::class, 'addkebutuhanku']);
        Route::post('/editkebutuhanku', [SdmkController::class, 'editkebutuhanku']);
        Route::post('/deletekebutuhanku', [SdmkController::class, 'deletekebutuhanku']);
        Route::get('/semuamahasiswa', [SdmkController::class, 'mahasiswa']);
        Route::get('/mahasiswaku', [SdmkController::class, 'mahasiswaku']);
        Route::post('/editmahasiswa', [SdmkController::class, 'editmahasiswa']);
        Route::post('/deletemahasiswa', [SdmkController::class, 'deletemahasiswa']);
        Route::get('/permohonan', [SdmkController::class, 'permohonan']);
        Route::post('/editpermohonan', [SdmkController::class, 'editpermohonan']);
    });
});

// AJAX
// mahasiswa
Route::post('/detailmahasiswa', [SdmkController::class, 'detailmahasiswa']);
Route::post('/ubahmahasiswa', [SdmkController::class, 'ubahmahasiswa']);
Route::post('/hapusmahasiswa', [SdmkController::class, 'hapusmahasiswa']);

// kebutuhan
Route::post('/detailkebutuhan', [AdminController::class, 'detailkebutuhan']);
Route::post('/ubahkebutuhan', [AdminController::class, 'ubahkebutuhan']);
Route::post('/hapuskebutuhan', [AdminController::class, 'hapuskebutuhan']);

// Permohonan
Route::post('/detailpermohonan', [SdmkController::class, 'detailpermohonan']);
Route::post('/ubahpermohonan', [SdmkController::class, 'ubahpermohonan']);

Route::post('/detailpermohonanku', [UserController::class, 'detailpermohonanku']);
Route::post('/hapuspermohonanku', [UserController::class, 'hapuspermohonanku']);

// lowongan
Route::post('/detaillowongan', [HomeController::class, 'detaillowongan']);

// EXPORT
// mahasiswa
Route::get('/export-mahasiswa', [SdmkController::class, 'exportmahasiswa']);
// kebutuhan
Route::get('/export-kebutuhan', [SdmkController::class, 'exportkebutuhan']);
