<?php

namespace Vetor\Tests\Collect\Unit\Collector\Models\Traits;

use Vetor\Tests\Collect\TestCase;
use Vetor\Tests\Collect\Stubs\Models\User;
use Vetor\Tests\Collect\Stubs\Models\Article;

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
}
