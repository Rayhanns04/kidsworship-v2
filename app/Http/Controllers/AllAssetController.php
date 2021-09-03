<?php

namespace App\Http\Controllers;

use App\Models\AllAsset;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AllAssetController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $allAssets = AllAsset::all();

        // Custome Variable
        $Title = "All Assets";
        $Action = "/all-assets";

        return view('pages.asset.index', compact('allAssets', 'Title', 'Action'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
         $validator = Validator::make($request->all(), [
            'image' => 'required',
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields']);
        }

        $nm = $request->image;
        $fileName = time().rand(100,999).".".$nm->getClientOriginalExtension();

        $allAsset = new AllAsset;
        $allAsset->name = $request->name;
        $allAsset->image = $fileName;

        $nm->move(public_path()."/assets/images/allAsset", $fileName );
        $allAsset->save();

        return redirect('/all-assets');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\AllAsset  $allAsset
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
         $validator = Validator::make($request->all(), [
            'image' => 'required',
            'name' => 'required|string|max:255'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields']);
        }

        $allAsset = AllAsset::findOrFail($id);
        $before = $allAsset->image;

        $allAsset->name = $request->name;
        $request->image->move(public_path()."/assets/images/allAsset", $before);
        $allAsset->update();

        return redirect('/all-assets');

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\AllAsset  $allAsset
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $allAsset = AllAsset::findOrFail($id);

        $file = public_path("assets\images\allAsset\\".$allAsset->image);

       if (file_exists($file)) {
           @unlink($file);
       }

       $allAsset->delete();
    return redirect('/all-assets');
    }
}
