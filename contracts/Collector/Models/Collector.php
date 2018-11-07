<?php

namespace Vetor\Contracts\Collect\Collector\Models;

use Illuminate\Database\Eloquent\Builder;
use Vetor\Contracts\Collect\Collectable\Models\Collectable;
use Vetor\Contracts\Collect\Collectable\Models\Collectable as CollectableContract;

interface Collector
{
    /**
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $likeable
     * @return mixed
     */
    public function collect(Collectable $likeable);

    /**
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $likeable
     * @return mixed
     */
    public function cancelCollect(Collectable $likeable);
}
