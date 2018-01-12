<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Forum extends Model
{
    protected $withCount = ['topics', 'comments'];

    public function category()
    {
        return $this->belongsTo(ForumCategory::class);
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
        $lastTopic = $this->topics->last();
        $lastComment = $this->comments->last();

        // Check if there are topics and also comments on the forun.
        if ($this->topics_count && $this->comments_count) {
            return ($lastTopic->created_at > $lastComment->created_at) ? $lastTopic : $lastComment;
        }

        // Check if there are topics.
        if ($this->topics_count) {
            return $lastTopic;
        }

        // return false if the forum is empty.
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
