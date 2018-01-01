<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function topics()
    {
        return $this->hasMany(Topic::class);
    }

    public function comments()
    {
        return $this->hasManyThrough(Comment::class, Topic::class, 'forum_id', 'commentable_id')->where('comments.commentable_type', 'App\Topic');
    }

    public function LastActivity()
    {
        $lastTopic = $this->topics()->with('user')->latest()->first() ?? false;
        $lastComment = $this->comments()->with('user')->latest()->first() ?? false;

        // check if there are a topics and also comments, and who will show
        if ($lastTopic && $lastComment) {
            return ($lastTopic->created_at > $lastComment->created_at) ? $lastTopic : $lastComment;
            // if there are only topics
        } elseif ($lastTopic) {
            return $lastTopic;
        }

        return false;
    }

    public function lastActivityUrl()
    {
        // This check is because we access for the $lastComment and also the commentable method
        if ($this->lastActivity() instanceof Comment) {
            return $this->lastActivity()->commentable;
        }

        return $this->lastActivity();
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
