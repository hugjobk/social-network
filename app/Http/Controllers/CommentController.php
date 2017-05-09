<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Comment;
use App\Http\Requests;

class CommentController extends Controller
{
    public function postCommentPost(Request $request)
    {
        $post_id = $request['postId'];
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $comment = new Comment();
        $comment->body = $request['body'];
        $comment->post_id = $post_id;
        $message = 'There was an error';
        if ($request->user()->posts()->save($comment)) {
            $message = 'Post successfully created!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }
}
