<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Hash;
use Session;
use App\Models\LoginModel;
use Illuminate\Contracts\Session\Session as SessionSession;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class LoginController extends Controller
{

    public function index()
    {
        return view('auth.login');
    }


    public function customLogin(Request $request)
    {
        $input = $request->all();
        // dd($input);
        $request->validate([
            'email' => 'required',
            'password' => 'required',
        ]);


        $credentials = $request->only('email', 'password');

        if (!auth()->attempt($credentials)) {
            return redirect()->route('login')
                ->with('error', 'Maaf E-mail / Password Anda Salah !!');
        }

        $dinas = DB::table('profil')->first();
        $request->session()->put('logo', $dinas->logo);
        return redirect('/user');
    }



    public function signOut()
    {
        Session::flush();
        Auth::logout();

        return Redirect('login');
    }
}
