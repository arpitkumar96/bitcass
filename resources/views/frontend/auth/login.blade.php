@extends('frontend.layouts.app')
@section('content')
    <section class="account-section overflow-hidden bg_img mt-75" style="background:url({{ asset('frontend/assets/images/account/bg.jpg') }})">
        <div class="container">
            <div class="account__main__wrapper">
                <div class="account__form__wrapper">
                    <div class="logo"><a href="#"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo"></a></div>
                    <p class="account-switch mt-4">Don't have an Account yet ? <a class="text--base ms-2 mb-2" href="{{ route('register') }}">Sign Up</a></p>
                    <form class="account__form form row g-3" id="login_form">
                        @csrf
                        <div class="col-12">
                            <div class="input-group">
                                <span class="input-group-text text--base style--two">+91</span>
                                <input id="phone_number" type="number" name="phone_number" class="form--control form-control style--two input" placeholder="Phone Number">
                            </div>
                            <span id="error_phone_number" style="display:none"></span>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <div class="input-pre-icon"><i class="las la-lock"></i></div>
                                <input id="password" name="password" type="password" class="form--control form-control style--two input" placeholder="Password">
                            </div>
                            <span class="error_password" style="display:none"></span>
                        </div>
                        <div class="col-12">
                            <div class="form-group">
                                <button class="cmn--btn active w-100 btn--round" type="button" onclick="submitForm()">Sign In</button>
                            </div>
                        </div>
                        <div class="d-flex flex-wrap flex-sm-nowrap justify-content-between mt-3">
                            <div class="form--check d-flex align-items-center">
                                <input id="check1" type="checkbox" checked>
                                <label for="check1">Remember me</label>
                            </div>
                            <a href="#0" class="forgot-pass d-block text--base">Forgot Password ?</a>

                        </div>
                    </form>
                </div>
            </div>
        </div>
    </section>

    @push('js')

        <script>
            $(".input").keyup(function(event) {
                if (event.keyCode === 13) {
                    submitForm();
                }
            });

            function submitForm() {
                $('.preloader').show();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('attempt.login') }}",
                    data: $('#login_form').serialize(),
                    success: function(data) {
                        $('#error_phone_number').show();
                        $('#error_phone_number').addClass('text-success');
                        $('#error_phone_number').removeClass('text-danger');
                        $('#error_phone_number').text('✔ Correct');

                        $('.error_password').show();
                        $('.error_password').addClass('text-success');
                        $('.error_password').removeClass('text-danger');
                        $('.error_password').text('✔ Correct');

                        window.location.replace(data.url);
                        $('.preloader').hide();
                    },
                    error: function(request, status, error) {
                        if (request.responseJSON.errors.phone_number) {
                            $('#error_phone_number').show();
                            $('#error_phone_number').addClass('text-danger');
                            $('#error_phone_number').removeClass('text-success');
                            $('#error_phone_number').text('✖ ' + request.responseJSON.errors.phone_number);
                        } else {
                            $('#error_phone_number').show();
                            $('#error_phone_number').addClass('text-success');
                            $('#error_phone_number').removeClass('text-danger');
                            $('#error_phone_number').text('✔ Correct');
                        }
                        if (request.responseJSON.errors.password) {
                            $('.error_password').show();
                            $('.error_password').addClass('text-danger')
                            $('.error_password').removeClass('text-success');
                            $('.error_password').text('✖ ' + request.responseJSON.errors.password);
                        } else {
                            $('.error_password').show();
                            $('.error_password').addClass('text-success');
                            $('.error_password').removeClass('text-danger');
                            $('.error_password').text('✔ Correct');
                        }
                        $('.preloader').hide();
                    }
                });
            }
        </script>

    @endpush

@endsection
