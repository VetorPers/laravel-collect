<?php

namespace Vetor\Tests\Collect\Unit\Collector\Models\Traits;

use Vetor\Tests\Collect\TestCase;
use Vetor\Tests\Collect\Stubs\Models\User;
use Vetor\Tests\Collect\Stubs\Models\Article;
use Vetor\Laravel\Collect\Collection\Models\Collection;

class CollectorTest extends TestCase
{
    /** @test */
    public function it_can_collect_collectable()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();

        $user->collect($article);

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

        $user->collect($article);
        $user->cancelCollect($article);

        $this->assertSoftDeleted('collections', [
            'user_id'          => $user->id,
            'collectable_type' => $article->getMorphClass(),
            'collectable_id'   => $article->id,
        ]);
    }

    /** @test */
    public function it_can_get_collections_where_collectable()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();

        $user->collect($article);
        $collections = $user->collectionsWhereCollectable(Article::class)->toArray();

        $article_collections = Collection::where('user_id', $user->id)
            ->where('collectable_type', $article->getMorphClass())
            ->get()->toArray();

        $this->assertEquals($article_collections, $collections);
    }
}
