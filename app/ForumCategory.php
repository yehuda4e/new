<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    public function forums()
    {
        return $this->hasMany(Forum::class, 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'name';
    }
}
