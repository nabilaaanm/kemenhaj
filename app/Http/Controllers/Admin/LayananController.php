<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class LayananController extends Controller
{
    public function create()
    {
        return view('admin.layanan.create');
    }

    public function index()
    {
        return view('admin.layanan.index');
    }
}
