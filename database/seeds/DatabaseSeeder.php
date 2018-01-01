<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $articles = factory(App\Article::class, 3)->create();
        $articles->each(function ($article) {
            factory(App\Comment::class, 3)->create(['commentable_id' => $article->id]);
        });

        $forumCategories = factory(App\ForumCategory::class, 3)->create();
        $forumCategories->each(function ($category) {
            $forums = factory(App\Forum::class, 2)->create(['category_id' => $category->id]);

            $forums->each(function ($forum) {
                $topics = factory(App\Topic::class, 5)->create(['forum_id' => $forum->id]);

                $topics->each(function ($topic) {
                    factory(App\Comment::class, 5)->create([
                            'commentable_id' => $topic->id,
                            'commentable_type' => 'App\Topic'
                        ]);
                });
            });
        });
    }
}
