<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class AuthController extends Controller
{
      public function showLogin()
        {
            // panggil controller CompanyController
            $companyController = new CompanyController();
            $companyCheckData = $companyController->companyCheck();

            if($companyCheckData->json('success') == false) {
               $f_company = null;
               return view("auth.login",compact("f_company"));
                //return redirect()->route('company-not-found')->with('error', $companyCheckData->json('message'));
            } else {
                 $data_company = $companyCheckData->json('data');
                 $f_company = json_decode(json_encode($data_company));
                 Session::put('logo_url',$data_company['logo_url']);
                return view("auth.login",compact("f_company"));
            }
        }

    public function login(Request $request)
    {
        try {
            $request->validate([
                'email' => 'required|email',
                'password' => 'required',
            ]);

            $response = Http::post(env('API_URL') . '/api/v1/user/login', [
                'email' => $request->email,
                'password' => $request->password
            ]);

            if ($response->successful() && $response->json('success')) {
                $data = $response->json('data');

                Session::put('token', $data['token']);
                Session::put('user', $data['user']);
                Session::put('role_functions', $data['user']['role']['functions']);

                $companyController = new CompanyController();
                $companyCheckData = $companyController->companyCheck();
                //dd($companyCheckData->json('data'));
                if($companyCheckData->json('success') == false) {
                      $f_company = null;
                      return view("auth.login",compact("f_company"));
                       //return redirect()->route('company-not-found')->with('error', $companyCheckData->json('message'));
                   } else {
                        $data_company = $companyCheckData->json('data');
                        //$f_company = json_decode(json_encode($data_company));
                        Session::put('logo_url',$data_company['logo_url']);
                   }

                return redirect()->route('index')->with('success', 'Login berhasil');
            } else {
                return redirect()->back()->with('error', $response->json('message'));
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function logout()
    {
        Session::flush();
        return redirect()->route('login')->with('success', 'Logout berhasil');
    }

    public function showChangePassword()
    {
        return view("auth.change-password");
    }

    public function showForgotPassword()
    {
        return view("auth.forgot-password");
    }
}
