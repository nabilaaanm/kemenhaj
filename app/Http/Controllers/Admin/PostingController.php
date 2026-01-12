<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class PostingController extends Controller
{
    public function create()
    {
        return view('admin.posting.create');
    }

    public function index()
    {
        return view('admin.posting.index');
    }

    public function category()
    {
        return view('admin.posting.category');
    }

    public function berita()
    {
        return view('admin.posting.berita');
    }

    public function pengumuman()
    {
        return view('admin.posting.pengumuman');
    }

    public function siaranPers()
    {
        return view('admin.posting.siaran-pers');
    }

    public function hoax()
    {
        return view('admin.posting.hoax');
    }
}
