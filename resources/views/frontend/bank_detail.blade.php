@extends('frontend.layouts.app')
@section('content')
    <!-- About Section Starts Here -->
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-5"
        style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <div class="row gy-3">
                <form action="{{ route('user.bank.detail.store') }}" method="POST">
                    @csrf
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <label for="bank_name" class="form-label">Bank Name <span class="text--danger">*</span></label>
                            <input type="text" name="bank_name" id="bank_name" class="form-control form--control" value="{{ old('bank_name', optional(Auth::guard('web')->user()->bankDetail)->bank_name) }}">
                        </div>
                        @error('bank_name')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <label for="account_number" class="form-label">Account Number <span class="text--danger">*</span></label>
                            <input type="text" name="account_number" id="account_number" class="form-control form--control" value="{{ old('account_number', optional(Auth::guard('web')->user()->bankDetail)->account_number) }}">
                        </div>
                        @error('account_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <label for="phone_number" class="form-label">Phone Number <span class="text--danger">*</span></label>
                            <input type="text" name="phone_number" id="phone_number" class="form-control form--control" value="{{ old('phone_number', optional(Auth::guard('web')->user()->bankDetail)->phone_number) }}">
                        </div>
                        @error('phone_number')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <label for="email" class="form-label">Email <span class="text--danger">*</span></label>
                            <input type="text" name="email" id="email" class="form-control form--control" value="{{ old('email', optional(Auth::guard('web')->user()->bankDetail)->email) }}">
                        </div>
                        @error('email')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-2">
                            <label for="ifsc_code" class="form-label">IFSC Code <span class="text--danger">*</span></label>
                            <input type="text" name="ifsc_code" id="ifsc_code" class="form-control form--control" value="{{ old('ifsc_code', optional(Auth::guard('web')->user()->bankDetail)->ifsc_code) }}">
                        </div>
                        @error('ifsc_code')
                            <span class="text-danger">{{$message}}</span>
                        @enderror
                    </div>
                    <div class="col-md-12">
                        <div class="form-group mb-2 mt-3">
                            <button class="cmn--btn active btn--lg w-100">Submit</button>
                        </div>
                    </div><br><br>
                </form>
            </div>
    </section>
@endsection
