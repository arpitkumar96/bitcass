@extends('frontend.layouts.app')
@section('content')
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-3"
        style="background: url({{ asset('frontend/assets/images/top/bg.png') }}); min-height: 600px;"> <br>
        <div class="container">
            <div class="row gy-2 gx-2 mb-3">
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control form--control" aria-label="Default select example">
                            <option selected>Choose Type</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="date" type="date" class="form-control form--control">
                    </div>
                </div>
            </div>
        </div><br><br>
    </section>
@endsection
