<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AdminController extends Controller
{
    public function index()
    {
        $data['cek'] = 'admin';
        $data['isi'] = 'Selamat Datang Admin';
        return view('admin.index', compact('data'));
    }
    public function dashboard()
    {
        return view('admin.dashboard');
    }
}
