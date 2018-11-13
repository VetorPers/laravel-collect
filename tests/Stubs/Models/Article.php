<?php

namespace Vetor\Tests\Collect\Stubs\Models;

use Illuminate\Database\Eloquent\Model;
use Vetor\Laravel\Collect\Collectable\Models\Traits\Collectable;
use Vetor\Contracts\Collect\Collectable\Models\Collectable as CollectableContract;

class Article extends Model implements CollectableContract
{
    use Collectable;

    protected $table = 'articles';
    protected $fillable = ['name'];
}
