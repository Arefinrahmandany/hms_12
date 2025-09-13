<?php

namespace App\Http\Controllers\Admin\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class AuthController extends Controller
{
    public function index()
    {
        // You can pass data like patients count, doctors count, etc. later
        return view('admin.view.login');
    }
}
