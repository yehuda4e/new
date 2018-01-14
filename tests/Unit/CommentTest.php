<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_belongs_to_a_user()
    {
        $comment = factory(\App\Comment::class)->create();

        $this->assertInstanceOf(\App\User::class, $comment->user);
    }

    /** @test */
    public function guests_can_not_interact_with_comments()
    {
        // Create
        $this->post('/comment/1')
            ->assertRedirect('/login');
        // Like
        $this->get('comment/1/like')
            ->assertRedirect('/login');
        // Unlike
        $this->get('comment/1/unlike')
            ->assertRedirect('/login');
        // Edit
        $this->patch('comment/1')
            ->assertRedirect('/login');
    }

    /** @test */
    public function when_a_comment_deletes_it_delete_all_its_associated_relations()
    {
        $this->be(factory('App\User')->create());

        $comment = factory('App\Comment')->create(['user_id' => auth()->id()]);
        $reply = $comment->replies()->create(['body' => 'test', 'user_id' => auth()->id()]);
        $edit = $comment->edits()->create(['body' => 'test', 'user_id' => auth()->id()]);
        $like = $comment->likes()->create(['user_id' => auth()->id()]);

        $this->assertDatabaseHas('comments', $reply->toArray())
            ->assertDatabaseHas('edits', $edit->toArray())
            ->assertDatabaseHas('likes', $like->toArray());

        $this->delete('/comment/'.$comment->id);

        $this->assertDatabaseMissing('comments', $reply->toArray())
            ->assertDatabaseMissing('edits', $edit->toArray())
            ->assertDatabaseMissing('likes', $like->toArray());
    }

    /** @test */
    public function a_comment_can_be_liked()
    {
        $this->be(factory('App\User')->create());

        $comment = factory('App\Comment')->create();

        $comment->like();

        $this->assertCount(1, $comment->likes);
    }

    /** @test */
    public function a_comment_can_be_unliked()
    {
        $this->be(factory('App\User')->create());

        $comment = factory('App\Comment')->create();

        $comment->like();
        $comment->unlike();

        $this->assertCount(0, $comment->likes);
    }

    /** @test */
    public function an_authenticated_user_can_reply_on_a_comment()
    {
        $this->be(factory('App\User')->create());
        $comment = factory('App\Comment')->create();
        $reply = $comment->replies()->make(['body' => 'test']);

        $this->post('/comment/'.$comment->id, ['reply' => 'test']);
        $this->assertDatabaseHas('comments', $reply->toArray());
    }

    /** @test */
    public function an_authorized_user_can_edit_the_comment()
    {
        $user = factory('App\User')->create();
        $this->be($user);

        $article = factory('App\Article')->create();
        $comment =  $article->comments()->create([
            'body' => 'original',
            'user_id' => auth()->id()
        ]);

        $this->patch('comment/'.$comment->id, ['comment' => 'updetedtest']);
        $this->get($article->slug)
            ->assertSee('updetedtest')
            ->assertDontSee($comment->body);
    }
}
