<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class HalamanController extends Controller
{
    public function create()
    {
        return view('admin.halaman.create');
    }

    public function index()
    {
        return view('admin.halaman.index');
    }
}
