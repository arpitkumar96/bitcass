<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>{{config('app.name')}}</title>
        <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/favicon.png') }}" sizes="16x16">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
        <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
    </head>
    <style>
        .error {
            width: 6rem;
            height: 6rem;
            border-radius: 50%;
            display: block;
            stroke-width: 2;
            stroke: #fff;
            stroke-miterlimit: 10;
            margin: 20px auto;
            box-shadow: inset 0px 0px 0px #e74c3c;
            animation: fill-red 0.5s ease-in-out 0.5s forwards, scale 0.3s ease-in-out 0.7s both;
            background: red;
        }

        .mainbox {
            background: #fff;
            margin-top: 150px !important;
        }

        .success-text {
            font-size: 2rem;
            text-align: center;
            font-weight: 600;
            color: #000;
        }

        .success-subtext {
            font-size: 1rem;
            text-align: center;
            color: #000;
        }
    </style>

    <body class="ovr-mdl">
        <div class="mainbox mb-3 pb-3 m-2">
            <div class="container">
                <div class="mt-3">
                    <img class="error" src="{{ asset('frontend/assets/images/success.png') }}" alt="">
                </div>
                <div class="success-text mt-4">Payment Success</div>
                <div class="success-subtext mt-2">
                    Your Payment Request Submitted Sccessfully!
                </div>
            </div>
        </div>
    </body>

</html>
