<?php

namespace Vetor\Laravel\Collect\Collectable\Services;

use Vetor\Contracts\Collect\Collector\Exceptions\InvalidCollector;
use Vetor\Contracts\Collect\Collector\Models\Collector as CollectorContract;
use Vetor\Contracts\Collect\Collectable\Models\Collectable as CollectableContract;
use Vetor\Contracts\Collect\Collectable\Services\CollectableService as CollectableServiceContract;

class CollectableService implements CollectableServiceContract
{
    /**
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $collectable
     * @param $userId
     * @return mixed|void
     */
    public function addCollectionTo(CollectableContract $collectable, $userId)
    {
        $userId = $this->getCollectorUserId($userId);

        $collection = $collectable->collections()->where('user_id', $userId)->withTrashed()->first();

        $collection ? $collection->restore() : $collectable->collections()->create([
            'user_id' => $userId,
        ]);

        return;
    }

    /**
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $collectable
     * @param $userId
     * @return bool
     */
    public function isCollection(CollectableContract $collectable, $userId)
    {
        $userId = $this->getCollectorUserId($userId);

        return $collectable->collections()->where('user_id', $userId)->first() ? true : false;
    }

    /**
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $collectable
     * @param $userId
     * @return mixed|void
     */
    public function removeCollectionFrom(CollectableContract $collectable, $userId)
    {
        $collection = $collectable->collections()->where('user_id', $this->getCollectorUserId($userId))->first();

        $collection && $collection->delete();

        return;
    }

    /**
     * @param $userId
     * @return mixed
     */
    public function getCollectorUserId($userId)
    {
        if ($userId instanceof CollectorContract) {
            return $userId->getKey();
        }

        if (is_null($userId)) {
            $userId = $this->currentUserId();
        }

        if ( !$userId) {
            throw InvalidCollector::notDefined();
        }

        return $userId;
    }

    /**
     * @return mixed
     */
    protected function currentUserId()
    {
        return auth()->id();
    }
}
