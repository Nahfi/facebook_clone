<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use App\Models\Post;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function comment(Request $r)
    {
       $user_id=auth()->user()->id;
       $comment=$r->comment??" ";
       $post_id=$r->post_id??" ";


       $m=new comment();
       $m->post_id=$post_id;
       $m->user_id=$user_id;
       $m->comment=$comment;
       $m->save();
       

       $find=Post::find($post_id)->increment("comment");

       return redirect()->back();
   
      
    }
}
