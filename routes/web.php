<?php
use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Koneksi_Controller;
use App\Http\Controllers\user_admin_controller;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\PoinController;
use Illuminate\Support\Facades\Route;
use Nette\Schema\Schema;

// LOGIN
Route::middleware(['guest'])->group(function () {
    Route::get('/', [Koneksi_Controller::class, 'index'])->name('login');
    Route::post('/', [Koneksi_Controller::class, 'login']);
});

Route::get('/home', function () { return redirect('/role'); });

// PUSAT ADMIN
Route::middleware(['auth'])->group(function () {
    Route::get('/role', [Admin_Controller::class, 'index']);
    Route::get('/role/admin', [Admin_Controller::class, 'admin'])->name('BKPage');
    Route::get('/role/user_kesiswaan', [Admin_Controller::class, 'user1'])->name('KesiswaanPage');
    Route::get('/role/user_osis', [Admin_Controller::class, 'user2'])->name('OsisPage');
    Route::get('/role/user_edit', [Admin_Controller::class, 'user_edit'])->name('GuruPage');
    Route::get('/logout', [Koneksi_Controller::class, 'logout']);
});

// USER-ADMIN
Route::get('/laporan_poin_siswa', [user_admin_controller::class, 'laporan1'])->name('LaporanPoinSiswa');

Route::get('/akun_bk', [user_admin_controller::class, 'pengaturan_akun1'])->name('AkunBK');
Route::get('/akun_guru', [user_admin_controller::class, 'pengaturan_akun2'])->name('AkunGuru');
Route::get('/akun_kesiswaan', [user_admin_controller::class, 'pengaturan_akun3'])->name('AkunKesiswaan');
Route::get('/akun_osis', [user_admin_controller::class, 'pengaturan_akun4'])->name('AkunOsis');

Route::get('/poin/negatif', [user_admin_controller::class, 'poin1'])->name('Negatif');
Route::get('/tambah_peringatan', [user_admin_controller::class, 'poin2'])->name('TambahPeringatan');
// Route::get('/tambah_poin', [user_admin_controller::class, 'poin3'])->name('Tambah_Poin');
// Route::get('/halamanPoin', [user_admin_controller::class, 'poin4'])->name('HalamanPoin');
// Route::get('/poin/positif', [user_admin_controller::class, 'poin5'])->name('Positif');

Route::get('/siswapoin', [user_admin_controller::class, 'poin_siswa1'])->name('PoinSiswa');
Route::get('/siswapoin/type', [user_admin_controller::class, 'poin_siswa2'])->name('TipePoinSiswa');
Route::get('/siswapoin/addname', [user_admin_controller::class, 'poin_siswa3'])->name('TambahNamaPoinSiswa');
Route::get('/siswapoin/addnis', [user_admin_controller::class, 'poin_siswa4'])->name('TambahNisPoinSiswa');

Route::get('/notifikasi1', [user_admin_controller::class, 'notifikasi1'])->name('PemanggilanOrangTua');
Route::get('/notifikasi2', [user_admin_controller::class, 'notifikasi2'])->name('PeringatanTertulis');
Route::get('/notifikasi3', [user_admin_controller::class, 'notifikasi3'])->name('PeringatanTertulisOrangtua');
Route::get('/notifikasi4', [user_admin_controller::class, 'notifikasi4'])->name('RekomendasiKesiswaan');
Route::get('/notifikasi5', [user_admin_controller::class, 'notifikasi5'])->name('Skors3Hari');
Route::get('/notifikasi6', [user_admin_controller::class, 'notifikasi6'])->name('Skors6Hari');
Route::get('/notifikasi7', [user_admin_controller::class, 'notifikasi7'])->name('PerjanjianBermaterai');
Route::get('/notifikasi8', [user_admin_controller::class, 'notifikasi8'])->name('TeguranLisan');

Route::get('/poin', [PoinController::class, 'index'])->name('HalamanPoin');
Route::get('/poin/create', [PoinController::class, 'create'])->name('Tambah_Poin');
Route::post('/poin/store', [PoinController::class, 'store'])->name('submitPoin');


Route::get('/siswa', [DataSiswaController::class, 'index'])->name('Siswa');
Route::get('/siswa/create', [DataSiswaController::class, 'create'])->name('TambahSiswa');
Route::PUT('/siswa/store', [DataSiswaController::class, 'store'])->name('SiswaStore');
Route::get('/siswa/edit/{id}', [DataSiswaController::class, 'edit'])->name('SiswaEdit');
Route::PUT('/siswa/update/{id}', [DataSiswaController::class, 'update'])->name('SiswaUpdate');
Route::get('/siswa/hapus/{id}', [DataSiswaController::class, 'destroy'])->name('SiswaHapus');
Route::post('/siswa/hapus-multiple', [DataSiswaController::class, 'destroyMultiple'])->name('SiswaHapusMultiple');

use App\Http\Controllers\SiswaController;

Route::get('/search', [SiswaController::class, 'search'])->name('searchSiswa');
