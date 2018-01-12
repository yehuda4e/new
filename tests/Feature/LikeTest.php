<?php

namespace Tests\Feature;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class LikeTest extends TestCase
{
    use  RefreshDatabase;

    /** @test */
    public function guests_can_not_like_thing()
    {
        $this->post('/comment/1/likde')
            ->assertRedirect('/login');
    }
}
