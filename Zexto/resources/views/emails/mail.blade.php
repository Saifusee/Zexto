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
    <body style="background-color: blue; color: black;">
            <div class="container-fluid text-center">
                <div style="background-color: yellow; color: black;">
                    <h1>Thank you for registering to Zexto {{$username}}</h1>
                    <h4>We hope you would have wonderful experience with us.</h4>
                    <h4>{{$username}}, please click the link below to verify your e-mail address.</h4>
                </div>
                <div class="alert alert-warning">
                    <a href="{{ url($link) }}" style="background-color: #4CAF50; border: none; color: white; padding: 15px 32px; text-align: center; text-decoration: none; display: inline-block; font-size: 16px; margin: 4px 2px; cursor: pointer;">CLICK HERE TO VERIFY EMAIL ADDRESS.</a>
                </div>
            </div>
    </body>
</html>
