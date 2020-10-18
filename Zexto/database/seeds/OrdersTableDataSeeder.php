<?php

use Illuminate\Database\Seeder;
use App\Order;
use Carbon\Carbon;

class OrdersTableDataSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create(
            [
                'local_txnid' => '578d97ed6b3141e74451',
                'payment_gateway_txnid' => '8ba6d4a0da4430cda0a1',
                'user_id' => 2,
                'order_amount' => 450,
                'order_status' => '1',
                'payment_status' => '1',
                'shipping_address' => 'george street, near watson pillar, Manhattan, New York, 10002, USA',
                'shipping_zipcode' => '10002',
                'order_completed_at' => Carbon::now(),

            ]
        );
        Order::create(
            [
                'local_txnid' => '578d97ed6b3141e74453',
                'payment_gateway_txnid' => '8ba6d4a0da4430cda0a2',
                'user_id' => 4,
                'order_amount' => 900,
                'order_status' => '1',
                'payment_status' => '1',
                'shipping_address' => 'washington route, near drever cathedral, Manhattan, New York, 10004, USA',
                'shipping_zipcode' => '10004',
                'order_completed_at' => Carbon::now(),

            ]
        );
        Order::create(
            [
                'local_txnid' => '578d97ed6b3141e74455',
                'payment_gateway_txnid' => '8ba6d4a0da4430cda0a3',
                'user_id' => 2,
                'order_amount' => 1552,
                'order_status' => '1',
                'payment_status' => '1',
                'shipping_address' => 'jordan street, near jimmies, Manhattan, New York, 10002, USA',
                'shipping_zipcode' => '10002',
                'order_completed_at' => Carbon::now(),

            ]
        );
        Order::create(
            [
                'local_txnid' => '578d97ed6b3141e74457',
                'payment_gateway_txnid' => '8ba6d4a0da4430cda0a4',
                'user_id' => 3,
                'order_amount' => 1628,
                'order_status' => '1',
                'payment_status' => '1',
                'shipping_address' => 'machroos street, near sanchet memorial, Manhattan, New York, 10003, USA',
                'shipping_zipcode' => '10003',
                'order_completed_at' => Carbon::now(),

            ]
        );
        Order::create(
            [
                'local_txnid' => '578d97ed6b3141e74459',
                'payment_gateway_txnid' => '8ba6d4a0da4430cda0a5',
                'user_id' => 1,
                'order_amount' => 2074,
                'order_status' => '1',
                'payment_status' => '1',
                'shipping_address' => 'markroute , near star palace, Manhattan, New York, 10006, USA',
                'shipping_zipcode' => '10006',
                'order_completed_at' => Carbon::now(),

            ]
        );
    }
}
