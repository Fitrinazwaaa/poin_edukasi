<?php

namespace App\Http\Controllers;

use App\Models\poin;
use Illuminate\Http\Request;

class PoinController extends Controller
{
    public function showForm()
    {
        $positifPoin = poin::where('tipe', 'positif')->get();
        $negatifPoin = poin::where('tipe', 'negatif')->get();
    
        return view('tambahNama_siswa_poin', compact('positifPoin', 'negatifPoin'));
    }    
}
