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
            $table->string('nis'); // NIS siswa sebagai foreign key
            $table->integer('poin_positif')->default(0); // Poin positif
            $table->integer('poin_negatif')->default(0); // Poin negatif
            $table->foreign('nis')->references('nis')->on('data_siswa')->onDelete('cascade'); // Foreign key
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
