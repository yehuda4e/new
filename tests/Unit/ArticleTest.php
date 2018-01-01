<?php

namespace Tests\Unit;

use Tests\TestCase;
use Illuminate\Foundation\Testing\RefreshDatabase;

class ArticleTest extends TestCase
{
    use RefreshDatabase;

    protected $article;

    public function setUp() {
        parent::setUp();

        $this->article = factory('App\Article')->create();
    }

    /** @test */
    public function an_article_has_a_creator() {
        $this->assertInstanceOf('App\user', $this->article->user);
    }

    /** @test */
    public function an_article_belongs_to_category() {
        $this->assertInstanceOf('App\Category', $this->article->category);
    }

    /** @test */
    public function an_article_has_comment() {
        $this->assertInstanceOf('Illuminate\Database\Eloquent\Collection', $this->article->comments);
    }

    
    
}
