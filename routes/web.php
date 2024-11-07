<?php
use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\DataKelasController;
use App\Http\Controllers\Koneksi_Controller;
use App\Http\Controllers\user_admin_controller;
use App\Http\Controllers\DataSiswaController;
use App\Http\Controllers\PoinController;
use App\Http\Controllers\PoinPelajarController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;
use Nette\Schema\Schema;

// LOGIN
Route::middleware(['guest'])->group(function () {
    Route::get('/', [Koneksi_Controller::class, 'index'])->name('login');
    Route::post('/', [Koneksi_Controller::class, 'login']);
});
Route::get('/home', function () { return redirect('/admin'); });

// PUSAT ADMIN
Route::middleware(['auth'])->group(function () {
    Route::get('/admin', [Admin_Controller::class, 'index'])->name('BKPage');
    Route::get('/user_kesiswaan', [Admin_Controller::class, 'user1'])->name('KesiswaanPage');
    Route::get('/user_osis', [Admin_Controller::class, 'user2'])->name('OsisPage');
    Route::get('/user_edit', [Admin_Controller::class, 'user_edit'])->name('GuruPage');
    Route::get('/logout', [Koneksi_Controller::class, 'logout']);
});

// USER-ADMIN
Route::get('/akun_bk', [user_admin_controller::class, 'pengaturan_akun1'])->name('AkunBK');
Route::get('/akun_guru', [user_admin_controller::class, 'pengaturan_akun2'])->name('AkunGuru');
Route::get('/akun_kesiswaan', [user_admin_controller::class, 'pengaturan_akun3'])->name('AkunKesiswaan');
Route::get('/akun_osis', [user_admin_controller::class, 'pengaturan_akun4'])->name('AkunOsis');
Route::get('/poin/ubah', [user_admin_controller::class, 'edit']);


Route::get('/siswapoin', [PoinPelajarController::class, 'index'])->name('PoinSiswa');
// Route::get('/poin-siswa', [PoinPelajarController::class, 'index'])->name('SiswaPoin');
Route::get('/siswapoin/view/{nis}', [PoinPelajarController::class, 'viewSiswaDetail'])->name('viewSiswaDetail');
Route::get('/siswapoin/type', [PoinPelajarController::class, 'poin_siswa_type'])->name('TipePoinSiswa');
Route::get('/siswapoin/create-form1', [PoinPelajarController::class, 'createFormOne'])->name('TambahNamaPoinSiswa');
Route::PUT('/siswapoin/store-form1', [PoinPelajarController::class, 'storeFormOne'])->name('StoreNamaPoinSiswa');
Route::get('/siswapoin/perbaikan/{nis}', [PoinPelajarController::class, 'createPerbaikan'])->name('CreatePerbaikan');
Route::PUT('/siswapoin/store-perbaikan', [PoinPelajarController::class, 'storePerbaikan'])->name('StorePerbaikan');
Route::get('/siswapoin/search-form1', [PoinPelajarController::class, 'searchSiswa'])->name('SearchNamaPoinSiswa');
Route::post('/siswapoin/hapus-semua', [PoinPelajarController::class, 'hapusSemua'])->name('hapusSemuaPoinSiswa');
Route::post('/siswapoin/delete-positif', [PoinPelajarController::class, 'deletePoinPositif'])->name('deletePoinPositif');
Route::post('/siswapoin/delete-negatif', [PoinPelajarController::class, 'deletePoinNegatif'])->name('deletePoinNegatif');

Route::get('/get-kelas-by-nis', [PoinPelajarController::class, 'getKelasByNis'])->name('GetKelasByNis');
Route::get('/search-kelas-poin-siswa', [PoinPelajarController::class, 'searchKelas'])->name('SearchKelasPoinSiswa');

Route::get('/get-jurusan/{tingkatan}', [PoinPelajarController::class, 'getJurusan']);
Route::get('/get-jurusan-ke/{jurusan}', [PoinPelajarController::class, 'getJurusanKe']);
Route::get('/search-nama-poin-siswa', [PoinPelajarController::class, 'searchNamaPoinSiswa'])->name('SearchNamaPoinSiswa');
Route::get('/get-nama-poin/{tipe}', [PoinPelajarController::class, 'getNamaPoin']);

Route::get('/siswapoin/pesan/1', [PoinPelajarController::class, 'notifikasi1'])->name('pesan1');
Route::get('/siswapoin/pesan/2', [PoinPelajarController::class, 'notifikasi2'])->name('pesan2');
Route::get('/siswapoin/pesan/3', [PoinPelajarController::class, 'notifikasi3'])->name('pesan3');
Route::get('/siswapoin/pesan/4', [PoinPelajarController::class, 'notifikasi4'])->name('pesan4');
Route::get('/siswapoin/pesan/5', [PoinPelajarController::class, 'notifikasi5'])->name('pesan5');
Route::get('/siswapoin/pesan/6', [PoinPelajarController::class, 'notifikasi6'])->name('pesan6');
Route::get('/siswapoin/pesan/7', [PoinPelajarController::class, 'notifikasi7'])->name('pesan7');
Route::get('/siswapoin/pesan/8', [PoinPelajarController::class, 'notifikasi8'])->name('pesan8');
Route::get('/siswapoin/pesan/perbaikan', [PoinPelajarController::class, 'formulir_perbaikan'])->name('PerbaikanSikap');


Route::get('/poin', [PoinController::class, 'index'])->name('HalamanPoin');
Route::get('/poin/create', [PoinController::class, 'create'])->name('Tambah_Poin');
Route::post('/poin/store', [PoinController::class, 'store'])->name('submitPoin');
Route::get('/poin/edit/{id}', [PoinController::class, 'edit'])->name('poinEdit');
Route::PUT('/poin/update/{id}', [PoinController::class, 'update'])->name('poinUpdate');
Route::delete('/poin/delete', [PoinController::class, 'destroy'])->name('PoinHapusMultiple');
// Rute untuk impor Excel
Route::post('/poin/import-excel', [PoinController::class, 'importExcel'])->name('importExcel');
// Rute untuk ekspor Excel
Route::get('/poin/export-excel', [PoinController::class, 'exportGabungan'])->name('exportGabungan');
// Rute untuk ekspor PDF
Route::get('/poin/export-pdf', [PoinController::class, 'exportPDF'])->name('exportPDF');

Route::get('/siswa', [DataSiswaController::class, 'index'])->name('Siswa');
Route::PUT('/siswa/store', [DataSiswaController::class, 'store'])->name('SiswaStore');
Route::get('/siswa/edit/{id}', [DataSiswaController::class, 'edit'])->name('SiswaEdit');
Route::PUT('/siswa/update/{id}', [DataSiswaController::class, 'update'])->name('SiswaUpdate');
Route::post('/siswa/hapus-multiple', [DataSiswaController::class, 'destroyMultiple'])->name('SiswaHapusMultiple');
Route::get('/get-jurusan-datasiswa/{tahun_angkatan}', [DataSiswaController::class, 'getJurusanDataSiswa']);
Route::get('/get-jurusan-ke-datasiswa/{tahun_angkatan}/{jurusan}', [DataSiswaController::class, 'getJurusanKeDataSiswa']);
Route::get('/export-siswa', [DataSiswaController::class, 'exportSiswa'])->name('SiswaExport');
Route::post('/siswa/import', [DataSiswaController::class, 'import'])->name('siswa.import');
Route::post('/siswa/replace/{nis}', [DataSiswaController::class, 'replace'])->name('siswa.replace');
Route::get('/siswa/increase-tingkatan', [DataSiswaController::class, 'increaseTingkatan'])->name('increaseTingkatan');




Route::get('/kelas', [DataKelasController::class, 'index'])->name('kelas');
Route::get('/kelas/create', [DataKelasController::class, 'create'])->name('TambahKelas');
Route::PUT('/kelas/store', [DataKelasController::class, 'store'])->name('KelasStore');
Route::post('/kelas/hapus-multiple', [DataKelasController::class, 'destroyMultiple'])->name('KelasHapusMultiple');
Route::delete('/kelas/hapus', [DataKelasController::class, 'destroy'])->name('KelasHapusSatu');
Route::get('/kelas/export', [DataKelasController::class, 'exportKelas'])->name('KelasExport');
Route::post('/kelas/import', [DataKelasController::class, 'importKelas'])->name('KelasImport');



Route::get('/user-bk', [UserController::class, 'indexbk'])->name('AkunBK');
Route::put('/user-bk/{id}', [UserController::class, 'update'])->name('UserUpdate');
Route::get('/user/guru', [UserController::class, 'indexguru'])->name('AkunGuru');
Route::put('/user/guru/{id}', [UserController::class, 'update'])->name('GuruUpdate'); 
Route::get('/user/osis', [UserController::class, 'indexosis'])->name('AkunOsis');
Route::put('/user/osis/{id}', [UserController::class, 'update'])->name('OsisUpdate');
Route::get('/user/kesiswaan', [UserController::class, 'indexkesiswaan'])->name('AkunKesiswaan');
Route::put('/user/kesiswaan/{id}', [UserController::class, 'update'])->name('KesiswaanUpdate');

use App\Http\Controllers\LaporanController;

Route::get('/laporan', [LaporanController::class, 'index'])->name('LaporanPoinSiswa');
Route::get('/laporan-poin-siswa/download-pdf', [LaporanController::class, 'downloadPdf'])->name('laporan.poin.siswa.downloadPdf');
Route::get('/laporan/poin-siswa/export-excel', [LaporanController::class, 'downloadExcel'])->name('laporan.poin.siswa.exportExcel');

