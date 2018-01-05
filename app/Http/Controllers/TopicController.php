<?php

namespace App\Http\Controllers;

use App\Topic;
use App\Comment;
use Carbon\Carbon;

class TopicController extends Controller
{
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('topic.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->merge([
            'slug' => preg_replace(['/\s+/', '/(-{2,})/'], ['-', '-'], request('title'))
        ]);

        
        $this->validate(request(), [
            'title' => 'required|min:3|max:255',
            'slug' => 'alpha_dash|max:255|min:3|unique:topics,slug',
            'forum' => 'required|exists:forums,id',
            'body' => 'required|min:3|max:4000'
        ]);

        $newTopic = Topic::create([
            'title' => request('title'),
            'slug' => request('slug'),
            'forum_id' => request('forum'),
            'user_id' => auth()->id(),
            'body' => request('body')
        ]);

        return redirect('/forum')->with('info', 'You\'r topic created successfuly');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function show(Topic $topic)
    {
        \Redis::incr("topic.{$topic->id}.views");
        return view('topic.show', compact('topic'));
    }

    public function comment(Topic $topic)
    {
        $this->validate(request(), [
            'body' => 'required|min:2|max:4000'
        ]);

        $topic->comments()->create([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        // We updating this property, becuse we sorting the topics by this.
        // So everytime a new comment posted, this will be updated, and the topic will jump to the top.
        $topic->update(['updated_at' => Carbon::now()]);

        return back()->with('info', 'You\'r comment sent successfuly');
    }

    public function updateComment(Topic $topic, Comment $comment)
    {
        $this->validate(request(), [
            'edit' => 'required|min:2|max:4000'
        ]);


        $comment->edits()->create([
            'body' => request('edit'),
            'user_id' => auth()->id()
        ]);

        return back()->with('info', 'Your comment has been updated!');
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Topic $topic)
    {
        $this->validate(request(), [
            'edit' => 'required|min:2|max:4000'
        ]);

        $topic->edits()->create([
            'body' => request('edit'),
            'user_id' => auth()->id()
        ]);

        return back()->with('info', 'Your comment has been updated!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function destroy(Topic $topic)
    {
        //
    }
}
