<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
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
        $data['berita'] = DB::table('artikel')->where('deleted', '!=', 1)->get();
        return view('dpmptsp/berita', compact('data'));
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

    public function berita_detail($id)
    {
        $id_ = Crypt::decrypt($id);
        $data['berita'] = DB::table('artikel')->where('id', $id_)->first();
        $data['berita_rand'] = DB::table('artikel')->where('deleted', 0)->inRandomOrder()->take(2)->get();
        return view('dpmptsp/berita_detail', compact('data'));
    }

    public function pengaduan()
    {
        $data['pengaduan'] = DB::table('pengaduan')
            ->select(DB::raw('pengaduan.*, tanggapan.tanggapan, users.name as petugas'))
            ->leftJoin('tanggapan', 'tanggapan.pengaduan_id', '=', 'pengaduan.id')
            ->leftJoin('users', 'users.id', '=', 'tanggapan.petugas_id')
            ->where('status', '=', 'DIJAWAB')->get();
        $data['jenis'] = DB::table('jenis_pengaduan')->where('tipe', 'PENGADUAN')->where('deleted', 0)->get();
        return view('dpmptsp/pengaduan', compact('data'));
    }

    public function wbs()
    {
        $data['jenis'] = DB::table('jenis_pengaduan')->where('tipe', 'WBS')->where('deleted', 0)->get();
        return view('dpmptsp/wbs', compact('data'));
    }

    public function create_pengaduan(Request $request)
    {
        $data['nik'] = $request->nik;
        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['kecamatan'] = $request->kecamatan;
        $data['kelurahan'] = $request->kelurahan;
        $data['email'] = $request->email;
        $data['no_hp'] = $request->no_hp;
        $data['isi'] = $request->isi;
        $data['jenis_pengaduan'] = $request->jenis_pengaduan;

        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/pengaduan', $fileName);
            $file_path = 'uploads/pengaduan/' . $fileName;
            $data['file'] = $file_path;
        }

        $data['status'] = 'MENUNGGU';
        $data['created_date'] = date('Y-m-d h:i:s');
        $datas = DB::table('pengaduan')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function create_wbs(Request $request)
    {
        // dd($request);
        $data['nik'] = $request->nik;
        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['kecamatan'] = $request->kecamatan;
        $data['kelurahan'] = $request->kelurahan;
        $data['email'] = $request->email;
        $data['no_hp'] = $request->no_hp;


        $data['nama_terlapor'] = $request->nama_terlapor;
        $data['lokasi_kejadian'] = $request->lokasi_kejadian;
        $data['kecamatan_'] = $request->kecamatan_;
        $data['kelurahan_'] = $request->kelurahan_;
        $data['tgl_kejadian'] = $request->tgl_kejadian;
        $data['waktu_kejadian'] = $request->waktu_kejadian;
        $data['isi'] = $request->isi;
        $data['jenis_pengaduan'] = $request->jenis_pengaduan;

        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/pengaduan/wbs', $fileName);
            $file_path = 'uploads/pengaduan/wbs/' . $fileName;
            $data['file'] = $file_path;
        }

        $data['status'] = 'MENUNGGU';
        $data['created_date'] = date('Y-m-d h:i:s');
        $datas = DB::table('wbs_pengaduan')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }
}
