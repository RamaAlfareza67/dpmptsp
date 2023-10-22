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
        $data['vis_mis'] = DB::table('visi_misi')->first();
        return view('dpmptsp/visi_misi', compact('data'));
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
    public function berita_detail()
    {
        return view('dpmptsp/berita_detail');
    }
    public function pengaduan()
    {
        $data['pengaduan'] = DB::table('pengaduan')
        ->select(DB::raw('pengaduan.*, tanggapan.tanggapan, users.name as petugas'))
        ->leftJoin('tanggapan', 'tanggapan.pengaduan_id', '=', 'pengaduan.id')
        ->leftJoin('users', 'users.id', '=', 'tanggapan.petugas_id')
        ->where('status', '=', 'DIJAWAB')->get();
        return view('dpmptsp/pengaduan', compact('data'));
    }
}
