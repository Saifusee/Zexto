<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tax extends Model
{
    use SoftDeletes;
    protected $fillable = [
        'tax_name', 'tax_percentage', 'tax_description', 'user_id'
    ];

    public function products()
    {
        //->using Directing to model for pivot table if needed which implements on pivot class
        //->withPivot directing to some columns which hold details other than pivot columns and include those column in pivot table functionality.
        return $this->belongsToMany('App\Product')->using('App\ProductTax');
    }

    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
