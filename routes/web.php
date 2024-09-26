<?php
use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Koneksi_Controller;
use App\Http\Controllers\PoinController;
use App\Http\Controllers\user_admin_controller;
use Illuminate\Support\Facades\Route;


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
    Route::get('/form', [PoinController::class, 'create']);
Route::post('/form', [PoinController::class, 'store'])->name('submitPoin');
});



// USER-ADMIN
Route::get('/laporan_poin_siswa', [user_admin_controller::class, 'laporan1'])->name('LaporanPoinSiswa');

Route::get('/akun_bk', [user_admin_controller::class, 'pengaturanakun1'])->name('AkunBK');
Route::get('/akun_guru', [user_admin_controller::class, 'pengaturanakun2'])->name('AkunGuru');
Route::get('/akun_kesiswaan', [user_admin_controller::class, 'pengaturanakun3'])->name('AkunKesiswaan');
Route::get('/akun_osis', [user_admin_controller::class, 'pengaturanakun4'])->name('AkunOsis');

Route::get('/poin/positif', [user_admin_controller::class, 'poin1'])->name('Negatif');
Route::get('/tambah_peringatan', [user_admin_controller::class, 'poin2'])->name('TambahPeringatan');
Route::get('/tambah_poin', [user_admin_controller::class, 'poin3'])->name('Tambah_Poin');
Route::get('/halamanPoin', [user_admin_controller::class, 'poin4'])->name('HalamanPoin');
Route::get('/poin/negatif', [user_admin_controller::class, 'poin5'])->name('Positif');

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

Route::get('/edit_siswa', [user_admin_controller::class, 'siswa1'])->name('EditSiswa');
Route::get('/siswa', [user_admin_controller::class, 'siswa2'])->name('Siswa');
Route::get('/tambah_siswa', [user_admin_controller::class, 'siswa3'])->name('TambahSiswa');



// TABEL POSITIF-NEGATIF
Route::get('/poin/negatif', function () { return view('admin.poin.negatif'); })->name('negatif');
Route::get('/poin/positif', function () { return view('admin.poin.positif'); })->name('positif');