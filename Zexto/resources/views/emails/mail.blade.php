<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>Zexto E-mail Verification</title>

        <!-- Fonts -->
        <link href="https://fonts.googleapis.com/css?family=Nunito:200,600" rel="stylesheet">
        <link href="css/app.css" rel="stylesheet" type="text/css">
    </head>
    <body class="alert alert-primary">
            <div class="container-fluid text-center">
                <div class="alert alert-warning">
                    <h1>Thank you for registering to Zexto {{$name}}</h1>
                    <h4>We hope you would have wonderful experience with us.</h4>
                    <h4>{{$id}}</h4>
                    <h4>{{$username}}</h4>
                </div>
                <div class="alert alert-warning">
                    <a href="{{ url($link) }}"><button class="btn btn-primary">CLICK HERE TO VERIFY EMAIL ADDRESS.</button></a>
                </div>
            </div>
    </body>
</html>
