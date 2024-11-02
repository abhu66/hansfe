<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class RoleController extends Controller
{
    public function showRole()
    {
        try {
            $token = Session::get('token');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post(env('API_URL') . '/api/v1/roles/get');

            if ($response->successful() && $response->json('success')) {
                $data = $response->json('data');
                $role = json_decode(json_encode($data)); // Mengonversi array menjadi objek jika dibutuhkan

                return view("pages.role.index", compact("role"));
            } else {
                return redirect()->back()->with('error', 'Gagal mengambil data role.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function create()
    {
        try {
            $token = Session::get('token');
            if (!$token) {
                return redirect()->back()->with('error', 'Token tidak ditemukan.');
            }

            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post(env('API_URL') . '/api/functions/get');

                // dd($response->body());

            if ($response->successful() && $response->json('success')) {
                $data = $response->json('data');
                $f_role = json_decode(json_encode($data)); // Mengonversi array menjadi objek jika dibutuhkan
                // dd($f_role);
                return view("pages.role.add.index", compact("f_role"));
            } else {
                return redirect()->back()->with('error', 'Gagal mengambil data function role.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function store(Request $request)
    {
        try {
            $name = $request->name;
            $is_active = $request->is_active;

            $client = new Client();
            $res = $client->request('POST', env('API_URL') . '/api/v1/roles/create',  [
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
                        'name'     => 'is_active',
                        'contents' => $is_active ? '1' : '0',
                    ],
                ],
            ]);

            $res = $client->request('POST', env('API_URL') . '/api/v1/roles/create',  [
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
                        'name'     => 'is_active',
                        'contents' => $is_active ? '1' : '0',
                    ],
                ],
            ]);

            return redirect()->route('role');
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }


}
