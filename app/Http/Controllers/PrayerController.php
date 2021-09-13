<?php

namespace App\Http\Controllers;

use App\Http\Resources\PrayerResource;
use App\Models\Prayer;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Validator;

class PrayerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $prayers = Prayer::with('commonTime', 'Children')->get();

        return response()->json(['message' => 'success get all prayers', 'data' => PrayerResource::collection($prayers)]);
    }

    /**
     * Display a listing of the resource have filtered.
     *
     */

    public function getPrayer($id)
    {
        $prayer = Prayer::where('children_id', $id)->whereDate('created_at', '>=', Carbon::now())->get();

        return response()->json(['message' => 'success get all prayers', 'data' => PrayerResource::collection($prayer)], Response::HTTP_OK);
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
        $validator = Validator::make($request->all(), [
            'name' => 'string|required',
            'description' => 'required|string',
            'children_id' => 'required',
            'common_time_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $time = Carbon::now();
        $timeCarbon = $time->isoFormat('HH:mm');

        $dateCarbon = $time->format('F Y');

        $prayer = new Prayer;
        $prayer->name = $request->name;
        $prayer->description = $request->description;
        // $prayer->all_asset_id = $request->all_asset_id;
        $prayer->children_id = $request->children_id;
        $prayer->common_time_id = $request->common_time_id;
        $prayer->created_time = $timeCarbon;
        $prayer->date = $dateCarbon;
        $prayer->save();

        return response()->json(['message' => 'Success created', 'data' => $prayer], Response::HTTP_OK);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Prayer  $prayer
     * @return \Illuminate\Http\Response
     */
    public function show(Prayer $prayer)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Prayer  $prayer
     * @return \Illuminate\Http\Response
     */
    public function edit(Prayer $prayer)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Prayer  $prayer
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Prayer $prayer)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Prayer  $prayer
     * @return \Illuminate\Http\Response
     */
    public function destroy(Prayer $prayer)
    {
        //
    }
}
