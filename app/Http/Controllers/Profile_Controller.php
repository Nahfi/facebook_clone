<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class Profile_Controller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view("settings");
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
      
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
    public function edit(Request $r , $id)
    {

  $f=$r->hasFile('image')?$r->file('image'):null;
  $loc="/images/upload/";
  $ex=$f->getClientOriginalExtension();
  $name="user_id".$id.".".$ex;

  $f->move(public_path().$loc,$name);

  User::find($id)->update([

     "photo"=>$loc.$name

  ]);
  return back();


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
      $name=$request->get('x');
      $f=$request->get('field_name');
      if($f=='birth_date'){

        $name=date('y-m-d',strtotime($name));

      }
      if($f=='sex'){

      if($name="male"){
          $name=0;
      }
      else{
        $name=1; 
      }

      }

      $hit=config('app.col.'.$f);
      User::find($id)->update([

        $hit=>$name

      ]);


      return back();


    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
      
    }
}
