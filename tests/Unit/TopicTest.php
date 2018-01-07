<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class TopicTest extends TestCase
{
    use RefreshDatabase;

    // public function __construct() {
    //     parent::setUp();

    //     $this->topic =
    // }

    /** @test */
    public function a_topic_belongs_to_a_forum()
    {
        $forum = factory('App\Forum')->create();
        $topic = factory('App\Topic')->create(['forum_id' => $forum->id]);

        $this->assertInstanceOf('App\Forum', $topic->forum);
    }

    /** @test */
    public function a_topic_belongs_to_a_user()
    {
        $user = factory('App\User')->create();
        $topic = factory('App\Topic')->create(['user_id' => $user->id]);

        $this->assertInstanceOf('App\User', $topic->user);
    }

    /** @test */
    public function a_topic_has_comments()
    {
        $topic = factory('App\Topic')->create();
        $comment = $topic->comments()->create([
            'title' => 'test',
            'body' => 'test',
            'user_id' => 1
        ]);

        $this->assertInstanceOf('App\Comment', $comment);
    }
}
