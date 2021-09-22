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

        return response()->json(['message' => 'Success get all Prayer from this parent', 'data' =>  GraybeardPrayerResource::collection($graybeard->Prayers()->where('prayers.created_at', '>=', Carbon::today())->where('prayers.created_at', '<', Carbon::tomorrow())->get())],  Response::HTTP_OK);
    }

    public function eachChildren($id)
    {
        $graybeard = Graybeard::find($id);
        return response()->json(['message' => 'Success get children from this parent with prayers', 'data' => GCResource::collection($graybeard->Childrens)],  Response::HTTP_OK);
    }
}
