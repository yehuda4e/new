<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class EditArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function an_article_can_be_edited_only_by_the_author()
    {
        $user = factory('App\User')->create();
        $this->be($user);
        $article = factory('App\Article')->create(['user_id' => $user->id]);

        $this->get($article->slug.'/edit')
            ->assertStatus(200)
            ->assertSee($article->title)
            ->assertSee($article->body)
            ->assertSee($article->category->name);

        $this->patch($article->slug, [
            'title' => 'new title',
            'slug' => $article->slug,
            'body' => 'hello',
            
            'category' => $article->category->id
        ]);

        $this->get($article->slug)
            ->assertSee('new title')
            ->assertSee('hello')
            ->assertDontSee($article->body);
    }
}
