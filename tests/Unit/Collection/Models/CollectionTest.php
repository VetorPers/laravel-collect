<?php

namespace Vetor\Tests\Collect\Unit\Collection\Models;

use Vetor\Tests\Collect\TestCase;
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
}
