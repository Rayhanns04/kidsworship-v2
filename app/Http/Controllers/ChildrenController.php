<?php

namespace App\Http\Controllers;

use App\Models\Children;
use App\Models\Graybeard;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ChildrenController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $childrens = Children::all();
        $graybeards = Graybeard::all();

        // Custome Variable
        $Title = "Children";
        $Action = "/childrens";

        return view('pages.children.index', compact('childrens', 'Title', 'Action', 'graybeards'));
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
            'old' => 'required|string',
            'number_child' => 'required|string',
            'graybeard_id' => 'required'
        ]);

        if ($validator->fails()) {
             return response()->json(['message' => 'invalid fields', 422, 'error' => $validator->errors()]);
        }

        $children = new Children;
        $children->email = $request->email;
        $children->fullname = $request->fullname;
        $children->password = bcrypt($request->password);
        $children->old = $request->old;
        $children->number_child = $request->number_child;
        $children->graybeard_id = $request->graybeard_id;
        $children->save();

        return redirect('childrens');

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\children  $children
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validator = Validator::make($request->all(), [
            'email' => 'required|string',
            'fullname' => 'required|string',
            'password' => 'required|string',
            'old' => 'required|string',
            'number_child' => 'required|string',
            'graybeard_id' => 'required'
        ]);

        if($validator->fails()) {
            return response()->json(['message' => 'invalid fields', 422, 'error' => $validator->errors()]);
        }

        $children = Children::findOrFail($id);
        $children->email = $request->email;
        $children->fullname = $request->fullname;
        $children->password = bcrypt($request->password);
        $children->old = $request->old;
        $children->number_child = $request->number_child;
        $children->graybeard_id = $request->graybeard_id;
        $children->update();

        return redirect('childrens');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\CommonTime  $commonTime
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $children = Children::findOrFail($id);
        $children->delete();

        return redirect('childrens');
    }
}
