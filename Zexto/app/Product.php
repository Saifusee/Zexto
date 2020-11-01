<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class Product extends Model
{
    use SoftDeletes;
    
    protected $fillable = [
        'product_name', 'product_for', 'product_tags', 'product_introduction', 'product_features', 'product_amount', 'product_previous_amount', 'product_main_image', 'product_description_image', 'product_sub_image_1', 'product_sub_image_2', 'product_sub_image_3', 'product_sub_image_4', 'product_sub_image_5', 'product_sub_image_6', 'vendor_id', 'product_ratings', 'product_stock', 'product_colors', 'product_weight', 'product_size', 'product_category'
    ];

    //Getter to add % in tax percentage
    public function getProductAmountAttribute($value)
    {
        return $this->attributes['product_amount'] = $value;
    }

    //Getter to add % in tax percentage
    public function getProductPreviousAmountAttribute($value)
    {
        return $this->attributes['product_previous_amount'] = $value;
    }

    public function orders()
    {
        //->using Directing to model for pivot table if needed which implements on pivot class
        //->withPivot directing to some columns which hold details other than pivot columns and include those column in pivot table functionality.
        return $this->belongsToMany('App\Order')->using('App\OrderProduct')->withPivot('product_price', 'product_quantity', 'product_total_price');
    }

    public function taxes()
    {
        //->using Directing to model for pivot table if needed which implements on pivot class
        //->withPivot directing to some columns which hold details other than pivot columns and include those column in pivot table functionality.
        return $this->belongsToMany('App\Tax')->using('App\ProductTax');
    }
}
