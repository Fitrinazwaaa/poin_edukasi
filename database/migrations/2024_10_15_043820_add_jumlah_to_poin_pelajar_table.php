<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::table('poin_pelajar', function (Blueprint $table) {
            $table->integer('jumlah_positif')->default(0); // Menyimpan total poin positif setelah dikurangi
            $table->integer('jumlah_negatif')->default(0); // Menyimpan total poin negatif setelah dikurangi
        });
    }
    
    public function down()
    {
        Schema::table('poin_pelajar', function (Blueprint $table) {
            $table->dropColumn('jumlah_positif');
            $table->dropColumn('jumlah_negatif');
        });
    }
    
};
