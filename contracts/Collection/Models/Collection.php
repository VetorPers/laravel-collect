<?php

namespace Vetor\Contracts\Collect\Collection\Models;

use Illuminate\Database\Eloquent\Builder;
use Vetor\Contracts\Collect\Collectable\Models\Collectable as CollectableContract;

interface Collection
{
    /**
     * @return mixed
     */
    public function collectable();
}
