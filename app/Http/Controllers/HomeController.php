<?php

namespace App\Http\Controllers;

use App\Models\AllAsset;
use App\Models\CommonTime;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $commonTimes = CommonTime::all();
        $Title = "Common Times";
        $allAssets = AllAsset::all();
        $TitleAssets = "All Assets";

        return view('home', compact('commonTimes', 'Title', 'allAssets', 'TitleAssets'));
    }
}
