@extends('frontend.layouts.app')
@section('content')
    <section class="support-section padding-top bg_img padding-bottom mt-5" style="background: url({{ asset('frontend/assets/images/top/bg.png') }});">
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12">
                    <img src="{{ asset('frontend/assets/images/support.png') }}" class="w-100">
                </div>
            </div>
            <div class="row">
                <div class="col-12 col-md-12">
                    <ul class="content-itm">
                        <li>
                            <a href="#">
                                <img src="{{ asset('frontend/assets/images/call.png') }}">
                                <span> LiveChat</span><small><i class="las la-chevron-right"></i></small>
                            </a>
                        </li>
                        @foreach ($supports as $support)
                            <li>
                                <a href="{{$support->url}}">
                                    <img src="{{ asset('backend/assets/image/supports/'.$support->image) }}">
                                    <span> {{$support->name}}</span><small><i class="las la-chevron-right"></i></small>
                                </a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
    </section>
@endsection
