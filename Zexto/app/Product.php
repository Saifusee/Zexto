<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name', 'product_for', 'product_tags', 'product_description', 'product_amount', 'product_previous_amount', 'vendor_id',
    ];

    public function orders()
    {
        //->using Directing to model for pivot table if needed which implements on pivot class
        //->withPivot directing to some columns which hold details other than pivot columns and include those column in pivot table functionality.
        return $this->belongsToMany('App\Order', 'order_product', 'product_id', 'order_id')->using('App\OrderProduct')->withPivot('current_product_amount', 'product_quantity', 'product_total_price');
    }
}
