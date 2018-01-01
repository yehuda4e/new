<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CreateArticleTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function only_authenticated_users_may_create_an_article() {
        $this->get('article/create')
            ->assertRedirect('/login');

        $user = factory('App\User')->create();
        $this->be($user);

        // $this->post('article', [
        //     'title' => 'test',
        //     'slug' => 'test',
        //     'category_id' => 1,
        //     'user_id' => $user->id,
        //     'body' => 'test'
        // ]);

        // $this->get('test')
        //     ->assertSee('test');
    }
}
