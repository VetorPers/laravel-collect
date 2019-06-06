<?php

namespace Vetor\Laravel\Collect\Collector\Models\Traits;

use Vetor\Contracts\Collect\Collection\Models\Collection as CollectionContract;
use Vetor\Contracts\Collect\Collectable\Models\Collectable as CollectableContract;
use Vetor\Contracts\Collect\Collectable\Services\CollectableService as CollectableServiceContract;

trait Collector
{
    /**
     * @return mixed
     */
    public function collections()
    {
        return $this->hasMany(app(CollectionContract::class), 'user_id', $this->getKeyName());
    }

    /**
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $collectable
     */
    public function collect(CollectableContract $collectable)
    {
        return app(CollectableServiceContract::class)->addCollectionTo($collectable, $this);
    }

    /**
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $collectable
     */
    public function isCollectThis(CollectableContract $collectable)
    {
        return app(CollectableServiceContract::class)->isCollection($collectable, $this);
    }

    /**
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $collectable
     */
    public function cancelCollect(CollectableContract $collectable)
    {
        return app(CollectableServiceContract::class)->removeCollectionFrom($collectable, $this);
    }

    /**
     * @param $collectableClass
     * @return mixed
     */
    public function collectionsWhereCollectable($collectableClass)
    {
        return $this->collections()->where('collectable_type', (new $collectableClass)->getMorphClass())->get();
    }
}
