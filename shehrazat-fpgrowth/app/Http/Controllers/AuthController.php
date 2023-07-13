<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Session;

class AuthController extends Controller
{
    public function checkAuth()
    {
        if(Auth::check()) {
            return redirect()->to('dashboard');
        } else {
            return redirect()->to('login');
        }
    }

    public function index()
    {
        return view('login');
    }

    public function auth(Request $request)
    {
        $data = [
            'email'     => $request->input('email'),
            'password'  => $request->input('password'),
        ];

        if($request->input('remember') != null) {
            Auth::attempt($data, true);
        } else {
            Auth::attempt($data, false);
        }

        if (Auth::check()) {
            return redirect()->to('/');
        } else {
            Session::flash('error', 'Email atau password salah');
            return redirect()->back();
        }
    }

    public function logout() {
        Auth::logout();
        return redirect()->to('/');
    }
}
