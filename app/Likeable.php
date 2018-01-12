<?php
namespace App;

trait Likeable
{
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
            $this->likes()->where(['user_id' => auth()->id()])->delete();
        }
    }
}
