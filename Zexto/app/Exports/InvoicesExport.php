<?php
namespace App\Exports;

use Illuminate\Contracts\View\View;
use Maatwebsite\Excel\Concerns\FromView;
use App\Order;
use App\User;

class InvoicesExport implements FromView
{
    protected $id;

    public function __construct($id)
    {
        $this->id = $id;
    }

    public function view(): View
    {

        $order = Order::find($this->id);
        $request= unserialize($order->payment_gateway_response); //Getting whole response of Gateway after payment to have all data.

        $products =  array();
        foreach ($order->products as $product)
            {
                //Setting the product details we want to show in blade
                array_push($products, ['product_name' => $product->product_name, 'product_description' => $product->product_description, 'product_amount' => $product->pivot->product_price, 'product_quantity' => $product->pivot->product_quantity, 'products_total_price' => $product->pivot->product_total_price]);
            }

        $user = User::find($order->user_id);  //Getting all details of user

        $status = $request['status'];
        $firstname = $request['firstname'];
        $amount = $request['amount'];
        $txnid = $request['txnid'];
        $recieved_hash = $request['hash'];
        $productinfo = $request['productinfo'];
        $phone = $request['phone'];
        $email = $request['email'];
        $mode = $request['mode'];
        $net_amount_debit = $request['net_amount_debit'];

        if ($status == "failure")
        {
         $title = "Transaction Fail!";
         $sub_title = "No Amount had been deducted and if deducted will be refunded soon.";
         $class = "alert alert-danger";
         $net_amount_debit = 0.00;
        } elseif ($status == "success")
        {
         $title = "Transaction Successful!";
         $sub_title = "Your order will shipped soon, Keep order id with you for keeping track of your order.!";
         $class = "alert alert-success";
        } else
        {
         $title = "Invalid Transaction, Please try again.";
         $sub_title = "No Amount had been deducted and if deducted will be refunded soon.";
        }
        if($request['unmappedstatus'] == "userCancelled" || $request['field8'] == 'GV00004 User pressed cancel button' || $request['field9'] == "Cancelled by user")
        {
         $title = "Transaction Cancel!";
         $sub_title = "No Amount had been deducted and if deducted will be refunded soon.";
         $class = "alert alert-danger";
         $net_amount_debit = 0.00;
        }

        $data = [
            'title' => $title,
            'sub_title' => $sub_title,
            'class' => $class,
            'firstname' => $firstname,
            'lastname' => $user->lastname,
            'email' => $email,
            'phone' => $phone, 
            'mode' => $mode,
            'address' => $order->shipping_address,
            'zipcode' => $order->shipping_zipcode, 
            'status' => $status, 
            'order_id' => $order->id, 
            'order_created_at' => $order->created_at, 
            'txnid' => $txnid, 
            'debit_amount' => $net_amount_debit, 
            'products' => $products,
            ];


        return view('payu.invoice', ['frontend_url'=> env('FRONTEND_URL'), 'backend_url'=> env('BACKEND_URL'), 'data' => $data]);
    }
}