<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Tzsk\Payu\Fragment\Payable;

class Order extends Model
{
    use Payable;

    protected $fillable = [
        'local_txnid', 'payment_gateway_txnid', 'user_id', 'order_amount', 'order_status', 'payment_status', 'shipping_address', 'shipping_zipcode', 'payment_gateway_response', 'order_completed_at',
    ];



    public function products()
    {
        //->using Directing to model for pivot table if needed which implements on pivot class
        //->withPivot directing to some columns which hold details other than pivot columns and include those column in pivot table functionality.
        return $this->belongsToMany('App\Product')->using('App\OrderProduct')->withPivot('product_price', 'product_quantity', 'product_total_price');
    }
}
