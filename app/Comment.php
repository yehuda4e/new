<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use Likeable;

    protected $fillable = ['user_id', 'body'];

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

    public function getLikesCountAttribute()
    {
        return count($this->likes);
    }
}
