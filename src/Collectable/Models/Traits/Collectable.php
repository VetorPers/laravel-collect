<?php

namespace Vetor\Laravel\Collect\Collectable\Models\Traits;

use DB;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Vetor\Contracts\Collect\Collection\Models\Collection as CollectionContract;
use Vetor\Contracts\Collect\Collectable\Services\CollectableService as CollectableServiceContract;

trait Collectable
{
    /**
     * @return mixed
     */
    public function collections()
    {
        return $this->morphMany(app(CollectionContract::class), 'collectable');
    }

    /**
     * @param null $userId
     */
    public function collect($userId = null)
    {
        return app(CollectableServiceContract::class)->addCollectionTo($this, $userId);
    }

    /**
     * @param null $userId
     */
    public function isCollection($userId = null)
    {
        return app(CollectableServiceContract::class)->isCollection($this, $userId);
    }

    /**
     * @param null $userId
     */
    public function cancelCollect($userId = null)
    {
        return app(CollectableServiceContract::class)->removeCollectionFrom($this, $userId);
    }

    /**
     * @return int
     */
    public function getCollectionsCountAttribute()
    {
        return $this->collections ? $this->collections->count() : 0;
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param string $direction
     * @return mixed
     */
    public function scopeOrderByCollectionsCount(Builder $query, $direction = 'asc')
    {
        $collectable = $query->getModel();

        return $query
            ->select("{$collectable->getTable()}.*")
            ->leftJoin('collections', function (JoinClause $join) use ($collectable) {
                $join
                    ->on('collections.collectable_id', '=', "{$collectable->getTable()}.{$collectable->getKeyName()}")
                    ->where('collections.collectable_type', '=', $collectable->getMorphClass());
            })
            ->groupBy("{$collectable->getTable()}.{$collectable->getKeyName()}")
            ->orderBy(DB::raw("count(collections.id)"), $direction)
            ->orderBy("{$collectable->getTable()}.{$collectable->getKeyName()}");
    }
}
