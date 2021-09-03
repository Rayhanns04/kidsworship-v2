<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class ApiGetImageController extends Controller
{
     public function index($path, $name)
    {
        return response()->download(public_path().'/assets/images/'.$path.'/'.$name);
    }
}
