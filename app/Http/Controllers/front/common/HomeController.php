<?php

namespace App\Http\Controllers\front\common;

use App\Models\Speciality;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class HomeController extends Controller
{
    public function index()
    {
        $data['specialities'] = Speciality::latest()->get();
        return view('frontend.home',$data);
    }
}
