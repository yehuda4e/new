<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function unauthenticated_users_canot_create_an_article()
    {
        $this->get('/article/create')
            ->assertRedirect('/login');

        $this->post('/article')
            ->assertRedirect('/login');
    }

    /** @test */
    public function only_authenticated_users_may_create_an_article()
    {
        $this->be(factory('App\User')->create());
        $article = factory('App\Article')->make([
            'title' => 'article test',
            'slug' => 'article-test',
            'body' => 'body test',
        ]);

        $this->post('/article', [
            'title' => $article->title,
            'slug' => $article->slug,
            'body' => $article->body,
            'category' => $article->category_id
        ])->assertRedirect($article->slug);

        $this->get($article->slug)
        ->assertSee($article->title)
        ->assertSee($article->body);
    }
}
