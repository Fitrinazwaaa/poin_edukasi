<?php

use App\Http\Controllers\Admin_Controller;
use App\Http\Controllers\Koneksi_Controller;
use Illuminate\Support\Facades\Route;

Route::middleware(['guest'])->group(function () {
    Route::get('/', [Koneksi_Controller::class, 'index'])->name('login');
    Route::post('/', [Koneksi_Controller::class, 'login']);
});

Route::get('/home', function () {
    return redirect('/role');
});

Route::middleware(['auth'])->group(function () {
    Route::get('/role', [Admin_Controller::class, 'index']);
    Route::get('/role/admin', [Admin_Controller::class, 'admin'])->name('BKPage');
    Route::get('/role/user_kesiswaan', [Admin_Controller::class, 'user1'])->name('KesiswaanPage');
    Route::get('/role/user_osis', [Admin_Controller::class, 'user2'])->name('OsisPage');
    Route::get('/role/user_edit', [Admin_Controller::class, 'user_edit'])->name('GuruPage');
    Route::get('/logout', [Koneksi_Controller::class, 'logout']);
});