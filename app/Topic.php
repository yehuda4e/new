<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Topic extends Model
{
    protected $guarded = [];

    protected $perPage = 10;

    public function forum()
    {
        return $this->belongsTo(Forum::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->MorphMany(Comment::class, 'commentable');
    }

    public function edits()
    {
        return $this->morphMany(Edit::class, 'editable');
    }

    public function lastComment()
    {
        return $this->comments()->with('user')->latest()->first() ?? $this;
    }

    public function getViewsAttribute()
    {
        return \Redis::get("topic.{$this->id}.views") ?? 0;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
