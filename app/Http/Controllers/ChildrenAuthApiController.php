<?php

namespace App\Http\Controllers;

use App\Http\Resources\ChildrenAuthResource;
use App\Models\Children;
use App\Models\Graybeard;
use Illuminate\Database\QueryException;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChildrenAuthApiController extends Controller
{
    public function checkHaveOrNot($id)
    {
        try {
            Graybeard::findOrFail($id);
        } catch (\Exception $exception) {
            return response()->json(['message' => "Can't find parent code!", 'type' => 'error']);
        }
        return response()->json(['message' => 'Parent code already!', 'type' => 'success'], Response::HTTP_OK);
    }

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string|unique:childrens,email|email|max:255',
            'fullname' => 'required|string|max:255',
            'password' => 'required|string|min:8',
            'number_child' => 'required',
            'graybeard_id' => 'required'
        ]);

        if ($validator->fails()) {
            return response()->json(['message' => $validator->errors()], Response::HTTP_UNPROCESSABLE_ENTITY);
        }

        $childrens = new Children;
        $childrens->email = $request->email;
        $childrens->fullname = $request->fullname;
        $childrens->password = Hash::make($request->password);
        $childrens->old = $request->old;
        $childrens->number_child = $request->number_child;
        $childrens->graybeard_id = $request->graybeard_id;
        $childrens->save();

        $token = $childrens->createToken('auth_token')->plainTextToken;

        return response()->json(['message' => 'Success Register', 'token' => $token, 'data' => $childrens], Response::HTTP_CREATED);
    }

    public function login(Request $request)
    {
        $user = Children::where('email', $request->email)->with('Graybeard')->firstOrFail();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Password incorected!'
            ], 401);
        }

        $token = $user->createToken('auth_token')->plainTextToken;

        return response()->json([
            'message' => 'success',
            'user' => new ChildrenAuthResource($user),
            'token' => $token
        ], Response::HTTP_CREATED);
    }

    public function logout(Request $request)
    {
        $children = $request->user();
        $children->currentAccessToken()->delete();

        return response()->json([
            'message' => 'Logout success!',
        ], Response::HTTP_OK);
    }

    public function updateProfile(Request $request, $id)
    {
        $children = Children::findOrFail($id);
        $children->update([
            'fullname' => $request->fullname,
            'old' => $request->old
        ]);

        return response()->json([
            'message' => 'Success save changed!',
        ], Response::HTTP_OK);
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childrens = Children::all();

        return response()->json(['message' => 'Success get all data', 'data' => $childrens], Response::HTTP_OK);
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
