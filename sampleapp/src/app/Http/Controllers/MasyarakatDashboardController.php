<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class MasyarakatDashboardController extends Controller
{
    public function index()
    {
        return view('masyarakat.pages.dashboard'); // Ganti dengan tampilan dashboard masyarakat kamu
    }
}
