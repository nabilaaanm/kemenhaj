<?php

namespace App\Http\Controllers;

use App\Models\Profil;
use App\Models\TimKemenhaj;

class ProfilController extends Controller
{
    public function kontak()
    {
        $profil = Profil::first();
        return view('profil.kontak', compact('profil'));
    }

    public function strukturOrganisasi()
    {
        $profil = Profil::first();
        $tim = TimKemenhaj::orderBy('urutan')->orderBy('id')->get();
        return view('profil.struktur-organisasi', compact('profil', 'tim'));
    }

    public function sejarah()
    {
        $profil = Profil::first();
        return view('profil.sejarah', compact('profil'));
    }
}
