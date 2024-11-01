<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\ValidationException;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function showUser()
    {
        try {
            $response = Http::post(env('API_URL') . '/api/user/get');

            if ($response->successful() && $response->json('success')) {
                $data = $response->json('data');
                $data = json_decode($response);
                $user = $data->data;

                return view("pages.user.index", compact("user"));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("pages.user.add.index");
    }

    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        try {
            $name = $request->name;
            $email = $request->email;
            $password = $request->password;
            $c_password = $request->c_password;

            $client = new Client();
            $res = $client->request('POST', env('API_URL') . '/api/user/create',  [
                'headers' => [
                    'Authorization' => 'Bearer ' . Session::get('token'),
                ],
                'verify' => false,
                'multipart' => [
                    [
                        'name'     => 'name',
                        'contents' => $name,
                    ],
                    [
                        'name'     => 'email',
                        'contents' => $email,
                    ],
                    [
                        'name'     => 'password',
                        'contents' => $password,
                    ],
                    [
                        'name'     => 'c_password',
                        'contents' => $c_password,
                    ],
                ],
            ]);

            return redirect()->route('user');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    // public function store(Request $request)
    // {
    //     // Validasi input
    //     $request->validate([
    //         'name' => 'required|string|max:255',
    //         'email' => 'required|email',
    //         'password' => 'required|min:6',
    //         'confirm_password' => 'required|same:password'  // Pastikan confirm_password sesuai dengan password
    //     ], [
    //         'confirm_password.same' => 'Konfirmasi password tidak sesuai dengan password.'  // Pesan kesalahan
    //     ]);

    //     try {
    //         // Kirim request ke API eksternal jika validasi berhasil
    //         $response = Http::post(env('API_URL') . '/api/user/create', [
    //             'name' => $request->name,
    //             'email' => $request->email,
    //             'password' => $request->password,
    //             'confirm_password' => $request->confirm_password
    //         ]);

    //         if ($response->successful() && $response->json('success')) {
    //             return redirect()->route('user')->with('success', 'User berhasil ditambahkan');
    //         } else {
    //             // Tampilkan pesan error dari API jika gagal
    //             return redirect()->back()->with('error', $response->json('message'));
    //         }
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', $th->getMessage());
    //     }
    // }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
