<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        // You can pass data like patients count, doctors count, etc. later
        return view('admin.dashboard');
    }
    
}
