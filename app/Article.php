<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    /**
     * Fillable fields
     *
     * @var array
     */
    protected $fillable = ['title', 'slug', 'body', 'category_id', 'user_id'];

    /**
     * Set the amount of articles per page for the pagination.
     *
     * @var integer
     */
    public $perPage = 3;

    /**
     * User relationship
     *
     * @return User
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    /**
     * Category relationship
     *
     * @return Category
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * Comment relationship
     *
     * @return Comment
     */
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    /**
     * Edits relationship
     *
     * @return Edit
     */
    public function edits()
    {
        return $this->morphMany(Edit::class, 'editable');
    }

    /**
     * Set the route key name as 'slug'
     *
     * @return void
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    /**
     * A mutator for gettings the views from Redis.
     *
     * @return Redis | 0
     */
    public function getViewsAttribute()
    {
        return \Redis::get("article.$this->id.views") ?? 0;
    }
}
