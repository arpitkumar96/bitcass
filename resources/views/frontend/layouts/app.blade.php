<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Online Casino Platform - {{config('app.name')}}</title>
    <link rel="icon" type="image/png" href="{{asset('frontend/assets/images/favicon.png')}}" sizes="16x16">

    @include('frontend.layouts.css')
</head>

<body class="ovr-mdl">

    <div class="overlay"></div>
    <div class="preloader">
        <div class="bg-ldr">
            <div class="spinner-border" role="status">
            </div>
            @if(Session::has('success'))
                <p id="loader_text">{{Session::get('success')}}</p>
            @elseif(Session::has('error'))
                <p id="loader_text">{{Session::get('error')}}</p>
            @else
                <p id="loader_text">Loading...</p>
            @endif
        </div>
    </div>
    @include('frontend.layouts.header')
        @yield('content')
    @include('frontend.layouts.footer')

</body>

</html>
