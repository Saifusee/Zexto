<?php

use Illuminate\Database\Seeder;
use App\OrderProduct;

class OrderProductTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        OrderProduct::create(
            [
                'order_id' => 1,
                'product_id' => 6,
                'product_price' => 200,
                'product_total_price' => 200,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 1,
                'product_id' => 8,
                'product_price' => 250,
                'product_total_price' => 250,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 2,
                'product_id' => 23,
                'product_price' => 400,
                'product_total_price' => 400,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 2,
                'product_id' => 24,
                'product_price' => 200,
                'product_total_price' => 200,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 2,
                'product_id' => 25,
                'product_price' => 300,
                'product_total_price' => 300,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 3,
                'product_id' => 12,
                'product_price' => 300,
                'product_total_price' => 300,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 3,
                'product_id' => 14,
                'product_price' => 700,
                'product_total_price' => 700,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 3,
                'product_id' => 16,
                'product_price' => 356,
                'product_total_price' => 356,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 3,
                'product_id' => 18,
                'product_price' => 196,
                'product_total_price' => 196,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 4,
                'product_id' => 13,
                'product_price' => 400,
                'product_total_price' => 400,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 4,
                'product_id' => 15,
                'product_price' => 400,
                'product_total_price' => 400,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 4,
                'product_id' => 17,
                'product_price' => 378,
                'product_total_price' => 378,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 4,
                'product_id' => 19,
                'product_price' => 200,
                'product_total_price' => 200,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 4,
                'product_id' => 21,
                'product_price' => 250,
                'product_total_price' => 250,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 5,
                'product_id' => 11,
                'product_price' => 200,
                'product_total_price' => 200,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 5,
                'product_id' => 22,
                'product_price' => 200,
                'product_total_price' => 200,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 5,
                'product_id' => 1,
                'product_price' => 700,
                'product_total_price' => 700,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 5,
                'product_id' => 4,
                'product_price' => 378,
                'product_total_price' => 378,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 5,
                'product_id' => 13,
                'product_price' => 400,
                'product_total_price' => 400,
                'product_quantity' => 1,
            ]
        );
        OrderProduct::create(
            [
                'order_id' => 5,
                'product_id' => 18,
                'product_price' => 196,
                'product_total_price' => 196,
                'product_quantity' => 1,
            ]
        );

    }
}
