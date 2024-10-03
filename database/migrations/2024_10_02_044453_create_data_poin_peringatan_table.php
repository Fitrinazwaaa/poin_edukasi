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
        Schema::create('data_poin_peringatan', function (Blueprint $table) {
            $table->id('id_peringatan')->primary(); // Kolom untuk ID peringatan sebagai primary key
            $table->string('peringatan'); // Kolom untuk peringatan
            $table->integer('max_poin'); // Kolom untuk poin
            $table->timestamps(); // Kolom untuk created_at dan updated_at
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('data_poin_peringatan');
    }
};
