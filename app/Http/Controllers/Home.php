<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class Home extends Controller
{
    public function home()
    {
         return view('dpmptsp/index');
    }

    public function berita()
    {
        return view('dpmptsp/berita');
    }

    public function struktur_organisasi()
    {
        return view('dpmptsp/struktur_organisasi');
    }

    public function visi_misi()
    {
        return view('dpmptsp/visi_misi');
    }

    public function layanan_dinas()
    {
        return view('dpmptsp/layanan_dinas');
    }
}
