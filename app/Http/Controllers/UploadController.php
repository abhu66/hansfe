<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class UploadController extends Controller
{
    public function showUpload() {
        return view('pages.upload.index');
    }
}
