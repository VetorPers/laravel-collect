<?php

namespace Vetor\Tests\Collect\Unit\Collectable\Models\Traits;

use Vetor\Tests\Collect\TestCase;
use Vetor\Tests\Collect\Stubs\Models\User;
use Vetor\Tests\Collect\Stubs\Models\Article;

class CollectableTest extends TestCase
{
    /** @test */
    public function it_can_collect_collectable()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();

        $article->collect($user);

        $this->assertDatabaseHas('collections', [
            'user_id'          => $user->id,
            'collectable_type' => $article->getMorphClass(),
            'collectable_id'   => $article->id,
        ]);
    }

    /** @test */
    public function it_can_cancel_collect_collectable()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();

        $article->collect($user);
        $article->cancelCollect($user);

        $this->assertSoftDeleted('collections', [
            'user_id'          => $user->id,
            'collectable_type' => $article->getMorphClass(),
            'collectable_id'   => $article->id,
        ]);
    }

    /** @test */
    public function it_can_get_collections_count()
    {
        $article = factory(Article::class)->create();
        $users = factory(User::class, 3)->create();

        foreach ($users as $user) {
            $article->collect($user);
        }

        $this->assertEquals(3, $article->collections_count);
        $this->assertEquals(3, $article->collections()->count());
    }

    /** @test */
    public function it_can_orderby_collections_count()
    {
        $articles = factory(Article::class, 3)->create();
        $users = factory(User::class, 3)->create();

        $articles[0]->collect($users[0]);
        $articles[0]->collect($users[1]);
        $articles[0]->collect($users[2]);

        $articles[1]->collect($users[0]);
        $articles[1]->collect($users[1]);

        $articles[2]->collect($users[0]);

        $sorted_articles = Article::orderByCollectionsCount()->get();
        $desc_sorted_articles = Article::orderByCollectionsCount('desc')->get();

        $this->assertEquals($articles[2]['id'], $sorted_articles[0]['id']);
        $this->assertEquals($articles[1]['id'], $sorted_articles[1]['id']);
        $this->assertEquals($articles[0]['id'], $sorted_articles[2]['id']);
        $this->assertEquals($articles[0]['id'], $desc_sorted_articles[0]['id']);
        $this->assertEquals($articles[1]['id'], $desc_sorted_articles[1]['id']);
        $this->assertEquals($articles[2]['id'], $desc_sorted_articles[2]['id']);
    }
}
