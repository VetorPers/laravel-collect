<?php

namespace Vetor\Laravel\Collect\Collection\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletes;
use Vetor\Contracts\Collect\Collection\Models\Collection as CollectionContract;

class Collection extends Model implements CollectionContract
{
    use SoftDeletes;

    /**
     * @var string
     */
    protected $table = 'collections';

    /**
     * @var array
     */
    protected $fillable = [
        'collectable_id',
        'collectable_type',
        'user_id',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\MorphTo
     */
    public function collectable()
    {
        return $this->morphTo();
    }

    /**
     * @param \Illuminate\Database\Eloquent\Builder $query
     * @param \Vetor\Contracts\Collect\Collectable\Models\Collectable $collectable
     * @return mixed
     */
    public function scopeWhereCollectable(Builder $query, $collectableClass)
    {
        return $query->where('collectable_type', (new $collectableClass)->getMorphClass());
    }
}
