<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{
    use  RefreshDatabase;

    /** @test */
    public function guests_can_not_like_comments()
    {
        $this->get('/comment/1/like')
            ->assertRedirect('/login');

        $this->get('/comment/1/unlike')
            ->assertRedirect('/login');
    }

    /** @test */
    public function user_can_only_like_once()
    {
        $user = factory('App\User')->create();
        $this->be($user);

        $comment = factory('App\Comment')->create(['commentable_type' => 'App\Comment']);

        $comment->like();
        $comment->like();

        $this->assertCount(1, $comment->likes);
    }

    /** @test */
    public function user_can_unlike()
    {
        $user = factory('App\User')->create();
        $this->be($user);

        $comment = factory('App\Comment')->create(['commentable_type' => 'App\Comment']);

        $comment->like();
        $comment->unlike();
        
        $this->assertCount(0, $comment->likes);
    }

    /** @test */
    public function guests_can_not_like_topics()
    {
        $this->get('topic/slug/like')
            ->assertRedirect('/login');

        $this->get('topic/slug/unlike')
            ->assertRedirect('/login');
    }
}
