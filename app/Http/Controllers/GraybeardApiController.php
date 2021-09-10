<?php

namespace App\Http\Controllers;

use App\Http\Resources\GCResource;
use App\Http\Resources\GraybeardChildrenResource;
use App\Http\Resources\GraybeardPrayerResource;
use App\Http\Resources\GraybeardResource;
use App\Models\Children;
use App\Models\Graybeard;
use App\Models\Prayer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class GraybeardApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($id)
    {
        $graybeard = Graybeard::findOrFail($id);
        return response()->json(['message' => 'Success get all Prayer from this parent', 'data' =>  GraybeardPrayerResource::collection($graybeard->Prayers()->where('prayers.created_at', '>=', Carbon::now())->get())],  Response::HTTP_OK);
    }

    public function eachChildren($id)
    {
        $graybeard = Graybeard::find($id);
        return response()->json(['message' => 'Success get children from this parent with prayers', 'data' => GCResource::collection($graybeard->Childrens)],  Response::HTTP_OK);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
