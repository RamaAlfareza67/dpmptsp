<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Hash;
use Mail;
use App\Mail\DpmptspMail;

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
        return response()->json($datas);
    }

    public function dashboard()
    {
        $data['module'] = 'DASHBOARD';
        return view('admin.dashboard', compact('data'));
    }

    public function artikel()
    {
        $data['module'] = 'ARTIKEL';
        return view('admin.artikel', compact('data'));
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
                    return $desc;
                })
                ->addColumn('img', function ($field) {
                    $image = '<img src="' . asset($field->image) . '" width="50" alt="" class="rounded" />';
                    return $image;
                })
                ->addColumn('status', function ($field) {
                    $d = ($field->status == 'PUBLISH') ? '<span class="badge bg-success">Publish</span>' : '<span class="badge bg-warning">Draft</span>';
                    return $d;
                })
                ->rawColumns(['action', 'img', 'desc', 'status'])
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
        $data['module'] = 'VISI_MISI';
        $data['data'] = DB::table('visi_misi')->first();
        return view('admin.visi_misi', compact('data'));
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
        $data['module'] = 'STRUKTUR_ORGANISASI';
        $data['data'] = DB::table('struktur_organisasi')->first();
        return view('admin.struktur_organisasi', compact('data'));
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
        $data['module'] = 'PROFIL_DINAS';
        $data['data'] = DB::table('profil')->first();
        // dd($data);
        return view('admin.profil_dinas', compact('data'));
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
        $data['module'] = 'LAYANAN_DINAS';
        return view('admin.layanan_dinas', compact('data'));
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
        $data['module'] = 'PEGAWAI';
        return view('admin.pegawai', compact('data'));
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
        $data['module'] = 'INFORMASI_PUBLIK';
        return view('admin.informasi_publik', compact('data'));
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
        $data['module'] = 'PENGADUAN';
        return view('admin.pengaduan', compact('data'));
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
        $data['module'] = 'JENIS_PENGADUAN';
        return view('admin.jenis_pengaduan', compact('data'));
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
        $data['module'] = 'USERMANAGEMENT';
        return view('admin.usermanagement', compact('data'));
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
}
