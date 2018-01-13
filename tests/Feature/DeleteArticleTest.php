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
        $this->delete($article->slug);

        $this->assertCount(0, $user->articles);
    }

    /** @test */
    public function an_article_can_be_deleted_only_by_associated_user()
    {
        $user = factory('App\User')->create();
        $this->be(factory('App\User')->create());

        $article = factory('App\Article')->create(['user_id' => $user->id]);

        $this->delete($article->slug)
            ->assertStatus(302);
        
        $this->assertCount(1, $user->articles);
    }
}
