<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    public function home()
    {
        $data['berita'] = DB::table('artikel')->where('status', 'PUBLISH')->where('deleted', '!=', 1)->get();
        $data['informasi_publik'] = DB::table('informasi_publik')->where('deleted', '!=', 1)->get();
        // dd($data);
        return view('dpmptsp/index', compact('data'));
    }

    public function berita()
    {
        return view('dpmptsp/berita');
    }

    public function struktur_organisasi()
    {
        $data['st_organisasi'] = DB::table('struktur_organisasi')->first();
        return view('dpmptsp/struktur_organisasi', compact('data'));
    }

    public function visi_misi()
    {
        return view('dpmptsp/visi_misi');
    }

    public function layanan_dinas()
    {
        $data['layanan'] = DB::table('layanan_dinas')->where('deleted', '!=', 1)->get();
        return view('dpmptsp/layanan_dinas', compact('data'));
    }
    public function kontak()
    {
        return view('dpmptsp/kontak');
    }
}
