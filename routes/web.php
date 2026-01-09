<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('home');
});

Route::get('/visi-misi', function () {
    return view('profil.visi-misi');
});
Route::get('/regulasi', function () {
    return view('regulasi');
});
Route::get('/layanan', function () {
    return view('layanan');
});
Route::get('/data-informasi', function () {
    return view('data-informasi');
});
Route::get('/lk-pih', function () {
    return view('lk-pih');
});
Route::get('/berita', function () {
    return view('berita.berita');
});
Route::get('/pengumuman', function () {
    return view('berita.pengumuman');
});
Route::get('/siaran-pers', function () {
    return view('berita.siaran-pers');
});
Route::get('/klarifikasi-hoax', function () {
    return view('berita.klarifikasi-hoax');
});
