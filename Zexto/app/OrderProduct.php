<?php

namespace App;

use Illuminate\Database\Eloquent\Relations\Pivot;
use Illuminate\Database\Eloquent\SoftDeletes;

class OrderProduct extends Pivot
{
    use SoftDeletes;
    public $incrementing = true;
}
