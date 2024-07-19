<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AdminController;
use App\Http\Controllers\PortfolioController;
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
// LOGIN
Route::get('/register', [AdminController::class, 'register'])->name('register');
Route::get('/', [AdminController::class, 'login'])->name('login');
Route::post('/login/submit', [AdminController::class, 'loginsubmit'])->name('loginsubmit');



Route::get('/navbar/header', [PortfolioController::class, 'index']);
Route::get('/isi/dashboard', [PortfolioController::class, 'dashboard']);
Route::get('/isi/dataproduk', [PortfolioController::class, 'dataproduk']);
Route::get('/isi/laporan', [PortfolioController::class, 'laporan']);
// Route::get('/layouts/sidebar', [PortfolioController::class, 'dataproduk']);

Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');


// DATABARANG
Route::get('/admin/dataproduk', [AdminController::class, 'databarang'])->name('databarang');
Route::get('/admin/dataproduk/tambah', [AdminController::class, 'tambahdatabarang'])->name('tambahdatabarang');
Route::post('/admin/dataproduk/tambah/submit', [AdminController::class, 'tambahdatabarangsubmit'])->name('tambahdatabarangsubmit');
Route::get('/admin/dataproduk/edit/{id}', [AdminController::class, 'editdatabarang'])->name('editdatabarang');
Route::post('/admin/dataproduk/edit/submit/{id}', [AdminController::class, 'editdatabarangsubmit'])->name('editdatabarangsubmit');
Route::post('/uploadgambar', [AdminController::class, 'uploadgambar'])->name('uploadgambar');



// DATA PEMBAYARAN
Route::post('/admin/pembayaran', [AdminController::class, 'pembayaran'])->name('pembayaran');
Route::post('/admin/bayar', [AdminController::class, 'bayar'])->name('bayar');
Route::get('/admin/pembayarann', [AdminController::class, 'pembayarann'])->name('pembayarann');


// DATAKATEGORI
Route::get('/admin/datakategori', [AdminController::class, 'datakategori'])->name('datakategori');
Route::get('/admin/datakategori/hapus/{id}', [AdminController::class, 'hapusdatakategori'])->name('hapusdatakategori');
Route::get('/admin/datakategori/edit/{id}', [AdminController::class, 'editdatakategori'])->name('editdatakategori');
Route::post('/admin/datakategori/edit/submit', [AdminController::class, 'editdatakategorisubmit'])->name('editdatakategorisubmit');
Route::get('/admin/datakategori/tambah', [AdminController::class, 'tambahdatakategori'])->name('tambahdatakategori');
Route::post('/admin/datakategori/tambah/submit', [AdminController::class, 'tambahdatakategorisubmit'])->name('tambahdatakategorisubmit');


// LAPORAN
Route::get('/admin/laporan', [AdminController::class, 'laporan'])->name('laporan');
Route::get('/admin/laporan/hapus/{id}', [AdminController::class, 'laporanhapus'])->name('laporanhapus');


Route::get('/listbarang/{id}', [AdminController::class, 'listbarang'])->name('listbarang');
// Route::post('/bayar', [AdminController::class, 'bayar'])->name('bayar');


// PROFIL
Route::get('/profil/{id}', [AdminController::class, 'profil'])->name('profil');
Route::get('/profil/{id}', [AdminController::class, 'profil'])->name('profil');
Route::post('/profil/update/{id}', [AdminController::class, 'profilupdate'])->name('profilupdate');
Route::post('foto/profil/update/{id}', [AdminController::class, 'fotoprofilupdate'])->name('fotoprofilupdate');





// DISKON
Route::get('/admin/datadiskon', [AdminController::class, 'datadiskon'])->name('datadiskon');
Route::get('/admin/datadiskon/tambah', [AdminController::class, 'tambahdatadiskon'])->name('tambahdatadiskon');
Route::post('/admin/datadiskon/tambah/submit', [AdminController::class, 'tambahdatadiskonsubmit'])->name('tambahdatadiskonsubmit');
Route::get('/admin/datadiskon/edit/{id}', [AdminController::class, 'editdatadiskon'])->name('editdatadiskon');
Route::post('/admin/datadiskon/edit/submit/{id}', [AdminController::class, 'editdatadiskonsubmit'])->name('editdatadiskonsubmit');
Route::get('/admin/datadiskon/hapus/{id}', [AdminController::class, 'hapusdatadiskon'])->name('hapusdatadiskon');
