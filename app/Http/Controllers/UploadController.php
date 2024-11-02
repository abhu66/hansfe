<?php

namespace App\Http\Controllers;

use GuzzleHttp\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Session;

class UploadController extends Controller
{
    public function showUpload()
    {
        try {
            $token = Session::get('token');
            $response = Http::withHeaders([
                'Authorization' => 'Bearer ' . $token,
            ])->post(env('API_URL') . '/api/v1/file/get');

            if ($response->successful() && $response->json('success')) {
                $data = $response->json('data');
                $file = json_decode(json_encode($data)); // Mengonversi array menjadi objek jika dibutuhkan

                return view("pages.upload.index", compact("file"));
            } else {
                return redirect()->back()->with('error', 'Gagal mengambil data role.');
            }
        } catch (\Throwable $th) {
            return redirect()->back()->with('error', $th->getMessage());
        }
    }

    // public function store(Request $request)
    // {
    //     try {
    //         $upload = $request->file('upload');

    //         $client = new Client();
    //         $res = $client->request('POST', env('API_URL') . '/api/v1/file/upload-excel',  [
    //             'headers' => [
    //                 'Authorization' => 'Bearer ' . Session::get('token'),
    //             ],
    //             'verify' => false,
    //             'multipart' => [
    //                 [
    //                     'name'     => 'excel_file',
    //                     'contents' => file_get_contents($upload->getPathname()),
    //                     'filename' => 'upload.' . $upload->getClientOriginalExtension(),
    //                 ],
    //             ],
    //         ]);

    //         return redirect()->route('pages.upload.index');
    //     } catch (\Throwable $th) {
    //         return redirect()->back()->with('error', $th->getMessage());
    //     }
    // }

//     public function store(Request $request)
// {
//     try {
//         // Validate the file upload
//         $request->validate([
//             'upload' => 'required|file|mimes:xls,xlsx|max:2048', // Adjust max size as needed
//         ]);

//         $upload = $request->file('upload');

//         $client = new Client();
//         $res = $client->request('POST', env('API_URL') . '/api/v1/file/upload-excel',  [
//             'headers' => [
//                 'Authorization' => 'Bearer ' . Session::get('token'),
//             ],
//             'verify' => false,
//             'multipart' => [
//                 [
//                     'name'     => 'excel_file',
//                     'contents' => file_get_contents($upload->getPathname()),
//                     'filename' => 'upload.' . $upload->getClientOriginalExtension(),
//                 ],
//             ],
//         ]);

//         // Check if the response status is 200 OK
//         if ($res->getStatusCode() === 200) {
//              $data = response()->json([
//                 'success' => true,
//                 'message' => 'File uploaded successfully!',
//             ]);

//             return redirect()->route('upload',compact('data'));
//         }
//         else {

//             $data = response()->json([
//                 'success' => false,
//                 'message' => 'Failed to upload file to the external API.',
//             ], 400);

//             return redirect()->route('upload',compact('data'));
//         }


//     } catch (\Throwable $th) {
//         // Return a JSON error response
//         return response()->json([
//             'success' => false,
//             'message' => 'Error: ' . $th->getMessage(),
//         ], 500);
//     }
// }


public function store(Request $request)
{
    try {
        $upload = $request->file('upload');

        $client = new Client();
        $res = $client->request('POST', env('API_URL') . '/api/v1/file/upload-excel',  [
            'headers' => [
                'Authorization' => 'Bearer ' . Session::get('token'),
            ],
            'verify' => false,
            'multipart' => [
                [
                    'name'     => 'excel_file',
                    'contents' => file_get_contents($upload->getPathname()),
                    'filename' => 'upload.' . $upload->getClientOriginalExtension(),
                ],
            ],
        ]);

        return response()->json(['message' => 'File uploaded successfully!']);
    } catch (\Throwable $th) {
        return response()->json(['error' => $th->getMessage()], 500);
    }
}

}
