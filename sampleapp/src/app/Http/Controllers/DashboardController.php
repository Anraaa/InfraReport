<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Dashboard untuk masyarakat
    public function masyarakatDashboard()
    {
        return view('masyarakat.pages.dashboard');
    }

    // Dashboard untuk admin
    public function adminDashboard()
    {
        return view('admin.dashboard');
    }
}
