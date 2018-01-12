<?php

namespace App\Http\Controllers;

use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
    
    public function like(Comment $comment)
    {
        $comment->like();

        return back();
    }

    public function unlike(Comment $comment)
    {
        $comment->unlike();

        return back();
    }
}
