<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ForumCategory extends Model
{
    protected $withCount= ['forums'];
    
    public function forums()
    {
        return $this->hasMany(Forum::class, 'category_id');
    }

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
