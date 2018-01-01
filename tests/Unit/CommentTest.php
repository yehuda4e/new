<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class CommentTest extends TestCase
{
    use RefreshDatabase;
    
    /** @test */
    public function it_belongs_to_a_user() {
        $comment = factory(\App\Comment::class)->create();

        $this->assertInstanceOf(\App\User::class, $comment->user);
    }
}
