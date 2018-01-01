<?php

namespace App\Http\Controllers;

use App\Topic;
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
        $this->validate(request(), [
            'title' => 'required|min:2|max:255',
            'forum' => 'required|exists:forums,id',
            'body' => 'required|min:3|max:4000'
        ]);

        $newTopic = Topic::create([
            'title' => request('title'),
            'slug' => str_slug(request('title')), //FIX
            'forum_id' => request('forum'),
            'user_id' => auth()->id(),
            'body' => request('body')
        ]);

        return redirect('/forum');
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
            'body' => 'required|min:2|max:255'
        ]);

        $topic->comments()->create([
            'body' => request('body'),
            'user_id' => auth()->id(),
        ]);

        // We updating this property, becuse we sorting the topics by this.
        // So everytime a new comment posted, this will be updated, and the topic will jump to the top.
        $topic->update(['updated_at' => Carbon::now()]);

        return back();
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function edit(Topic $topic)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Topic  $topic
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Topic $topic)
    {
        //
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
