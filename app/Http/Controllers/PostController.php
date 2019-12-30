<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\Posts;
use Auth;
use Validator;

class PostController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
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
        $status = "error";
        $message = "";
        $data = null;
        $code = 200;

        $validator = Validator::make($request->all(), [
            'title' => 'required',
            'content' => 'required',
            'image' => 'required',
        ]);
        if (!$validator->fails()) {
            $store = new Posts;
            $store->author_id = Auth::user()->id;
            $store->title = $request->title;
            $store->content = $request->content;
            $store->posted_at = now();

            $img = $request->file('image');
            if ($img) {
                $img_path = $img->store('post', 'public');
                $store->image = $img_path;
            }

            if($store->save()){
                $status = "success";
                $message = "Store Post Success";
                $data = $store->toArray();
            }
            else{
                $message = "Store Post Failed";
            }
        }else {
            $errors = $validator->errors();
            $message = $errors;
        }

        return response()->json([
            'status' => $status,
            'message' => $message,
            'data' => $data
        ], $code);
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