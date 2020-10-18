<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Tzsk\Payu\Facade\Payment;
use App\User;
use App\Order;
use App\Product;
use App\OrderProduct;
use Carbon\Carbon;

class PaymentController extends Controller
{
    public function payuPaymentInitialize(Request $request)
    {
        //Send all product quantities in an array product_quantities which contain array as key value pairs [['product_id_2' => 1], ['product_id_6' => 1]]
        //where key represent product id and value represent quantity of that product

        //product id also take from frontend in simple array

        // Merchant Key and Salt as provided by Payu.
        $MERCHANT_KEY = env('MERCHANT_KEY');
        $SALT = env('SALT');
        $PAYU_BASE_URL = env('PAYU_BASE_URL');
        //User related values
        $user_id = $request->id;
        $products_ids = $request->products_ids; //All the product ids are coming as string after commas
        $quantaties = $request->product_quantities; //All the product quantaties are coming as string after commas
        $product_quantities = array(); //Contain the quantaties of products with their respected id as requested.
        for($i = 0; $i < sizeof($quantaties); $i++)
        {
            array_push($product_quantities, ['product_id_'.$products_ids[$i] => $quantaties[$i]]); //Putting all product ids with quantaties inside an array like [['product_id_1 => 2], ['product_id_2 => 5], ['product_id_3 => 3]] 
        }

        //Getting all the user details for payment
        $user = User::find($user_id);
        $email = $user->email;
        $firstname = $user->firstname;
        $phone = '9928896649';
        $product_info = 'White Cap';
        $udf1 = "";
        $udf2 = "";
        $udf3 = "";
        $udf4 = "";
        $udf5 = "";
        $udf6 = "";
        $udf7 = "";
        $udf8 = "";
        $udf9 = "";
        $udf10 = "";
        
        //Calculating overall amount for each product with their quantities.
        $overall_amount = 0;
        for($i = 0; $i < sizeof($product_quantities); $i++)
        {
            $product = Product::find($products_ids[$i]);  //Finding product requested, with the id
            $amount_of_product = $product->product_amount;  //Getting the amount of each product
            $total_amount_of_product = $amount_of_product * $product_quantities[$i]['product_id_' . $product->id];  //Getting the total amount of each product with the quantities requested.
            $overall_amount += $total_amount_of_product;  //Adding price of product with overall quantity to overall amount.
        }


        //Creating order with all the details provided.
        $order = Order::create(
            [
                'user_id' => $user_id,
                'order_amount' => $overall_amount,
                'shipping_address' => $request->address1 . ',' . $request->address2 . ',' . $request->city . ',' . $request->state . ',' . $request->zipcode . ',' . $request->country,
                'shipping_zipcode' => $request->zipcode,
            ]
        );
        $txnid = substr(hash('sha256', $order->id . microtime()), 0, 20); //Creating a local unique transaction id.
        $order->local_txnid = $txnid;  //Saving local transaction id to database in orders table
        $order->save(); //Saving mutation of data in order table.

        //Creating the data for Pivot Table of order_product table
        $order_product_data = [];
        for($i = 0; $i < sizeof($products_ids); $i++)
        {
            $product = Product::find($products_ids[$i]);  //Getting each product requested

            $quantity_of_product_requested = $product_quantities[$i]['product_id_'.$product->id];  //Getting quantity of product requested.
            $product_price_with_quantity = $product->product_amount * $quantity_of_product_requested;  //Calculating price of product with quantities.
            
            //Pushing array of data for new row into an array to insert multiple rows with Model::insert();
            array_push($order_product_data, ['order_id' => $order->id, 'product_id' => $product->id, 'product_price' => $product->product_amount, 'product_total_price' => $product_price_with_quantity, 'product_quantity' => $quantity_of_product_requested, 'created_at' => Carbon::now(), 'updated_at' => Carbon::now()]);
        }

        //Inserting multiple rows of data in table.
        $order_product_data = OrderProduct::insert($order_product_data);

        $posted = [
                    'key' => $MERCHANT_KEY,
                    'txnid' => $txnid,
                    'amount' => $order->order_amount,
                    'productinfo' => $product_info,
                    'firstname' => $firstname,
                    'email' => $email,
                    'udf1' => $udf1,
                    'udf2' => $udf2,
                    'udf3' => $udf3,
                    'udf4' => $udf4,
                    'udf5' => $udf5,
                    'udf6' => $udf6,
                    'udf7' => $udf7,
                    'udf8' => $udf8,
                    'udf9' => $udf9,
                    'udf10' => $udf10,
                 ];
        $hashSequence = "key|txnid|amount|productinfo|firstname|email|udf1|udf2|udf3|udf4|udf5|udf6|udf7|udf8|udf9|udf10";
        $hashVarsSeq = explode('|', $hashSequence);
        $hash_string = '';	
        foreach($hashVarsSeq as $hash_var) {
          $hash_string .= isset($posted[$hash_var]) ? $posted[$hash_var] : '';
          $hash_string .= '|';
        }

        //Creating hash for Verification
        $hash_string .= $SALT;
        $hash = strtolower(hash('sha512', $hash_string));

        //Pushing additional Required data to send to frontend
        $posted['hash'] = $hash;
        $posted['phone'] = $phone;
        $posted['url'] = $PAYU_BASE_URL.'_payment';
        $posted['surl'] = env('BACKEND_URL').'transaction/checkout/payment/'.$order->id.'/payu/response';
        $posted['furl'] = env('BACKEND_URL').'transaction/checkout/payment/'.$order->id.'/payu/response';
        $posted['curl'] = env('BACKEND_URL').'transaction/checkout/payment/'.$order->id.'/payu/response';
        $posted['lastname'] = $user->lastname;
        $posted['service_provider'] = 'payu_paisa';
        $posted['address1'] = $request->address1;
        $posted['address2'] = $request->address2;
        $posted['city'] = $request->city;
        $posted['state'] = $request->state;
        $posted['country'] = $request->country;
        $posted['zipcode'] = $request->zipcode;

        return response()->json($posted,200);        
    }

    public function payuPaymentResponse(Request $request, $id)
    {
        $order = Order::find($id);
        $order->payment_gateway_response = serialize($request->all());

        $status = $request->status;
        $firstname = $request->firstname;
        $amount = $request->amount;
        $txnid = $request->txnid;
        $recieved_hash = $request->hash;
        $productinfo = $request->productinfo;
        $phone = $request->phone;
        $email = $request->email;
        $payuMoneyId = $request->payuMoneyId;
        $mode = $request->mode;
        $key = $request->key;
        $net_amount_debit = $request->net_amount_debit;

        $SALT = env('SALT');
        // Salt should be same Post Request 
        
        if (isset($request->additionalCharges)) {
               $additionalCharges = $request->additionalCharges;
                $retHashSeq = $additionalCharges . '|' . $SALT . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
          } else {
                $retHashSeq = $SALT . '|' . $status . '|||||||||||' . $email . '|' . $firstname . '|' . $productinfo . '|' . $amount . '|' . $txnid . '|' . $key;
                 }
                 $hash = hash("sha512", $retHashSeq);
               if ($hash != $recieved_hash) {
                   $title =  "Invalid Transaction, Please try again.";
                   } else {
                       if ($status == "failure")
                       {
                        $title = "Transaction Fail!";
                        $class = "alert alert-danger";
                        $order->payment_status = static::PAYMENT_FAIL;    //Getting this constant values from parent class Controller.php
                        $order->order_status = static::ORDER_FAIL;   //Getting this constant values from parent class Controller.php
                        $net_amount_debit = 0.00;
                       } elseif ($status == "success")
                       {
                        $title = "Transaction Successful!";
                        $class = "alert alert-success";
                        $order->payment_status = static::PAYMENT_SUCCESS;
                        $order->order_status = static::ORDER_YET_TO_DELIVERED;
                       } else
                       {
                        $title = "Invalid Transaction, Please try again.";
                       }
                       if($request->unmappedstatus == "userCancelled" || $request->field8 == 'GV00004 User pressed cancel button' || $request->field9 == "Cancelled by user")
                       {
                        $title = "Transaction Cancel!";
                        $class = "alert alert-danger";
                        $order->payment_status = static::PAYMENT_CANCEL;
                        $order->order_status = static::ORDER_CANCEL;
                        $net_amount_debit = 0.00;
                       }
                        $order->payment_gateway_txnid = $request->payuMoneyId;
                        $order->order_completed_at = Carbon::now();
                        $data = ['class' => $class, 'status' => $status, 'firstname' => $firstname, 'order_id' => $order->id,  'email' => $email, 'debit_amount' => $net_amount_debit, 'txnid' => $txnid, 'productinfo' => $productinfo,];
                   }
        $order->save();
        return view('payu.response')->with(['frontend_url'=> env('FRONTEND_URL'), 'title' => $title, 'data' => $data]);
    }

}
