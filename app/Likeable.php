<?php
namespace App;

trait Likeable
{
    public function likes()
    {
        return $this->morphMany(Like::class, 'likeable');
    }

    public function like()
    {
        if (!$this->likes()->where('user_id', auth()->id())->exists()) {
            $this->likes()->create([
                'user_id' => auth()->id(),
            ]);
        }
    }

    public function unlike()
    {
        $this->likes()->where('user_id', auth()->id())->delete();
    }

    public function hasLiked()
    {
        return !! $this->likes->where('user_id', auth()->id())->count();
    }
}
