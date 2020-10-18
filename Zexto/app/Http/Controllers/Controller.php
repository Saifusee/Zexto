<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;


    //Setting Payment and Order Status Constant Values.
    const PAYMENT_FAIL = '0';
    const PAYMENT_SUCCESS = '1';
    const PAYMENT_IN_PROGRESS = '2';
    const PAYMENT_CANCEL = '3';
    const PAYMENT_REFUND = '4';

    const ORDER_FAIL = '0';
    const ORDER_SUCCESS = '1';
    const ORDER_IN_PROGRESS = '2';
    const ORDER_CANCEL = '3';
    const ORDER_YET_TO_DELIVERED = '4';

}
