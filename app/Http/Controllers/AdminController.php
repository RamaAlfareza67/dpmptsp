<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;
use Illuminate\Support\Facades\Hash;

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
                    $image = '<img src="' . $field->image . '" width="50" alt="" class="rounded" />';
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
                    $image = '<img src="' . $field->image . '" width="50" alt="" class="rounded" />';
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
            $data = DB::table('users')->where('deleted', '!=', 1)->get();
            return Datatables::of($data)
                ->addIndexColumn()
                ->addColumn('action', function ($field) {
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-nik="' . $field->nik . '" data-name="' . $field->name . '" data-email="' . $field->email . '" data-phone="' . $field->phone . '" data-roles="' . $field->roles . '" data-jabatan="' . $field->jabatan . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->addColumn('img', function ($field) {
                    $img = ($field->foto != null) ? $field->foto : '/uploads/noimage.jpg';
                    $image = '<img src="' . $img . '" width="50" alt="" class="rounded" />';
                    return $image;
                })
                ->rawColumns(['action', 'img'])
                ->addIndexColumn()
                ->make(true);
        }
    }

    public function create_pegawai(Request $request)
    {
        $data['nik'] = $request->nik;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['jabatan'] = $request->jabatan;
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

    public function update_pegawai(Request $request)
    {
        $data['nik'] = $request->nik;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
        $data['jabatan'] = $request->jabatan;
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

    public function delete_pegawai(Request $request)
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

    public function profil(Request $request)
    {
        $data['module'] = 'PROFIL';
        $data['user'] = DB::table('users')->where('id', Auth::user()->id)->first();
        return view('admin.profil', compact('data'));
    }

    public function update_profil(Request $request)
    {
        $data['nik'] = $request->nik;
        $data['name'] = $request->name;
        $data['email'] = $request->email;
        $data['phone'] = $request->phone;
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
}
