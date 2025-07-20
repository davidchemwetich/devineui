<?php

namespace App\Http\Controllers\Shield;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ShieldController extends Controller
{
    public function dashboard()
    {
        return view('shield.utils.dashboard');
    }
}