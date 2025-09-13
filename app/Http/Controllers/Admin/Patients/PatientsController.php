<?php

namespace App\Http\Controllers\Admin\Patients;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PatientsController extends Controller
{
    // Admin Dashboard
    public function index()
    {
        // You can pass data like patients count, doctors count, etc. later
        return view('admin.patients.patients');
    }
}
