<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Like extends Model
{
    protected $guarded = [];

    public function likeable()
    {
        return $this->morphTo();
    }

    public function ScopeHasLiked($query)
    {
        return $query->where(['user_id' => auth()->id()])->exists();
    }
}
