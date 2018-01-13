<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class DeleteArticle extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function user_can_delete_his_own_articles()
    {
        $user = factory('App\User')->create();
        $this->be($user);

        $article = factory('App\Article')->create(['user_id' => $user->id]);

        $comment = $article->comments()->create([
            'body' => 'test',
            'user_id' => $user->id
        ]);

        $edit = $article->edits()->create([
            'body' => 'test',
            'user_id' => $user->id
        ]);

        
        $this->delete($article->slug);
        
        $this->assertDatabaseMissing('articles', $user->articles->toArray());
        $this->assertDatabaseMissing('comments', $comment->toArray());
        $this->assertDatabaseMissing('edits', $edit->toArray());
    }

    /** @test */
    public function an_article_can_be_deleted_only_by_associated_user()
    {
        $user = factory('App\User')->create();
        $this->be(factory('App\User')->create());

        $article = factory('App\Article')->create(['user_id' => $user->id]);

        $this->delete($article->slug)
            ->assertStatus(403);

        $this->assertDatabaseHas('articles', $article->toArray());
    }
}
