<?php

namespace Vetor\Tests\Collect\Stubs\Models;

use Illuminate\Database\Eloquent\Model;
use Vetor\Laravel\Collect\Collector\Models\Traits\Collector;
use Vetor\Contracts\Collect\Collector\Models\Collector as CollectorContract;

class User extends Model implements CollectorContract
{
    use Collector;

    protected $table = 'users';
    protected $fillable = ['name'];
}
