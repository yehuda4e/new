<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadArticlesTest extends TestCase
{
    use RefreshDatabase;

    protected $article;

    public function setUp() {
        parent::setUp();

        $this->article = factory('App\Article')->create();
    }
    
    /** @test */
    public function a_user_can_view_all_articles() {
        $this->get('/')
            ->assertSee($this->article->title);
    }
    
    /** @test */
    public function a_user_can_view_a_single_article() {
        $this->get($this->article->slug)
            ->assertSee($this->article->title)   
            ->assertSee($this->article->body);   
    }
    
    /** @test */
    public function article_has_comments() {
        $this->article->each(function($article) {
            $this->comments = factory('App\Comment', 3)->create(['commentable_id' => $article->id]);
        });

        $this->get($this->article->slug)
            ->assertSee($this->comments[0]->body)
            ->assertSee($this->comments[1]->body);
    }

    /** @test */
    public function unauthenticated_user_may_not_add_a_comment() {
        $this->post($this->article->slug.'/comment', [])
            ->assertRedirect('/login');
        
    }

    /** @test */
    public function an_authenticated_user_may_comment_on_the_article() {
        $user = factory('App\User')->create();
        $this->be($user);

        $comment = factory('App\Comment')->make();

        $this->post($this->article->slug . '/comment', $comment->toArray());

        $this->get($this->article->slug)
            ->assertSee($comment->body);
    }

}
