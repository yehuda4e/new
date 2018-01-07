<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateTopicTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_users_canot_create_a_topic()
    {
        $this->get('/topic/create')
            ->assertRedirect('/login');

        $this->post('/topic')
            ->assertRedirect('/login');
    }

    /** @test */
    public function only_authenticated_user_may_create_a_topic()
    {
        $this->be(factory('App\User')->create());
        $topic = factory('App\Topic')->make([
            'title' => 'topic test',
            'slug' => 'topic-test',
            'body' => 'body test',
            'forum_id' => factory('App\Forum')->create()->id
        ]);

        $this->post('/topic', [
            'title' => $topic->title,
            'slug' => $topic->slug,
            'body' => $topic->body,
            'forum' => $topic->forum_id
        ])->assertRedirect('/topic/'.$topic->slug);

        $this->get('/topic/'.$topic->slug)
        ->assertSee($topic->title)
        ->assertSee($topic->body);
    }
}
