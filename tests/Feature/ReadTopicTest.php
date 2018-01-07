<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ReadTopicTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function a_user_can_read_a_topic()
    {
        $topic = factory('App\Topic')->create([
            'user_id' => factory('App\User')->create()->id
        ]);

        $this->get('topic/'. $topic->slug)
            ->assertSee($topic->title)
            ->assertSee($topic->body);
    }

    /** @test */
    public function a_user_can_see_all_the_forum_topics()
    {
        $forum = factory('App\Forum')->create();
        $topics = factory('App\Topic', 2)->create([
            'forum_id' => $forum->id,
            'user_id' => factory('App\User')->create()->id
        ]);

        $this->get('forum/'.$forum->slug)
            ->assertSee($topics[0]->title)
            ->assertSee($topics[1]->title);
    }
}
