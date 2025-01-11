<?php

namespace App\Http\Controllers;

use App\Models\PoinPelajar;
use Illuminate\Http\Request;
use DB;

class DashboardController extends Controller
{
    public function GrafikNegatif()
    {
        $totalPoinKelas = PoinPelajar::select
        return redirect()->route('admin.dashboard', compact('dataNegatifPerKelas'));
    }    
}
