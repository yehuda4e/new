<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $fillable = ['user_id', 'body'];

    protected $withCount = ['likes'];

    public function commentable()
    {
        return $this->morphTo();
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function edits()
    {
        return $this->morphMany(Edit::class, 'editable');
    }

    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
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
