<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Post;
use App\BigComment;
use Illuminate\Support\Facades\Auth;
use App\Http\Requests;

class BigCommentController extends Controller
{
    public function postBigCommentPost(Request $request)
    {
        $post_id = $request['postId'];
        $this->validate($request, [
            'body' => 'required|max:1000'
        ]);
        $comment = new BigComment();
        $comment->body = $request['body'];
        $comment->post_id = $post_id;
        $message = 'There was an error';
        if ($request->user()->posts()->save($comment)) {
            $message = 'Post successfully created!';
        }
        return redirect()->route('dashboard')->with(['message' => $message]);
    }
}
