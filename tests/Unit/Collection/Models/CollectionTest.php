<?php

namespace Vetor\Tests\Collect\Unit\Collection\Models;

use Vetor\Tests\Collect\TestCase;
use Vetor\Tests\Collect\Stubs\Models\User;
use Vetor\Tests\Collect\Stubs\Models\Article;
use Vetor\Laravel\Collect\Collection\Models\Collection;

class CollectionTest extends TestCase
{
    /** @test */
    public function it_can_fill_user_id()
    {
        $collection = new Collection([
            'user_id' => 1,
        ]);

        $this->assertEquals(1, $collection->user_id);
    }

    /** @test */
    public function it_can_get_collections_where_collectable()
    {
        $article = factory(Article::class)->create();
        $user = factory(User::class)->create();

        $user->collect($article);
        $collections = Collection::whereCollectable(Article::class)->get()->toArray();

        $article_collections = Collection::where('user_id', $user->id)
            ->where('collectable_type', $article->getMorphClass())
            ->get()->toArray();

        $this->assertEquals($article_collections, $collections);
    }
}
