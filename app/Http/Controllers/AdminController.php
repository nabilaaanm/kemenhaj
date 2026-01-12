<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class AdminController extends Controller
{
    /**
     * Dashboard admin
     */
    public function dashboard()
    {
        $user = Session::get('user');
        
        return view('admin.dashboard', compact('user'));
    }
}
