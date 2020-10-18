<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="{{url($frontend_url)}}src/fashi/css/bootstrap.min.css" type="text/css"/>
        <title>Zexto Checkout</title>
        <style>
            body{
                margin-top: 150px;
                background-color: lightyellow;
            }
            .error-main{
                background-color: white;
                box-shadow: 0px 10px 10px -10px #5D6572;
            }

            .error-main h6 {
                color: #42494F;
                font-size: 30px;
            }

            .error-main p {
                color: #9897A0;
                font-size: 14px;
                margin: 10px;
            }

            .error-main small{
                font-size: 20px;
            }
    </style>
    </head>
    <body>
        <div class="container-fluid">
          <!-- 404 Error Text -->
                <div class="row text-center">
                    <div class="col-lg-6 offset-lg-3 col-sm-6 offset-sm-3 col-12 p-3 error-main">
                        <div class="row">
                            <div class="col-lg-8 col-12 col-sm-10 offset-ls-2 offset-sm-1" style="font-size: 50px;">
                                <div class="{{$data['class']}}">{{$title}}</div> <br>
                                <h6>Your order number is <strong><u>{{$data['order_id']}}</u></strong></h6>
                                <small>Keep this with you for keeping track of order status.</small> <br>
                                <br>
                                <h6>Your Transaction id is <strong><u>{{$data['txnid']}}</u></strong></h6>
                                <h6>Net Amount you paid is <strong><u> INR {{$data['debit_amount']}}</u></strong></h6>
                                    <br>
                                <p><a href="{{$frontend_url}}"><button class="btn btn-secondary btn-lg">&larr; Back to Zexto Home Page</button></a></p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
    </body>
</html>
