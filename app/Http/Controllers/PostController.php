<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Validator;

class PostController extends Controller
{
    public function createpost(Request $request){
        $validator = Validator::make($request->all(), [
            'author' => 'required|min:1',
            'title' => 'required|min:3',
            'body' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>'error','errors'=>$validator->errors()]);
        }
        
        $post=new Post;
        $post->author=$request->author;
        $post->title=$request->title;
        $post->body=$request->body;
        $post->save();
        return response()->json(['status'=>'success','data'=>$post]);
    }

    public function getposts(){
        $comments=Post::with('comments')->paginate(3);
        return response()->json(['status'=>'success','data'=>$comments]);
    }

    public function updatepost(Request $request, $postid){
        $validator = Validator::make($request->all(), [
            'title' => 'required|min:3',
            'body' => 'required|min:3',
        ]);

        if ($validator->fails()) {
            return response()->json(['status'=>'error','errors'=>$validator->errors()]);
        }
        
        $post=Post::find($postid);
        $post->title=$request->title;
        $post->body=$request->body;
        $post->save();
        return response()->json(['status'=>'success','data'=>$post]);
    }

    public function deletepost($postid){
        $post=Post::find($postid);
        if($post->delete());
        {
        return response()->json(['status'=>'success','data'=>$post]);
        }
    }
}
