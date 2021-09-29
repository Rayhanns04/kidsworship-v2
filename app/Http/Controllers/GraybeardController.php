<?php

namespace App\Http\Controllers;

use App\Models\Graybeard;
use Carbon\Carbon;
use Carbon\CarbonImmutable;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class GraybeardController extends Controller
{
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|unique:childrens,email|email|max:255',
            'fullname' => 'required|string|max:255',
            'password' => 'required|string|min:8',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $checkGraybeardAlready = Graybeard::where('email', $request->email)->firstOrFail();

        if ($checkGraybeardAlready) {
            return response()->json(['message' => 'Already!'], Response::HTTP_OK);
        }

        $graybeards = new Graybeard;
        $graybeards->email = $request->email;
        $graybeards->fullname = $request->fullname;
        $graybeards->password = Hash::make($request->password);
        $graybeards->save();

        $token = $graybeards->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Success Register', 'token' => $token, 'user' => $graybeards], Response::HTTP_OK);
    }

    public function login(Request $request)
    {
        $user = Graybeard::where('email', $request->email)->firstOrFail();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Password incorected!'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'success',
            'user' => $user,
            'token' => $token
        ],  Response::HTTP_OK);
    }

    public function logout(Request $request)
    {
        $graybeard = $request->user();
        $graybeard->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout success!',
        ],  Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $graybeards = Graybeard::all();

        // Custome Variable
        $Title = "Parents";
        $Action = "/graybeards";

        return view('pages.parent.index', compact('Title', 'Action', 'graybeards'));
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
            'email' => 'required|string',
            'fullname' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422, 'error' => $validator->errors()]);
        }

        $graybeard = new Graybeard;
        $graybeard->email = $request->email;
        $graybeard->fullname = $request->fullname;
        $graybeard->password = bcrypt($request->password);
        $graybeard->save();

        return redirect('graybeards');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\children  $graybeard
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'fullname' => 'required|string',
            'password' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422, 'error' => $validator->errors()]);
        }

        $graybeard = Graybeard::findOrFail($id);
        $graybeard->email = $request->email;
        $graybeard->fullname = $request->fullname;
        $graybeard->password = bcrypt($request->password);
        $graybeard->update();

        return redirect('graybeards');
    }

    public function destroy($id)
    {
        $graybeard = Graybeard::findOrFail($id);
        $graybeard->delete();

        return redirect('graybeards');
    }
}
