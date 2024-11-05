<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class CompanyController extends Controller
{
    public function companyCheck()
    {
        try {
            $token = Session::get('token');

            $response = Http::withHeaders([])->post(env('API_URL') . '/api/v1/company/check', [

                'url'=> request()->root() . "/",
            ]);
            return $response;

        } catch (\GuzzleHttp\Exception\ClientException $e) {
            // Get the response and decode JSON
            $response = $e->getResponse();
            $responseBody = json_decode($response->getBody()->getContents(), true);

            // Extract error message and redirect back with the message
            $errorMessage = $responseBody['message'] ?? 'Something went wrong.';
            return redirect()->back()->with('error', $errorMessage);
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    public function companyNotFound () {
        return view('pages.company_not_found.index');
    }
}
