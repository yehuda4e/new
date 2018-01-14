<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Likeable;

    protected $fillable = ['user_id', 'body'];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($comment) {
            $comment->comments()->delete();
            $comment->likes()->delete();
            $comment->edits()->delete();
        });
    }

    public function commentable()
    {
        return $this->morphTo();
    }

    public function replies()
    {
        return $this->MorphMany(Comment::class, 'commentable');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function edits()
    {
        return $this->morphMany(Edit::class, 'editable');
    }

    public function getLikesCountAttribute()
    {
        return count($this->likes);
    }

    public function getEditsCountAttribute()
    {
        return count($this->edits);
    }
}
