<?php

namespace App\Http\Controllers;

use App\Models\Comment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(){
        $attributes = request()->validate([
            'comment' => 'required',
            'post_id' => 'required',
            'user_id' => 'required'
        ]);

        Comment::create($attributes);
        return redirect('/posts/'.$attributes['post_id']);
    }

    public function destroy(Comment $comment){
        Auth::user()->can('delete', $comment);
        $attributes = request()->validate([
            'post_id' => 'required',
        ]);
        $comment->delete();
        return redirect('/posts/'.$attributes['post_id']);
    }

}
