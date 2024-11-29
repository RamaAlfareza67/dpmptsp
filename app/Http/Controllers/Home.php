<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Support\Facades\DB;

class Home extends Controller
{
    public function home(){
    // {   $data['module'] = 'BERANDA';
        $data['berita'] = DB::table('artikel')->where('status', 'PUBLISH')->where('deleted', '!=', 1)->orderBy('created_date', 'desc')->take(6)->get();
        $data['informasi_publik'] = DB::table('informasi_publik')->where('deleted', '!=', 1)->take(8)->get();
        $data['tahun'] = DB::table('investasi')->select('tahun')->where('deleted', 0)->groupBy('tahun')->orderBy('tahun', 'desc')->get();
        $data['tahun_perijinan'] = DB::table('perizinan')->select('tahun')->where('deleted', 0)->groupBy('tahun')->orderBy('tahun', 'desc')->get();
        $data['kategori'] = DB::table('kategori_perizinan')->where('deleted', 0)->get();
        // dd($data);
        return view('dpmptsp/index', compact('data'));
    }

    public function grafik_realisasi_investasi_publik(Request $request)
    {
        $data = DB::table('investasi')->select('jumlah')->where('tahun', $request->tahun)->where('deleted', 0)->where('jenis', $request->jenis)->orderBy('triwulan', 'asc')->get();
        $arr = [];
        foreach ($data as $val) {
            $arr[] = $val->jumlah;
        }
        $r['data'] = $arr;
        return response()->json($r)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }

    public function grafik_investasi_tahun(Request $request)
    {
        $data = DB::table('investasi')->select(DB::raw("tahun, jenis, sum(jumlah) as total"))->groupBy('tahun','jenis')->orderBy('tahun', 'asc')->get();
        $pmdn = [];
        $pma = [];
        $tahun = [];
        $th = "";
        foreach ($data as $val) {
            if($val->tahun != $th){
                $tahun[] = $val->tahun;
            }
            
            if($val->jenis == "realisasi"){
                $pmdn[] = $val->total;
            }
            if($val->jenis == "proyek"){
                $pma[] = $val->total;
            }
            $th = $val->tahun;
        }
        $r['kategori'] = $tahun;
        $r['data'] = [$pmdn, $pma];
        return response()->json($r)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }

    public function grafik_perizinan_publik(Request $request)
    {
        $data = DB::table('perizinan')
            ->leftJoin('kategori_perizinan', 'kategori_perizinan.id', '=', 'perizinan.id_kategori_perizinan')
            ->select(DB::raw('perizinan.total as jumlah'))
            ->where('perizinan.tahun', $request->tahun)->where('kategori_perizinan.id', $request->kategori)
            ->where('perizinan.deleted', 0)->orderBy('perizinan.bulan', 'asc')
            ->get();
        // dd($data);
        $arr = [];
        foreach ($data as $val) {
            $arr[] = $val->jumlah;
        }
        $r['data'] = $arr;
        return response()->json($r)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }
    

    public function berita()
    {
        // $data['module'] = 'BERITA';
        $data['berita'] = DB::table('artikel')->where('deleted', '!=', 1)->get();
        return view('dpmptsp/berita', compact('data'));
    }

    public function informasi_publik()
    {
        // $data['module'] = 'PROFIL';
        $data['informasi_publik'] =  DB::table('informasi_publik')->select('informasi_publik.*','kategori_informasi.nama as kategori')
        ->leftJoin('kategori_informasi', 'kategori_informasi.id', '=', 'informasi_publik.kategori')->paginate(8);
        $data['kategori'] = DB::table('kategori_informasi')->get();
        return view('dpmptsp/informasi_publik', compact('data'));
    }

    public function informasi_filter(Request $request)
    {
        $data =  DB::table('informasi_publik')->select('informasi_publik.*','kategori_informasi.nama as kategori')
        ->leftJoin('kategori_informasi', 'kategori_informasi.id', '=', 'informasi_publik.kategori')
        ->where(function ($query) use ($request) {
            if ($request->kategori  <> '') {
                $query->where('kategori_informasi.id', '=', $request->kategori);
            }
        })
        ->orderBy('informasi_publik.id', 'DESC');
        // $data->get();

        // dd($data);
        $html = '';
        foreach ($data->paginate(8) as $val) {
            $ids = $val->id;
            $html .= ' <div class="col-lg-3 col-md-6 col-sm-6">
                                    <div class="card shadow border-0 mb-5">
                                        <div class="card-body p-4">
                                            <div class="work">
                                                <div class="image">
                                                    <a href="'.$val->file.'" target="_blank"><img src="'.$val->cover.'" alt="Work 1" /></a>
                                                </div>
                                                <div class="desc">
                                                    <span class="desc-title">'.$val->nama.'</span>
                                                    <span class="desc-text">'.$val->deskripsi.'</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>';
        }

        $r['result'] = true;
        $r['data'] = $html;
        if (!$data) {
            $r['result'] = false;
            $r['data'] = '';
        }
        return response()->json($r);
    }

    public function load_more_informasi(Request $request)
    {
        // $data['module'] = '';
        $start = $request->input('start');
        $data =  DB::table('informasi_publik')->select('informasi_publik.*','kategori_informasi.nama as kategori')
        ->leftJoin('kategori_informasi', 'kategori_informasi.id', '=', 'informasi_publik.kategori')
        ->where(function ($query) use ($request) {
            if ($request->jenis  <> '') {
                $query->where('kategori_informasi.id', '=', $request->kategori);
            }
        })
            ->orderBy('informasi_publik.id', 'DESC')
            ->offset($start)
            ->limit(8)
            ->get()
            ->map(function ($val) {
                $val->id = Crypt::encrypt($val->id);
                return $val;
            });

        // dd($data);

        return response()->json([
            'data' => $data,
            'next' => $start + 8
        ]);
    }

    public function struktur_organisasi()
    {
        // $data['module'] = 'PROFIL';
        $data['st_organisasi'] = DB::table('struktur_organisasi')->first();
        return view('dpmptsp/struktur_organisasi', compact('data'));
    }

    public function visi_misi()
    {
        // $data['module'] = 'PROFIL';
        $data['vis_mis'] = DB::table('visi_misi')->first();
        return view('dpmptsp/visi_misi', compact('data'));
    }

    public function layanan_dinas()
    {
        // $data['module'] = 'LAYANAN_DINAS';
        $data['layanan'] = DB::table('layanan_dinas')->where('deleted', '!=', 1)->get();
        return view('dpmptsp/layanan_dinas', compact('data'));
    }

    public function kontak()
    {
        // $data['module'] = 'KONTAK_KAMI';
        $data['profil']= DB::table('profil')->first();
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
        // $data['module'] = 'PENGADUAN';
        $data['pengaduan'] = DB::table('pengaduan')
            ->select(DB::raw('pengaduan.*, tanggapan.tanggapan, users.name as petugas'))
            ->leftJoin('tanggapan', 'tanggapan.pengaduan_id', '=', 'pengaduan.id')
            ->leftJoin('users', 'users.id', '=', 'tanggapan.petugas_id')
            ->where('status', '=', 'DIJAWAB')->orderBy('pengaduan.id', 'DESC')->limit(4)->get();
        $data['jenis'] = DB::table('jenis_pengaduan')->where('tipe', 'PENGADUAN')->where('deleted', 0)->get();
        return view('dpmptsp/pengaduan', compact('data'));
    }

    public function detail_pengaduan()
    {
        // $data['module'] = 'PENGADUAN';
        $data['pengaduan'] = DB::table('pengaduan')
            ->select(DB::raw('pengaduan.*,jenis_pengaduan.jenis as jp, tanggapan.tanggapan, users.name as petugas'))
            ->leftJoin('jenis_pengaduan', 'jenis_pengaduan.id', '=', 'pengaduan.jenis_pengaduan')
            ->leftJoin('tanggapan', 'tanggapan.pengaduan_id', '=', 'pengaduan.id')
            ->leftJoin('users', 'users.id', '=', 'tanggapan.petugas_id')
            ->where('status', '=', 'DIJAWAB')->orderBy('pengaduan.id', 'DESC')->paginate(4);
        $data['jenis'] = DB::table('jenis_pengaduan')->where('tipe', 'PENGADUAN')->where('deleted', 0)->get();
        return view('dpmptsp/detail_pengaduan', compact('data'));
    }

    public function load_more_pengaduan(Request $request)
    {
        // $data['module'] = '';
        $start = $request->input('start');
        $data = DB::table('pengaduan')->select('pengaduan.*','jenis_pengaduan.jenis as jp', 'tanggapan.tanggapan', 'users.name as petugas')
            ->leftJoin('jenis_pengaduan', 'jenis_pengaduan.id', '=', 'pengaduan.jenis_pengaduan')
            ->leftJoin('tanggapan', 'tanggapan.pengaduan_id', '=', 'pengaduan.id')
            ->leftJoin('users', 'users.id', '=', 'tanggapan.petugas_id')
            ->where('status','=', 'DIJAWAB')
            ->where(function ($query) use ($request) {
                if ($request->jenis_pengaduan  <> '') {
                    $query->where('jenis_pengaduan.id', '=', $request->jenis_pengaduan);
                }
            })
            ->orderBy('pengaduan.id', 'DESC')
            ->offset($start)
            ->limit(4)
            ->get()
            ->map(function ($val) {
                $val->id = Crypt::encrypt($val->id);
                return $val;
            });

        // dd($data);

        return response()->json([
            'data' => $data,
            'next' => $start + 5
        ]);
    }

    public function pengaduan_filter(Request $request)
    {
        $data =  DB::table('pengaduan')->select('pengaduan.*','jenis_pengaduan.jenis as jp', 'tanggapan.tanggapan', 'users.name as petugas')
        ->leftJoin('jenis_pengaduan', 'jenis_pengaduan.id', '=', 'pengaduan.jenis_pengaduan')
        ->leftJoin('tanggapan', 'tanggapan.pengaduan_id', '=', 'pengaduan.id')
        ->leftJoin('users', 'users.id', '=', 'tanggapan.petugas_id')
        ->where('status','=', 'DIJAWAB')
        ->where(function ($query) use ($request) {
            if ($request->jenis  <> '') {
                $query->where('jenis_pengaduan.id', '=', $request->jenis);
            }
        })
        ->orderBy('pengaduan.id', 'DESC');
        // $data->get();

        // dd($data);
        $html = '';
        foreach ($data->paginate(4) as $val) {
            $ids = $val->id;
            $html .= ' <div class="col-lg-6 col-md-12">
                        <div class="card card-forum mb-4">
                            <ul class="forum-list forum-topic-list">
                                <li>
                                    <div class="media">
                                        <img src="../assets/img/user/user.png" alt="" class="rounded-lg" />
                                    </div>
                                    <div class="info-container">
                                        <div class="info">
                                            <p>Jenis Pengaduan : '.$val->jp.'</p>
                                            <h5 class="title"><a href="detail.html">Pengaduan Dari : '.$val->nama.'</a></h4>
                                            <p>"'.$val->isi.'"</p>
                                            <h5 class="title"><a href="detail.html">Jawaban : '.$val->petugas.'</a></h4>
                                            <p>"'.$val->tanggapan.'"</p>   
                                        </div>
                                        <div class="date-replies">
                                            <div class="time">
                                            '.$val->created_date.'
                                            </div> 
                                        </div>
                                    </div>
                                </li>
                            </ul>
                        </div>
                    </div>';
        }

        $r['result'] = true;
        $r['data'] = $html;
        if (!$data) {
            $r['result'] = false;
            $r['data'] = '';
        }
        return response()->json($r);
    }

   

    public function wbs()
    {
        // $data['module'] = 'WBS';
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
