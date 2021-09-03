<?php

namespace App\Http\Controllers;

use App\Models\AllAsset;
use App\Models\CommonTime;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class CommonTimeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $commonTimes = CommonTime::all();
        $allAssets = AllAsset::all();

        // Custome Variable
        $Title = "Common Times";
        $Action = "/common-times";

        return view('pages.common.index', compact('commonTimes', 'Title', 'Action', 'allAssets'));
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
            'name' => 'required|string',
            'start' => 'required|string',
            'end' => 'required|string',
            'asset_id' => 'required'
        ]);

        if ($validator->fails()) {
             return response()->json(['message' => 'invalid fields', 422, 'error' => $validator->errors()]);
        }

        $commonTime = new CommonTime;
        $commonTime->name = $request->name;
        $commonTime->startTime = $request->start;
        $commonTime->endTime = $request->end;
        $commonTime->all_asset_id = $request->asset_id;
        $commonTime->save();

        return redirect('common-times');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\CommonTime  $commonTime
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required|string',
            'start' => 'required|string',
            'end' => 'required|string',
            'asset_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422, 'error' => $validator->errors()]);
        }

        $commonTime = CommonTime::findOrFail($id);
        $commonTime->name = $request->name;
        $commonTime->startTime = $request->start;
        $commonTime->endTime = $request->end;
        $commonTime->all_asset_id = $request->asset_id;
        $commonTime->update();

        return redirect('common-times');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommonTime  $commonTime
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $commonTime = CommonTime::findOrFail($id);
        $commonTime->delete();

        return redirect('common-times');
    }
}
