<?php

namespace App\Http\Controllers;

use App\Comment;

class CommentController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function store(Comment $comment)
    {
        $this->validate(request(), [
            'reply' => 'required|max:120'
        ]);

        $comment->replies()->create([
            'body' => request('reply'),
            'user_id' => auth()->id()
        ]);

        return back();
    }

    public function update(Comment $comment)
    {
        $this->authorize('update', $comment);

        $this->validate(request(), [
            'comment' => 'required:min:3|max:120'
        ]);

        $comment->edits()->create([
            'body' => request('comment'),
            'user_id' => auth()->id()
        ]);

        return back()->with('info', 'Your comment updated succesfuly');
    }

    public function destroy(Comment $comment)
    {
        $this->authorize('delete', $comment);

        $comment->delete();

        return back()->with('info', 'your comment deleted successfuly');
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
