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
    public function index()
    {
        $prayers = Prayer::with('commonTime', 'Children')->get();

        return response()->json(['message' => 'success get all prayers', 'data' => PrayerResource::collection($prayers)]);
    }

    public function getPrayer($id)
    {
        $prayer = Prayer::where('children_id', $id)->whereDate('created_at', '>=', Carbon::now())->get();

        return response()->json(['message' => 'success get all prayers', 'data' => PrayerResource::collection($prayer)], Response::HTTP_OK);
    }

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

        $dateCarbon = $time->format('Y/m/d');

        $prayerVerification = Prayer::where('name', $request->name)->whereDate('created_at', Carbon::today())->get();
        // dd($prayerVerification->count());

        if ($prayerVerification->count() != 0) {
            return response()->json(['message' => 'Item is already!'], Response::HTTP_CONFLICT);
        }

        $prayer = new Prayer;
        $prayer->name = $request->name;
        $prayer->description = $request->description;
        // $prayer->all_asset_id = $request->all_asset_id;
        $prayer->children_id = $request->children_id;
        $prayer->common_time_id = $request->common_time_id;
        $prayer->created_time = $timeCarbon;
        $prayer->date = $dateCarbon;
        $prayer->month = Carbon::now()->format('F');
        $prayer->save();

        return response()->json(['message' => 'Success created', 'data' => $prayer], Response::HTTP_OK);
    }
}
