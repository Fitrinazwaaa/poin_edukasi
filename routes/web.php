<?php
use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Koneksi_Controller;
use App\Http\Controllers\user_admin_controller;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\PoinController;
use App\Http\Controllers\PoinPelajarController;
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

Route::get('/poin/ubah', [user_admin_controller::class, 'edit']);

Route::get('/siswapoin', [PoinPelajarController::class, 'index'])->name('PoinSiswa');
Route::get('/siswapoin/type', [PoinPelajarController::class, 'poin_siswa_type'])->name('TipePoinSiswa');
Route::get('/siswapoin/create-form1', [PoinPelajarController::class, 'createFormOne'])->name('TambahNamaPoinSiswa');
Route::post('/siswapoin/store-form1', [PoinPelajarController::class, 'storeFormOne'])->name('StoreNamaPoinSiswa');
Route::get('/siswapoin/search-form1', [PoinPelajarController::class, 'searchSiswa'])->name('SearchNamaPoinSiswa');
Route::get('/siswapoin/create-form2', [PoinPelajarController::class, 'createFormTwo'])->name('TambahNisPoinSiswa');
Route::post('/siswapoin/store-form2', [PoinPelajarController::class, 'storeFormTwo'])->name('StoreNisPoinSiswa');


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
Route::get('/poin/edit/{id}', [PoinController::class, 'edit'])->name('poinEdit');
Route::PUT('/poin/update/{id}', [PoinController::class, 'update'])->name('poinUpdate');
Route::delete('/poin/hapus-multiple', [PoinController::class, 'destroy'])->name('PoinHapusMultiple');


Route::get('/siswa', [DataSiswaController::class, 'index'])->name('Siswa');
Route::get('/siswa/create', [DataSiswaController::class, 'create'])->name('TambahSiswa');
Route::PUT('/siswa/store', [DataSiswaController::class, 'store'])->name('SiswaStore');
Route::get('/siswa/edit/{id}', [DataSiswaController::class, 'edit'])->name('SiswaEdit');
Route::PUT('/siswa/update/{id}', [DataSiswaController::class, 'update'])->name('SiswaUpdate');
Route::post('/siswa/hapus-multiple', [DataSiswaController::class, 'destroyMultiple'])->name('SiswaHapusMultiple');

