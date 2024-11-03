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
            $token = Session::get('token');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->get(env('API_URL') . '/api/v1/user/get');

            if ($response->successful() && $response->json('success')) {
                $data = $response->json('data');
                $data = json_decode($response);
                $user = $data->data;
                // dd($user);
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
        try {
            $token = Session::get('token');
            if (!$token) {
                return redirect()->back()->with('error', 'Token tidak ditemukan.');
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post(env('API_URL') . '/api/v1/roles/get');

            if ($response->successful() && $response->json('success')) {
                $data = $response->json('data');
                $f_role = json_decode(json_encode($data)); // Mengonversi array menjadi objek jika dibutuhin

                return view("pages.user.add.index", compact("f_role"));
            } else {
                return redirect()->back()->with('error', 'Gagal mengambil data function role.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }

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
            $roleId = $request->role_id;

            $client = new Client();
            $res = $client->request('POST', env('API_URL') . '/api/v1/user/create',  [
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
                    [
                        'name'     => 'roles_id',
                        'contents' => $roleId,
                    ]
                ],
            ]);

            return redirect()->route('user');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

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
