<?php

namespace Vetor\Contracts\Collect\Collectable\Models;

use Illuminate\Database\Eloquent\Builder;

interface Collectable
{
    /**
     * @return mixed
     */
    public function getKey();

    /**
     * @return mixed
     */
    public function getKeyName();

    /**
     * @return string
     */
    public function getMorphClass();

    /**
     * @return mixed
     */
    public function collections();

    /**
     * @param null $userId
     * @return mixed
     */
    public function collect($userId = null);

    /**
     * @param null $userId
     * @return mixed
     */
    public function cancelCollect($userId = null);
}
