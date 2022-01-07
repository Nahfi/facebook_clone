<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

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
  
$request->validate([
    "post"=>"required|max:400",
    "id"=>"required",
    "image"=>"mimes:png,jpg,jepg,gif|max:1000000"
]);

$loc="/images/post/photo/";
// $im=$request->hasFile("image")?$request->file("image"):"avatar.jpg";
if($request->hasFile("image"))
{
    $im=$request->file("image");
    $e=$im->getClientOriginalExtension();
    $name="post_photo_".time().".".$e;
    $im->move(public_path().$loc,$name);

}
else{
    $name="avtar.jpg";
}

$x= new Post();
$x->post=$request->post;
$x->user_id=$request->id;
$x->like=json_encode(array());
$x->share=json_encode(array()); 
$x->photo=$loc.$name;
$x->save();
return redirect()->route("dashboard");

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function show( $id)
    {
        $x=User::find($id);
        return view('userprofile',compact('x'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function edit(Post $post)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Post $post)
    {
 
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Post  $post
     * @return \Illuminate\Http\Response
     */
    public function destroy(Post $post)
    {
        //
    }
}
