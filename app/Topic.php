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

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function lastComment()
    {
        return $this->comments->last() ?? $this;
    }

    public function getViewsAttribute()
    {
        return \Redis::get("topic.{$this->id}.views") ?? 0;
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function like()
    {
        if (!$this->likes()->where(['user_id' => auth()->id()])->exists()) {
            $this->likes()->create([
                'user_id' => auth()->id(),
            ]);
        }
    }

    public function unlike()
    {
        if ($this->likes()->where(['user_id' => auth()->id()])->exists()) {
            $this->likes()->delete();
        }
    }
}
