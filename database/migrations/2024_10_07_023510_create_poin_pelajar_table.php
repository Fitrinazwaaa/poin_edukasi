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
        Schema::create('poin_pelajar', function (Blueprint $table) {
            $table->id();
            $table->string('nis'); 
            $table->string('nama'); // Nama siswa
            $table->integer('tingkatan'); 
            $table->string('jurusan'); 
            $table->integer('jurusan_ke');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']); // Jenis kelamin
            $table->integer('tahun_angkatan'); 
            $table->integer('poin_positif')->default(0); // Poin positif
            $table->integer('poin_negatif')->default(0); // Poin negatif
            $table->string('nama_poin_positif')->nullable(); // Nama poin positif
            $table->string('nama_poin_negatif')->nullable(); // Nama poin negatif
            $table->unsignedBigInteger('id_poin_positif')->nullable(); // ID poin positif
            $table->unsignedBigInteger('id_poin_negatif')->nullable(); // ID poin negatif
            $table->integer('jumlah_positif')->default(0); // Menyimpan total poin positif setelah dikurangi
            $table->integer('jumlah_negatif')->default(0); // Menyimpan total poin negatif setelah dikurangi
            $table->string('foto')->nullable(); // Menambahkan kolom foto

            // Menambahkan foreign key constraint untuk id_poin_positif dan id_poin_negatif
            $table->foreign('id_poin_positif')->references('id')->on('data_poin_positif')->onDelete('set null');
            $table->foreign('id_poin_negatif')->references('id')->on('data_poin_negatif')->onDelete('set null');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('poin_pelajar');
    }
};
