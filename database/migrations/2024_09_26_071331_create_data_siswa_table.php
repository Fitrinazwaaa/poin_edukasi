<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('data_siswa', function (Blueprint $table) {
            $table->string('nis')->primary(); // NIS sebagai primary key
            $table->string('nama'); // Nama siswa
            $table->string('kelas'); // Kolom gabungan kelas (tingkatan jurusan kelas)
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Jenis kelamin
            $table->string('tahun_angkatan'); // Kolom untuk menyimpan tahun angkatan
            $table->timestamps(); // Waktu pembuatan dan update data
        });      
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_siswa');
    }
};
