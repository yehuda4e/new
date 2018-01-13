<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ProfileTest extends TestCase
{
    use RefreshDatabase;

    protected $user;

    public function setUp()
    {
        parent::setUp();

        $this->user = factory('App\User')->create();
    }

    /** @test */
    public function a_user_has_a_profile()
    {
        $this->get('/user/'.$this->user->username)
            ->assertSee($this->user->username);
    }

    /** @test */
    public function profiles_display_all_articles_created_by_the_associated_user()
    {
        $articles = factory('App\Article', 2)->create(['user_id' => $this->user->id]);

        $this->get('/user/'.$this->user->username)
            ->assertSee($articles[0]->title)
            ->assertSee($articles[1]->title);
    }

    /** @test */
    public function profiles_display_all_topics_created_by_the_associated_user()
    {
        $topics = factory('App\Topic', 2)->create(['user_id' => $this->user->id]);

        $this->get('/user/'.$this->user->username)
            ->assertSee($topics[0]->title)
            ->assertSee($topics[1]->title);
    }

    /** @test */
    public function profiles_display_all_comments_created_by_the_associated_user()
    {
        $article = factory('App\Article')->create();
        $comments = factory('App\Comment', 2)->create([
            'user_id' => $this->user->id,
            'commentable_id' => $article->id,
            'commentable_type' => get_class($article)
        ]);

        $this->get('/user/'.$this->user->username)
            ->assertSee($comments[0]->body)
            ->assertSee($comments[1]->body);
    }
}
