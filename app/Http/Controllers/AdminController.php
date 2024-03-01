<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\DpmptspMail;
use SebastianBergmann\CodeCoverage\Driver\Selector;

class AdminController extends Controller
{
    public function index()
    {
        $data['cek'] = 'admin';
        $data['isi'] = 'Selamat Datang Admin';
        $data['module'] = '';
        return view('admin.index', compact('data'));
    }

    public function get_count()
    {
        $datas['artikel'] = DB::table('artikel')->where('deleted', '!=', 1)->count();
        $datas['pegawai'] = DB::table('pegawai')->where('deleted', '!=', 1)->count();
        $datas['pengaduan'] = DB::table('pengaduan')->count();
        $datas['pengaduan_menunggu'] = DB::table('pengaduan')->where('status', 'MENUNGGU')->count();
        $datas['pengaduan_dijawab'] = DB::table('pengaduan')->where('status', 'DIJAWAB')->count();
        $datas['pengaduan_ditolak'] = DB::table('pengaduan')->where('status', 'DITOLAK')->count();

        $datas['wbs'] = DB::table('wbs_pengaduan')->count();
        $datas['wbs_menunggu'] = DB::table('wbs_pengaduan')->where('status', 'MENUNGGU')->count();
        $datas['wbs_diterima'] = DB::table('wbs_pengaduan')->where('status', 'DITERIMA')->count();
        $datas['wbs_diproses'] = DB::table('wbs_pengaduan')->where('status', 'DIPROSES')->count();
        $datas['wbs_selesai'] = DB::table('wbs_pengaduan')->where('status', 'SELESAI')->count();
        $datas['wbs_ditolak'] = DB::table('wbs_pengaduan')->where('status', 'DITOLAK')->count();
        return response()->json($datas);
    }

    public function grafik_pengaduan()
    {
        $datas['jenis'] = DB::table('jenis_pengaduan')->select('id', 'jenis')->where('tipe', 'PENGADUAN')->where('deleted', '!=', 1)->get();
        $datas['pengaduan'] = DB::table('pengaduan')->select('status')->groupBy('status')->get();
        $arr = [];
        $jenis = [];
        foreach ($datas['pengaduan'] as $v) {
            $count = [];
            foreach ($datas['jenis'] as $val) {
                $p = DB::table('pengaduan')->where('status', $v->status)->where('jenis_pengaduan', $val->id)->count();
                $count[] = $p;
                $jenis[] = $val->jenis;
            }
            $arr[] = [
                'name' => $v->status,
                'data' => $count
            ];
        }
        $datas['data'] = $arr;
        $datas['js'] = $jenis;
        return response()->json($datas);
    }

    public function grafik_pengaduan_wbs()
    {
        $datas['jenis'] = DB::table('jenis_pengaduan')->select('id', 'jenis')->where('tipe', 'WBS')->where('deleted', '!=', 1)->get();
        $datas['pengaduan'] = DB::table('wbs_pengaduan')->select('status')->groupBy('status')->get();
        $arr = [];
        $jenis = [];
        foreach ($datas['pengaduan'] as $v) {
            $count = [];
            foreach ($datas['jenis'] as $val) {
                $p = DB::table('wbs_pengaduan')->where('status', $v->status)->where('jenis_pengaduan', $val->id)->count();
                $count[] = $p;
                $jenis[] = $val->jenis;
            }
            $arr[] = [
                'name' => $v->status,
                'data' => $count
            ];
        }
        $datas['data'] = $arr;
        $datas['js'] = $jenis;
        return response()->json($datas);
    }

    public function get_new_artikel_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('artikel')->where('deleted', '!=', 1)->where('status', 'PUBLISH')->orderBy('created_date', 'desc')->take(10)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-judul="' . $field->judul . '" data-isi="' . htmlspecialchars($field->isi) . '" data-image="' . $field->image . '" data-penulis="' . $field->penulis . '" data-status="' . $field->status . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->addColumn('desc', function ($field) {
                    // $desc = stripslashes($field->isi);
                    $desc = strip_tags($field->isi);
                    $d = substr($desc, 0, 50) . ' ... ';
                    return $d;
                })
                ->addColumn('judul', function ($field) {
                    // $desc = stripslashes($field->isi);
                    $d = substr($field->judul, 0, 50) . ' ... ';
                    return $d;
                })
                ->addColumn('img', function ($field) {
                    $image = '<img src="' . asset($field->image) . '" width="50" alt="" class="rounded" />';
                    return $image;
                })
                ->addColumn('status', function ($field) {
                    $d = ($field->status == 'PUBLISH') ? '<span class="badge bg-success">Publish</span>' : '<span class="badge bg-warning">Draft</span>';
                    return $d;
                })
                ->rawColumns(['action', 'img', 'desc', 'status', 'judul'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function dashboard()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN') {
            $data['module'] = 'DASHBOARD';
            return view('admin.dashboard', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function dashboard_investasi()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'DASHBOARD_INVESTASI';
            $data['tahun'] = DB::table('investasi')->select('tahun')->where('deleted', 0)->groupBy('tahun')->orderBy('tahun', 'desc')->get();
            return view('admin.dashboard_investasi', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function grafik_realisasi_investasi(Request $request)
    {
        $data = DB::table('investasi')->select('jumlah')->where('tahun', $request->tahun)->where('deleted', 0)->where('jenis', $request->jenis)->orderBy('triwulan', 'asc')->get();
        $arr = [];
        foreach ($data as $val) {
            $arr[] = $val->jumlah;
        }
        $r['data'] = $arr;
        return response()->json($r)->setEncodingOptions(JSON_NUMERIC_CHECK);
    }

    public function dashboard_perizinan()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'DASHBOARD_PERIZINAN';
            $data['tahun'] = DB::table('perizinan')->select('tahun')->where('deleted', 0)->groupBy('tahun')->orderBy('tahun', 'desc')->get();
            $data['kategori'] = DB::table('kategori_perizinan')->where('deleted', 0)->get();
            return view('admin.dashboard_perizinan', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function grafik_perizinan(Request $request)
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

    public function artikel()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'ARTIKEL';
            return view('admin.artikel', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function artikel_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('artikel')->where('deleted', '!=', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-judul="' . $field->judul . '" data-isi="' . htmlspecialchars($field->isi) . '" data-image="' . $field->image . '" data-penulis="' . $field->penulis . '" data-status="' . $field->status . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->addColumn('desc', function ($field) {
                    // $desc = stripslashes($field->isi);
                    $desc = strip_tags($field->isi);
                    $d = substr($desc, 0, 200) . ' ... ';
                    return $d;
                })
                ->addColumn('judul', function ($field) {
                    // $desc = stripslashes($field->isi);
                    $d = substr($field->judul, 0, 200) . ' ... ';
                    return $d;
                })
                ->addColumn('img', function ($field) {
                    $image = '<img src="' . asset($field->image) . '" width="50" alt="" class="rounded" />';
                    return $image;
                })
                ->addColumn('status', function ($field) {
                    $d = ($field->status == 'PUBLISH') ? '<span class="badge bg-success">Publish</span>' : '<span class="badge bg-warning">Draft</span>';
                    return $d;
                })
                ->rawColumns(['action', 'img', 'desc', 'status', 'judul'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_artikel(Request $request)
    {
        $data['judul'] = $request->judul;
        $data['isi'] = $request->isi;
        $data['penulis'] = $request->penulis;
        $data['status'] = $request->status;
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/artikel', $fileName);
            $file_path = 'uploads/artikel/' . $fileName;
            $data['image'] = $file_path;
        }
        $data['created_date'] = date('Y-m-d h:i:s');
        $data['created_by'] = auth()->user()->id;
        // dd($data);


        $datas = DB::table('artikel')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function update_artikel(Request $request)
    {

        $data['judul'] = $request->judul;
        $data['isi'] = $request->isi;
        $data['penulis'] = $request->penulis;
        $data['status'] = $request->status;
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/artikel', $fileName);
            $file_path = 'uploads/artikel/' . $fileName;
            $data['image'] = $file_path;
        }
        $data['edited_date'] = date('Y-m-d h:i:s');
        $data['edited_by'] = auth()->user()->id;
        // dd($data);

        $datas = DB::table('artikel')->where('id', $request->hidden_id)->update($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function delete_artikel(Request $request)
    {
        $data = DB::table('artikel')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }

    public function visi_misi()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'VISI_MISI';
            $data['data'] = DB::table('visi_misi')->first();
            return view('admin.visi_misi', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function create_visi_misi(Request $request)
    {
        // dd($request);
        $cek = DB::table('visi_misi')->first();
        $data['judul'] = $request->judul;
        $data['isi'] = $request->isi;
        // dd($data);
        if ($cek) {
            $data['edited_by'] = auth()->user()->id;
            $data['edited_date'] = date('Y-m-d h:i:s');

            $datas = DB::table('visi_misi')->where('id', $cek->id)->update($data);
        } else {
            $data['created_by'] = auth()->user()->id;
            $data['created_date'] = date('Y-m-d h:i:s');

            $datas = DB::table('visi_misi')->insert($data);
        }

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function struktur_organisasi()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'STRUKTUR_ORGANISASI';
            $data['data'] = DB::table('struktur_organisasi')->first();
            return view('admin.struktur_organisasi', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function create_st_organisasi(Request $request)
    {
        // dd($request);
        $cek = DB::table('struktur_organisasi')->first();
        $data['judul'] = $request->judul;

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/struktur_organisasi', $fileName);
            $file_path = 'uploads/struktur_organisasi/' . $fileName;
            $data['image'] = $file_path;
        }

        if ($cek) {
            $data['edited_by'] = auth()->user()->id;
            $data['edited_date'] = date('Y-m-d h:i:s');

            $datas = DB::table('struktur_organisasi')->where('id', $cek->id)->update($data);
        } else {
            $data['created_by'] = auth()->user()->id;
            $data['created_date'] = date('Y-m-d h:i:s');

            $datas = DB::table('struktur_organisasi')->insert($data);
        }

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function profil_dinas()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'PROFIL_DINAS';
            $data['data'] = DB::table('profil')->first();
            // dd($data);
            return view('admin.profil_dinas', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function create_profil_dinas(Request $request)
    {
        // dd($request);
        $cek = DB::table('profil')->first();
        $data['nama'] = $request->nama;
        $data['alamat'] = $request->alamat;
        $data['no_hp'] = $request->no_hp;
        $data['fax'] = $request->fax;
        $data['email'] = $request->email;
        $data['facebook'] = $request->facebook;
        $data['twitter'] = $request->twitter;
        $data['ig'] = $request->ig;
        $data['wa'] = $request->wa;
        $data['yt'] = $request->yt;
        $data['lat'] = $request->lat;
        $data['long'] = $request->long;

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/logo', $fileName);
            $file_path = 'uploads/logo/' . $fileName;
            $data['logo'] = $file_path;
        }

        if ($cek) {
            $data['edited_by'] = auth()->user()->id;
            $data['edited_date'] = date('Y-m-d h:i:s');

            $datas = DB::table('profil')->where('id', $cek->id)->update($data);
        } else {
            $data['created_by'] = auth()->user()->id;
            $data['created_date'] = date('Y-m-d h:i:s');

            $datas = DB::table('profil')->insert($data);
        }

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function layanan_dinas()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'LAYANAN_DINAS';
            return view('admin.layanan_dinas', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function layanan_dinas_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('layanan_dinas')->where('deleted', '!=', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-deskripsi="' . $field->deskripsi . '" data-image="' . $field->image . '" data-link="' . $field->link . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->addColumn('img', function ($field) {
                    $image = '<img src="' . asset($field->image) . '" width="50" alt="" class="rounded" />';
                    return $image;
                })
                ->rawColumns(['action', 'img'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_layanan_dinas(Request $request)
    {
        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        $data['link'] = $request->link;
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/layanan_dinas', $fileName);
            $file_path = 'uploads/layanan_dinas/' . $fileName;
            $data['image'] = $file_path;
        }
        $data['created_date'] = date('Y-m-d h:i:s');
        $data['created_by'] = auth()->user()->id;
        // dd($data);


        $datas = DB::table('layanan_dinas')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function update_layanan_dinas(Request $request)
    {

        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        $data['link'] = $request->link;
        if ($request->file('foto')) {
            $file = $request->file('foto');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/layanan_dinas', $fileName);
            $file_path = 'uploads/layanan_dinas/' . $fileName;
            $data['image'] = $file_path;
        }
        $data['edited_date'] = date('Y-m-d h:i:s');
        $data['edited_by'] = auth()->user()->id;
        // dd($data);

        $datas = DB::table('layanan_dinas')->where('id', $request->hidden_id)->update($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function delete_layanan_dinas(Request $request)
    {
        $data = DB::table('layanan_dinas')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }

    public function pegawai()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN') {
            $data['module'] = 'PEGAWAI';
            return view('admin.pegawai', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function pegawai_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('pegawai')->where('deleted', '!=', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nik="' . $field->nip . '" data-name="' . $field->nama . '" data-email="' . $field->email . '" data-phone="' . $field->no_hp . '"  data-jabatan="' . $field->jabatan . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_pegawai(Request $request)
    {
        $data['nip'] = $request->nik;
        $data['nama'] = $request->name;
        $data['email'] = $request->email;
        $data['no_hp'] = $request->phone;
        $data['jabatan'] = $request->jabatan;

        $data['created_date'] = date('Y-m-d h:i:s');
        $data['created_by'] = auth()->user()->id;

        $datas = DB::table('pegawai')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function update_pegawai(Request $request)
    {
        $data['nip'] = $request->nik;
        $data['nama'] = $request->name;
        $data['email'] = $request->email;
        $data['no_hp'] = $request->phone;
        $data['jabatan'] = $request->jabatan;

        $data['edited_date'] = date('Y-m-d h:i:s');
        $data['edited_by'] = auth()->user()->id;
        // dd($data);

        $datas = DB::table('pegawai')->where('id', $request->hidden_id)->update($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function delete_pegawai(Request $request)
    {
        $data = DB::table('pegawai')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }

    public function profil(Request $request)
    {
        $data['module'] = 'PROFIL';
        $data['user'] = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('admin.profil', compact('data'));
    }

    public function update_profil(Request $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['username'] = $request->username;
        if ($request->password != '') {
            $data['password'] = Hash::make($request->password);
        }

        if ($request->file('foto')) {
            $file = $request->file('foto');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/profil', $fileName);
            $file_path = 'uploads/profil/' . $fileName;
            $data['foto'] = $file_path;
        }

        $data['edited_date'] = date('Y-m-d h:i:s');
        $data['edited_by'] = auth()->user()->id;
        // dd($data);

        $datas = DB::table('users')->where('id', Auth::user()->id)->update($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function informasi_publik()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'INFORMASI_PUBLIK';
            return view('admin.informasi_publik', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function informasi_publik_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('informasi_publik')->where('deleted', '!=', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-deskripsi="' . $field->deskripsi . '" data-file="' . $field->file . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->addColumn('cover', function ($field) {
                    $img = ($field->cover != null) ? asset($field->cover) : asset('/uploads/noimage.jpg');
                    $cover = '<img src="' . $img . '" width="50" alt="" class="rounded" />';
                    return $cover;
                })
                ->addColumn('file', function ($field) {
                    $file = '<a href="' . asset($field->file) . '" target="_blank"><span class="badge bg-primary">file</span></a>';
                    return $file;
                })
                ->rawColumns(['action', 'file', 'cover'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_informasi_publik(Request $request)
    {
        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/informasi_publik', $fileName);
            $file_path = 'uploads/informasi_publik/' . $fileName;
            $data['file'] = $file_path;
        }

        if ($request->file('cover')) {
            $file = $request->file('cover');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/informasi_publik/cover', $fileName);
            $file_path = 'uploads/informasi_publik/cover/' . $fileName;
            $data['cover'] = $file_path;
        }
        $data['created_date'] = date('Y-m-d h:i:s');
        $data['created_by'] = auth()->user()->id;
        // dd($data);


        $datas = DB::table('informasi_publik')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function update_informasi_publik(Request $request)
    {

        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        if ($request->file('file')) {
            $file = $request->file('file');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/informasi_publik', $fileName);
            $file_path = 'uploads/informasi_publik/' . $fileName;
            $data['file'] = $file_path;
        }

        if ($request->file('cover')) {
            $file = $request->file('cover');
            $fileName = time() . rand(1, 99) . '_' . $file->getClientOriginalName();
            $file->move('uploads/informasi_publik/cover', $fileName);
            $file_path = 'uploads/informasi_publik/cover/' . $fileName;
            $data['cover'] = $file_path;
        }

        $data['edited_date'] = date('Y-m-d h:i:s');
        $data['edited_by'] = auth()->user()->id;
        // dd($data);

        $datas = DB::table('informasi_publik')->where('id', $request->hidden_id)->update($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function delete_informasi_publik(Request $request)
    {
        $data = DB::table('informasi_publik')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }

    public function pengaduan()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_PENGADUAN') {
            $data['module'] = 'PENGADUAN';
            return view('admin.pengaduan', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function pengaduan_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('pengaduan');
            $data->select(DB::raw('pengaduan.*, jenis_pengaduan.jenis, tanggapan.tanggapan, tanggapan.tanggapan, tanggapan.created_date as tgl_jawab,petugas.name as petugas_'))
                ->leftJoin('jenis_pengaduan', 'jenis_pengaduan.id', '=', 'pengaduan.jenis_pengaduan')
                ->leftJoin('tanggapan', 'tanggapan.pengaduan_id', '=', 'pengaduan.id')
                ->leftJoin('users as petugas', 'petugas.id', '=', 'tanggapan.petugas_id');
            if ($request->tanggal_start != '' && $request->tanggal_end != '') {
                $data->whereBetween('pengaduan.created_date', [$request->tanggal_start, $request->tanggal_end]);
            }
            $data->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    if ($field->status == 'MENUNGGU') {
                        $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-primary accept mr-1" data-id="' . $field->id . '" >Dijawab</a>
                        <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger rejact " data-id="' . $field->id . '">Ditolak</a></div>';
                    } else if ($field->status == 'DIJAWAB') {
                        $actionBtn = '<a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-success detail_jawab" data-id="' . $field->id . '" data-isi="' . $field->isi . '" data-tgl="' . $field->created_date . '" data-isi_jawaban="' . $field->tanggapan . '" data-tgl_jawaban="' . $field->tgl_jawab . '" data-petugas="' . $field->petugas_ . '">Detail</a>';
                    } else {
                        $actionBtn = '';
                    }

                    return $actionBtn;
                })
                ->addColumn('nama', function ($field) use ($request) {
                    $nama = $field->nama;
                    return $nama . '<span class="popover_ text-primary" style="margin-left:10px"><i class="fas fa-info-circle"></i></span>';
                })
                ->addColumn('status', function ($field) {
                    if ($field->status == 'DIJAWAB') {
                        $d = '<span class="badge bg-primary">Dijawab</span>';
                    } else if ($field->status == 'MENUNGGU') {
                        $d = '<span class="badge bg-warning">Menunggu</span>';
                    } else if ($field->status == 'DITOLAK') {
                        $d = '<span class="badge bg-danger">Ditolak</span>';
                    } else {
                        $d = '-';
                    }
                    return $d;
                })
                ->addColumn('file', function ($field) use ($request) {
                    $file = ($field->file != '') ? '<a href="' . asset($field->file) . '" class="btn btn-xs waves-effect waves-light btn-outline-primary" target="_blank">Lihat File</a>' : '-';
                    return $file;
                })
                ->rawColumns(['action', 'nama', 'file', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
    }



    public function detail_pengadu($id)
    {
        $pengaduan = DB::table('pengaduan')->where('id', $id)->first();
        $isi = '<table class="table">
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>' . $pengaduan->nik . '</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>' . $pengaduan->nama . '</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>' . $pengaduan->alamat . '</td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td>' . $pengaduan->kecamatan . '</td>
                    </tr>
                    <tr>
                        <td>Kelurahan</td>
                        <td>:</td>
                        <td>' . $pengaduan->kelurahan . '</td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>:</td>
                        <td>' . $pengaduan->email . '</td>
                    </tr>
                    <tr>
                        <td>No Hp</td>
                        <td>:</td>
                        <td>' . $pengaduan->no_hp . '</td>
                    </tr>
                    </table>';

        echo $isi;
    }

    public function get_detail_pengaduan(Request $request)
    {
        $id = $request->id;
        $pengaduan = DB::table('pengaduan')
            ->select(DB::raw('pengaduan.*'))
            ->where('pengaduan.id', $id)
            ->first();
        // dd($pengaduan);
        $tanggapan = DB::table('tanggapan')
            ->select(DB::raw('tanggapan.*, users.name as petugas'))
            ->leftJoin('users', 'users.id', '=', 'tanggapan.petugas_id')
            ->where('tanggapan.pengaduan_id', $pengaduan->id)
            ->get();

        $isi_pengaduan = '<p>Pengaduan Oleh ' . $pengaduan->nama . ' | ' . $pengaduan->created_date . '</p>
                <p>' . $pengaduan->isi . '</p>';

        $isi_tanggapan = '';
        foreach ($tanggapan as $val) {
            $isi_tanggapan .= '<div class="mb-2" style="background-color: rgb(226 232 240 / 1);border-left:4px solid #519259;padding:1rem">
                <p>Ditanggapi Oleh ' . $val->petugas . ' | ' . $val->created_date . '</p>
                <p>' . $val->tanggapan . '</p>
                </div>';
        }


        $r['pengaduan'] = $isi_pengaduan;
        $r['tanggapan'] = $isi_tanggapan;
        return response()->json($r);
    }

    public function accept_rejact_pengaduan(Request $request)
    {
        DB::beginTransaction();
        try {

            DB::table('pengaduan')->where('id', $request->id)->update([
                'status' => $request->status,
            ]);

            if ($request->status == 'DIJAWAB') {
                $jawab['pengaduan_id'] = $request->id;
                $jawab['tanggapan'] = $request->jawab;
                $jawab['petugas_id'] = Auth::user()->id;
                $jawab['created_date'] = date('Y-m-d h:i:s');
                DB::table('tanggapan')->insert($jawab);
            }

            $pengaduan = DB::table('pengaduan')
                ->select(DB::raw('pengaduan.*, tanggapan.tanggapan, users.name as petugas'))
                ->leftJoin('tanggapan', 'tanggapan.pengaduan_id', '=', 'pengaduan.id')
                ->leftJoin('users', 'users.id', '=', 'tanggapan.petugas_id')
                ->where('pengaduan.id', $request->id)
                ->first();
            // if ($pengaduan->tipe == 'INTERNAL') {
            //     $user = DB::table('users')->where('id', $pengaduan->id_user)->first();
            //     $email = $user->email;
            // } else if ($pengaduan->tipe == 'EKSTERNAL') {
            $email = $pengaduan->email;
            // } else {
            //     $email = '';
            // }
            // dd($pengaduan);

            $mailData = [
                'title' => 'Pengaduan',
                'body' => [
                    'isi' => $pengaduan->isi,
                    'jawab' => ($request->status == 'DIJAWAB') ? $pengaduan->tanggapan : 'Pengaduan DITOLAK',
                    'petugas' => ($request->status == 'DIJAWAB') ? $pengaduan->petugas : Auth::user()->name,
                    'status' => $request->status
                ]
            ];

            Mail::to($email)->send(new DpmptspMail($mailData));

            DB::commit();
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil ' . $request->status . '!';

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = 'Tidak dapat Menjawab / Menolak Pengaduan! Silakan hubungi Administrator.';
        }
        return response()->json($r);
    }


    public function jenis_pengaduan()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_PENGADUAN') {
            $data['module'] = 'JENIS_PENGADUAN';
            return view('admin.jenis_pengaduan', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function jenis_pengaduan_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('jenis_pengaduan')->where('deleted', '!=', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {

                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-jenis="' . $field->jenis . '" data-tipe="' . $field->tipe . '"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete_jenis " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_jenis_pengaduan(Request $request)
    {
        $data['jenis'] = $request->jenis;
        $data['tipe'] = $request->tipe;
        $data['created_date'] = date('Y-m-d h:i:s');
        $data['created_by'] = auth()->user()->id;
        $datas = DB::table('jenis_pengaduan')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function update_jenis_pengaduan(Request $request)
    {
        $data['jenis'] = $request->jenis;
        $data['tipe'] = $request->tipe;
        $data['edited_date'] = date('Y-m-d h:i:s');
        $data['edited_by'] = auth()->user()->id;
        $datas = DB::table('jenis_pengaduan')->where('id', $request->hidden_id)->update($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function delete_jenis_pengaduan(Request $request)
    {
        $data = DB::table('jenis_pengaduan')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }

    public function get_select_jenis(Request $request)
    {
        $data = DB::table('jenis_pengaduan')->where('deleted', '!=', 1)->get();
        $isi = '<option value="">- Pilih Jenis Pengaduan -</option>';
        foreach ($data as $val) {
            $isi .= '<option value="' . $val->id . '" data-jenis="' . $val->jenis . '">' . $val->jenis . '</option>';
        }
        echo $isi;
        return;
    }

    public function user_management()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN') {
            $data['module'] = 'USERMANAGEMENT';
            return view('admin.usermanagement', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function user_management_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('users')->where('deleted', '!=', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '"  data-name="' . $field->name . '" data-email="' . $field->email . '" data-username="' . $field->username . '" data-roles="' . $field->roles . '"  ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_user_management(Request $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['username'] = $request->username;
        $data['roles'] = $request->roles;
        $data['password'] = Hash::make($request->password);

        $data['created_date'] = date('Y-m-d h:i:s');
        $data['created_by'] = auth()->user()->id;

        $datas = DB::table('users')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function update_user_management(Request $request)
    {
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['username'] = $request->username;
        $data['roles'] = $request->roles;
        if ($request->password != '') {
            $data['password'] = Hash::make($request->password);
        }

        $data['edited_date'] = date('Y-m-d h:i:s');
        $data['edited_by'] = auth()->user()->id;
        // dd($data);

        $datas = DB::table('users')->where('id', $request->hidden_id)->update($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function delete_user_management(Request $request)
    {
        $data = DB::table('users')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }

    public function wbs()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_PENGADUAN') {
            $data['module'] = 'WBS';
            return view('admin.wbs', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function wbs_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('wbs_pengaduan');
            $data->select(DB::raw('wbs_pengaduan.*, jenis_pengaduan.jenis'))
                ->leftJoin('jenis_pengaduan', 'jenis_pengaduan.id', '=', 'wbs_pengaduan.jenis_pengaduan');
            if ($request->tanggal_start != '' && $request->tanggal_end != '') {
                $data->whereBetween('wbs_pengaduan.created_date', [$request->tanggal_start, $request->tanggal_end]);
            }
            $data->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    if ($field->status == 'MENUNGGU') {
                        $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-primary accept mr-1" data-id="' . $field->id . '" >Diterima</a>
                        <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger rejact " data-id="' . $field->id . '">Ditolak</a></div>';
                    } else if ($field->status == 'DITERIMA') {
                        $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-info process mr-1" data-id="' . $field->id . '" >Diproses</a></div>';
                        // $actionBtn = '<a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-success detail_jawab" data-id="' . $field->id . '" data-isi="' . $field->isi . '" data-tgl="' . $field->created_date . '" data-isi_jawaban="' . $field->tanggapan . '" data-tgl_jawaban="' . $field->tgl_jawab . '" data-petugas="' . $field->petugas_ . '">Detail</a>';
                    } else if ($field->status == 'DIPROSES') {
                        $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-info tanggap mr-1" data-id="' . $field->id . '" >Tanggap</a>
                        <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-success selesai " data-id="' . $field->id . '">Selesai</a></div>';
                    } else if ($field->status == 'SELESAI') {
                        // $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-primary process mr-1" data-id="' . $field->id . '" >Diproses</a></div>';
                        $actionBtn = '<a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-success detail_" data-id="' . $field->id . '">Detail</a>';
                    } else {
                        $actionBtn = '';
                    }

                    return $actionBtn;
                })
                ->addColumn('nama', function ($field) use ($request) {
                    $nama = $field->nama;
                    return $nama . '<span class="popover_ text-primary" style="margin-left:10px"><i class="fas fa-info-circle"></i></span>';
                })
                ->addColumn('status', function ($field) {
                    if ($field->status == 'DITERIMA') {
                        $d = '<span class="badge bg-primary">Diterima</span>';
                    } else if ($field->status == 'MENUNGGU') {
                        $d = '<span class="badge bg-warning">Menunggu</span>';
                    } else if ($field->status == 'DITOLAK') {
                        $d = '<span class="badge bg-danger">Ditolak</span>';
                    } else if ($field->status == 'DIPROSES') {
                        $d = '<span class="badge bg-info">Diproses</span>';
                    } else if ($field->status == 'SELESAI') {
                        $d = '<span class="badge bg-success">Selesai</span>';
                    } else {
                        $d = '-';
                    }
                    return $d;
                })
                ->addColumn('file', function ($field) use ($request) {
                    $file = ($field->file != '') ? '<a href="' . asset($field->file) . '" class="btn btn-xs waves-effect waves-light btn-outline-primary" target="_blank">Lihat File</a>' : '-';
                    return $file;
                })
                ->rawColumns(['action', 'nama', 'file', 'status'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function detail_pengadu_wbs($id)
    {
        $pengaduan = DB::table('wbs_pengaduan')
            ->select(DB::raw('wbs_pengaduan.*, jenis_pengaduan.jenis'))
            ->leftJoin('jenis_pengaduan', 'jenis_pengaduan.id', '=', 'wbs_pengaduan.jenis_pengaduan')
            ->where('wbs_pengaduan.id', $id)
            ->first();
        // dd($pengaduan);

        $isi = '<table class="table table-small table-striped" width="100%">
                    <tr>
                        <td>NIK</td>
                        <td>:</td>
                        <td>' . $pengaduan->nik . '</td>
                    </tr>
                    <tr>
                        <td>Nama</td>
                        <td>:</td>
                        <td>' . $pengaduan->nama . '</td>
                    </tr>
                    <tr>
                        <td>Alamat</td>
                        <td>:</td>
                        <td>' . $pengaduan->alamat . '</td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td>' . $pengaduan->kecamatan . '</td>
                    </tr>
                    <tr>
                        <td>Kelurahan</td>
                        <td>:</td>
                        <td>' . $pengaduan->kelurahan . '</td>
                    </tr>
                    <tr>
                        <td>E-mail</td>
                        <td>:</td>
                        <td>' . $pengaduan->email . '</td>
                    </tr>
                    <tr>
                        <td>No Hp</td>
                        <td>:</td>
                        <td>' . $pengaduan->no_hp . '</td>
                    </tr>
                    </table>';
        $isi_ = '<table class="table small table-striped" width="100%">
                    <tr>
                        <td width="30%">Jenis Pengaduan</td>
                        <td>:</td>
                        <td>' . $pengaduan->jenis . '</td>
                    </tr>
                    <tr>
                        <td>Nama Terlapor</td>
                        <td>:</td>
                        <td>' . $pengaduan->nama_terlapor . '</td>
                    </tr>
                    <tr>
                        <td>Tanggal kejadian</td>
                        <td>:</td>
                        <td>' . $pengaduan->tgl_kejadian . '</td>
                    </tr>
                    <tr>
                        <td>Waktu kejadian</td>
                        <td>:</td>
                        <td>' . $pengaduan->waktu_kejadian . '</td>
                    </tr>
                    <tr>
                        <td>Lokasi kejadian</td>
                        <td>:</td>
                        <td>' . $pengaduan->lokasi_kejadian . '</td>
                    </tr>
                    <tr>
                        <td>Kecamatan</td>
                        <td>:</td>
                        <td>' . $pengaduan->kecamatan_ . '</td>
                    </tr>
                    <tr>
                        <td>Kelurahan</td>
                        <td>:</td>
                        <td>' . $pengaduan->kelurahan_ . '</td>
                    </tr>
                   
                    <tr>
                        <td>Isi Pengaduan</td>
                        <td>:</td>
                        <td>' . $pengaduan->isi . '</td>
                    </tr>
                    </table>';
        $card = '<div class="row">
                    <div class="col-md-4">
                        <div class="card">
                            <div class="card-header">
                                Data Pribadi
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                ' . $isi . '
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-8">
                        <div class="card">
                            <div class="card-header">
                                Data Pengaduan
                            </div>
                            <div class="card-body">
                                <div class="table-responsive">
                                ' . $isi_ . '
                                </div>
                            </div>
                        </div>
                    </div>
                </div>';

        echo $card;
    }

    public function accept_rejact_wbs(Request $request)
    {
        DB::beginTransaction();
        try {

            DB::table('wbs_pengaduan')->where('id', $request->id)->update([
                'status' => $request->status,
            ]);

            // $pengaduan = DB::table('wbs_pengaduan')
            //     ->select(DB::raw('wbs_pengaduan.*'))
            //     ->where('wbs_pengaduan.id', $request->id)
            //     ->first();

            // $email = $pengaduan->email;

            // $mailData = [
            //     'title' => 'Pengaduan',
            //     'body' => [
            //         'isi' => $pengaduan->isi,
            //         'jawab' => ($request->status == 'DITERIMA') ? 'Pengaduan Anda telah Kamu Terima' : 'Pengaduan DITOLAK',
            //         'petugas' => Auth::user()->name,
            //         'status' => $request->status
            //     ]
            // ];

            // Mail::to($email)->send(new DpmptspMail($mailData));

            DB::commit();
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil ' . $request->status . '!';

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = 'Tidak dapat Menerima / Menolak Pengaduan! Silakan hubungi Administrator.';
        }
        return response()->json($r);
    }

    public function process_wbs(Request $request)
    {
        DB::beginTransaction();
        try {

            DB::table('wbs_pengaduan')->where('id', $request->id)->update([
                'status' => $request->status,
            ]);

            $jawab['pengaduan_id'] = $request->id;
            $jawab['tanggapan'] = $request->jawab;
            $jawab['petugas_id'] = Auth::user()->id;
            $jawab['created_date'] = date('Y-m-d h:i:s');
            DB::table('tanggapan_wbs')->insert($jawab);

            // $pengaduan = DB::table('wbs_pengaduan')
            //     ->select(DB::raw('wbs_pengaduan.*'))
            //     ->where('wbs_pengaduan.id', $request->id)
            //     ->first();

            // $email = $pengaduan->email;

            // $mailData = [
            //     'title' => 'Pengaduan',
            //     'body' => [
            //         'isi' => $pengaduan->isi,
            //         'jawab' => ($request->status == 'DITERIMA') ? 'Pengaduan Anda telah Kamu Terima' : 'Pengaduan DITOLAK',
            //         'petugas' => Auth::user()->name,
            //         'status' => $request->status
            //     ]
            // ];

            // Mail::to($email)->send(new DpmptspMail($mailData));

            DB::commit();
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil ' . $request->status . '!';

            // all good
        } catch (\Exception $e) {
            DB::rollback();
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = 'Tidak dapat Memproses Pengaduan! Silakan hubungi Administrator.';
        }
        return response()->json($r);
    }

    public function get_detail_wbs(Request $request)
    {
        $id = $request->id;
        $pengaduan = DB::table('wbs_pengaduan')
            ->select(DB::raw('wbs_pengaduan.*'))
            ->where('wbs_pengaduan.id', $id)
            ->first();
        // dd($pengaduan);
        $tanggapan = DB::table('tanggapan_wbs')
            ->select(DB::raw('tanggapan_wbs.*, users.name as petugas'))
            ->leftJoin('users', 'users.id', '=', 'tanggapan_wbs.petugas_id')
            ->where('tanggapan_wbs.pengaduan_id', $pengaduan->id)
            ->get();

        $isi_pengaduan = '<p>Pengaduan Oleh ' . $pengaduan->nama . ' | ' . $pengaduan->created_date . '</p>
                <p>' . $pengaduan->isi . '</p>';

        $isi_tanggapan = '';
        foreach ($tanggapan as $val) {
            $isi_tanggapan .= '<div class="mb-2" style="background-color: rgb(226 232 240 / 1);border-left:4px solid #519259;padding:1rem">
                <p>Ditanggapi Oleh ' . $val->petugas . ' | ' . $val->created_date . '</p>
                <p>' . $val->tanggapan . '</p>
                </div>';
        }


        $r['pengaduan'] = $isi_pengaduan;
        $r['tanggapan'] = $isi_tanggapan;
        return response()->json($r);
    }

    public function investasi()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'INVESTASI';
            $data['tahun'] = DB::table('investasi')->select('tahun')->where('deleted', 0)->groupBy('tahun')->get();
            return view('admin.investasi', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function investasi_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('investasi')->where('deleted', '!=', 1);
            if ($request->tahun <> '') {
                $data->where('tahun', $request->tahun);
            }
            if ($request->jenis <> '') {
                $data->where('jenis', $request->jenis);
            }

            $data->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-tahun="' . $field->tahun . '" data-triwulan="' . $field->triwulan . '" data-jumlah="' . $field->jumlah . '" data-jenis="' . $field->jenis . '"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->addColumn('jumlah', function ($field) {
                    $hasil_rupiah = number_format($field->jumlah, 0, '.', ',');
                    return $hasil_rupiah;
                })
                ->addColumn('jenis', function ($field) {
                    $d = ($field->jenis == 'realisasi') ? '<span class="badge bg-success">Realisasi</span>' : '<span class="badge bg-primary">Proyek</span>';
                    return $d;
                })
                ->rawColumns(['action', 'jumlah', 'jenis'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function get_tahun_investasi()
    {
        $data_tahun = DB::table('investasi')->select('tahun')->where('deleted', 0)->groupBy('tahun')->get();
        $tahun = '<option value="">- Pilih Tahun -</option>';
        foreach ($data_tahun as $val) {
            $tahun .= '<option value="' . $val->tahun . '">' . $val->tahun . '</option>';
        }
        $r['tahun'] = $tahun;
        return response()->json($r);
    }

    public function create_investasi(Request $request)
    {
        $data['tahun'] = $request->tahun;
        $data['triwulan'] = $request->triwulan;
        $data['jumlah'] = $request->jumlah;
        $data['jenis'] = $request->jenis;
        // dd($data);
        $data['created_date'] = date('Y-m-d h:i:s');
        $data['created_by'] = auth()->user()->id;

        $datas = DB::table('investasi')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function update_investasi(Request $request)
    {
        $data['tahun'] = $request->tahun;
        $data['triwulan'] = $request->triwulan;
        $data['jumlah'] = $request->jumlah;
        $data['jenis'] = $request->jenis;

        $data['edited_date'] = date('Y-m-d h:i:s');
        $data['edited_by'] = auth()->user()->id;
        // dd($data);

        $datas = DB::table('investasi')->where('id', $request->hidden_id)->update($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function delete_investasi(Request $request)
    {
        $data = DB::table('investasi')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }

    public function kategori_perizinan()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'PERIZINAN';
            return view('admin.kategori_perizinan', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function kategori_perizinan_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('kategori_perizinan')->where('deleted', '!=', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {

                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nama="' . $field->nama . '" data-deskripsi="' . $field->deskripsi . '"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete_jenis " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->rawColumns(['action'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_kategori_perizinan(Request $request)
    {
        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        $data['created_date'] = date('Y-m-d h:i:s');
        $data['created_by'] = auth()->user()->id;
        $datas = DB::table('kategori_perizinan')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function update_kategori_perizinan(Request $request)
    {
        $data['nama'] = $request->nama;
        $data['deskripsi'] = $request->deskripsi;
        $data['edited_date'] = date('Y-m-d h:i:s');
        $data['edited_by'] = auth()->user()->id;
        $datas = DB::table('kategori_perizinan')->where('id', $request->hidden_id)->update($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function delete_kategori_perizinan(Request $request)
    {
        $data = DB::table('kategori_perizinan')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }


    public function perizinan()
    {
        if (Auth::user()->roles == 'SUPER_ADMIN' || Auth::user()->roles == 'ADMIN_CMS') {
            $data['module'] = 'PERIZINAN';
            $data['tahun'] = DB::table('perizinan')->select('tahun')->where('deleted', 0)->groupBy('tahun')->get();
            $data['kategori'] = DB::table('kategori_perizinan')->where('deleted', 0)->get();
            return view('admin.perizinan', compact('data'));
        } else {
            return abort('404');
        }
    }

    public function perizinan_(Request $request)
    {
        if ($request->ajax()) {
            $data = DB::table('perizinan');
            $data->leftJoin('kategori_perizinan', 'kategori_perizinan.id', '=', 'perizinan.id_kategori_perizinan');
            $data->select('perizinan.*', 'kategori_perizinan.nama as kategori');
            $data->where('perizinan.deleted', '!=', 1);
            if ($request->tahun <> '') {
                $data->where('perizinan.tahun', $request->tahun);
            }
            if ($request->jenis <> '') {
                $data->where('kategori_perizinan.id', $request->jenis);
            }

            $data->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-tahun="' . $field->tahun . '" data-bulan="' . $field->bulan . '" data-total="' . $field->total . '" data-kategori="' . $field->id_kategori_perizinan . '"><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->addColumn('total', function ($field) {
                    $hasil_rupiah = number_format($field->total, 0, '.', ',');
                    return $hasil_rupiah;
                })
                ->rawColumns(['action', 'jumlah'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function get_tahun_perizinan()
    {
        $data_tahun = DB::table('perizinan')->select('tahun')->where('deleted', 0)->groupBy('tahun')->get();
        $tahun = '<option value="">- Pilih Tahun -</option>';
        foreach ($data_tahun as $val) {
            $tahun .= '<option value="' . $val->tahun . '">' . $val->tahun . '</option>';
        }
        $r['tahun'] = $tahun;
        return response()->json($r);
    }

    public function create_perizinan(Request $request)
    {
        $data['tahun'] = $request->tahun;
        $data['bulan'] = $request->bulan;
        $data['total'] = $request->total;
        $data['id_kategori_perizinan'] = $request->kategori;
        // dd($data);
        $data['created_date'] = date('Y-m-d h:i:s');
        $data['created_by'] = auth()->user()->id;

        $datas = DB::table('perizinan')->insert($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function update_perizinan(Request $request)
    {
        $data['tahun'] = $request->tahun;
        $data['bulan'] = $request->bulan;
        $data['total'] = $request->total;
        $data['id_kategori_perizinan'] = $request->kategori;

        $data['edited_date'] = date('Y-m-d h:i:s');
        $data['edited_by'] = auth()->user()->id;
        // dd($data);

        $datas = DB::table('perizinan')->where('id', $request->hidden_id)->update($data);

        $r['result'] = true;
        if (!$datas) {
            $r['result'] = false;
        }
        return response()->json($r);
    }

    public function delete_perizinan(Request $request)
    {
        $data = DB::table('perizinan')->where('id', $request->id)->update([
            'deleted' => 1,
        ]);
        if ($data) {
            $r['title'] = 'Sukses!';
            $r['icon'] = 'success';
            $r['status'] = 'Berhasil di Hapus!';
        } else {
            $r['title'] = 'Maaf!';
            $r['icon'] = 'error';
            $r['status'] = '<br><b>Tidak dapat di Hapus! <br> Silakan hubungi Administrator.</b>';
        }
        return response()->json($r);
    }
}
