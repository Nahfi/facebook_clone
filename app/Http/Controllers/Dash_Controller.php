<?php

namespace App\Http\Controllers;

use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;

class Dash_Controller extends Controller
{
   public function dash(){
       $all=Post::orderByDesc('created_at',)->get();
     
       $p=array();
       foreach($all as $a){

       



        $p[]=[
         "id"=>$a->id,
         "post"=>$a->post,
         "photo"=>$a->photo,
         "like"=>count(json_decode($a->like))?? 0,
         "share"=>count(json_decode($a->share))?? 0,
         "comment"=>($a->comment),
         "date"=>date("F j, Y, g:i a",strtotime($a->created_at)),
         "info"=>Post::find($a->id)->use,
         "com"=>Post::find($a->id)->post_comment
         
        ];
 
       
       }
    

       return view("dashboard",compact("p"));
   }
   public function like(Request $x){
// dd($x->d);
      
$pid=$x->d;
if($pid){


    $post=Post::find($pid);
    // dd($post);
    $like=json_decode($post->like,true);
   if(in_array(auth()->user()->id,$like)){
     $like= array_diff($like,[auth()->user()->id]);
    
     $post->like=json_encode($like);
     $post->save();
     return json_encode([


        "success"=> true,
        "data"=>-1
    
    ]);
   }
else{
  array_push($like,auth()->user()->id);
    // dd($like);
   $post->like=json_encode($like);
   $post->save();
   return json_encode([


    "success"=> true,
    "data"=>1

]);
}


}
else{
    return json_encode([


        "success"=> "no data"
    ]);
}


   }
}

