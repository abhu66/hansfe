<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
    public function showLogin () {
        return view("auth.login");
    }

    public function login (Request $request) {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
                ]);

                $response = Http::post('128.199.218.154:8000/api/user/login', [
                    'email'=> $request->email,
                    'password'=> $request->password
                ]);

                if ($response->successful() && $response->json('success')) {
                    $data = $response->json('data');

                    Session::put('token', $data['token']);
                    Session::put('user', $data['user']);

                    return redirect()->route('dashboard')->with('success','Login berhasil');
                } else {
                    return redirect()->back()->with('error', $response->json('message'));
                }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

        // if ($response->successful()) {
        //     return redirect()->route('dashboard')->with('success','Login berhasil');
        // } else {
        //     return back()->withErrors(['Login error' =>'Login gagal, periksa kembali email dan password anda']);
        // }
    }

    public function logout () {
        Session::flush();
        return redirect()->route('login')->with('success','Logout berhasil');
    }

    public function showChangePassword () {
        return view("auth.change-password");
    }

    public function showForgotPassword () {
        return view("auth.forgot-password");
    }
}
