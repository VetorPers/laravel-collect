<?php

namespace Vetor\Contracts\Collect\Collectable\Services;

use Vetor\Contracts\Collect\Collectable\Models\Collectable as CollectableContract;

interface CollectableService
{
    /**
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $collectable
     * @param $userId
     * @return mixed
     */
    public function addCollectionTo(CollectableContract $collectable, $userId);

    /**
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $collectable
     * @param $userId
     * @return mixed
     */
    public function removeCollectionFrom(CollectableContract $collectable, $userId);
}
