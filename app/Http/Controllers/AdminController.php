<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use DataTables;

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
                    $actionBtn = '<div class="d-flex"><a href="javascript:void(0);" class="btn btn-xs waves-effect waves-light btn-outline-warning edit mr-1" data-id="' . $field->id . '" data-judul="' . $field->judul . '" data-isi="' . $field->isi . '" data-image="' . $field->image . '" data-penulis="' . $field->penulis . '" data-status="' . $field->status . '" ><i class="fas fa-pen fa-xs"></i></a>
                    <a href="javascript:void(0);" style="margin-left:5px" class="btn btn-xs waves-effect waves-light btn-outline-danger delete " data-id="' . $field->id . '"><i class="fas fa-trash fa-xs"></i></a></div>';
                    return $actionBtn;
                })
                ->addColumn('img', function ($field) {
                    $image = '<img src="' . $field->image . '" width="50" alt="" class="rounded" />';
                    return $image;
                })
                ->addColumn('status', function ($field) {
                    $d = ($field->status == 'PUBLISH') ? '<span class="badge bg-success">Publish</span>' : '<span class="badge bg-warning">Draft</span>';
                    return $d;
                })
                ->rawColumns(['action', 'img', 'status'])
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

    public function pegawai()
    {
        $data['module'] = 'PEGAWAI';
        return view('admin.pegawai', compact('data'));
    }
}
