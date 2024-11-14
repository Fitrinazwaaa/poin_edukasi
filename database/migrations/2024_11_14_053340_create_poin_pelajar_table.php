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
            $table->string('nama');
            $table->integer('tingkatan');
            $table->string('jurusan');
            $table->integer('jurusan_ke');
            $table->enum('jenis_kelamin', ['Laki-laki', 'Perempuan']);
            $table->integer('tahun_angkatan');
            $table->integer('poin_positif')->default(0);
            $table->integer('poin_negatif')->default(0);
            $table->string('nama_poin_positif')->nullable();
            $table->string('nama_poin_negatif')->nullable();
            $table->unsignedBigInteger('id_poin_positif')->nullable();
            $table->unsignedBigInteger('id_poin_negatif')->nullable();
            $table->integer('jumlah_positif')->default(0);
            $table->integer('jumlah_negatif')->default(0);
            $table->string('foto')->nullable();
            $table->date('tanggal');
        
            // Perbaikan pada foreign key constraint
            $table->foreign('id_poin_positif')->references('id_poin_positif')->on('data_poin_positif')->onDelete('set null');
            $table->foreign('id_poin_negatif')->references('id_poin_negatif')->on('data_poin_negatif')->onDelete('set null');
        
            $table->unique(['id_poin_negatif', 'tanggal', 'nis']); // Menambahkan nis untuk memastikan tidak ada duplikasi berdasarkan kombinasi tiga kolom
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