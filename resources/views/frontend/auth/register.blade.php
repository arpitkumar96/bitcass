@extends('frontend.layouts.app')
@section('content')
    <section class="account-section overflow-hidden bg_img" style="background:url({{ asset('frontend/assets/images/account/bg.jpg') }})">
        <div class="container">
            <div class="account__main__wrapper">
                <div class="account__form__wrapper sign-in">
                    <div class="logo"><a href="{{route('index')}}"><img src="{{ asset('frontend/assets/images/logo.png') }}" alt="logo"></a></div>
                    <p class="account-switch mt-4">Already have an Account ? <a class="text--base ms-2 mb-2" href="{{route('login')}}">Sign In</a></p>
                    <form class="account__form form row g-3" id="register_form">
                        @csrf
                        <div class="col-xl-12 col-md-12" id="nam_div">
                            <div class="input-group">
                                <span class="input-group-text text--base style--two">+91</span>
                                <input id="phone_number" type="number" name="phone_number" class="form--control form-control style--two input" placeholder="Phone Number">
                            </div>
                            <span id="error_phone_number" style="display:none"></span>
                        </div>
                        <div class="col-xl-12 col-md-12 password_div">
                            <div class="form-group">
                                <div class="input-pre-icon"><i class="las la-lock"></i></div>
                                <input id="password" name="password" type="password" class="form--control form-control style--two input" placeholder="Password">
                            </div>
                            <span class="error_password" style="display:none"></span>
                        </div>
                        <div class="col-xl-12 col-md-12 password_div">
                            <div class="form-group">
                                <div class="input-pre-icon"><i class="las la-lock"></i></div>
                                <input id="confirm_password" type="password" name="password_confirmation" class="form--control form-control style--two input" placeholder="Confirm Password">
                            </div>
                            <span class="error_password" style="display:none"></span>
                        </div>
                        <div class="col-xl-12 col-md-12" id="invite_code_div">
                            <div class="form-group">
                                <div class="input-pre-icon"><i class="las la-user"></i></div>
                                <input id="invite_code" type="text" name="invite_code" class="form--control form-control style--two input" placeholder="Invite Code" value="{{$invitation_code}}">
                            </div>
                            <span id="error_invite_code" style="display:none"></span>
                        </div>
                        <div class="col-lg-12">
                            <div class="form-group">
                                <button class="cmn--btn active w-100 btn--round" type="button" onclick="submitForm()">Sign Up</button>
                            </div>
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
                    url: "{{ route('attempt.register') }}",
                    data: $('#register_form').serialize(),
                    success: function(data) {
                        $('#error_phone_number').show();
                        $('#error_phone_number').addClass('text-success');
                        $('#error_phone_number').removeClass('text-danger');
                        $('#error_phone_number').text('✔ Correct');

                        $('.error_password').show();
                        $('.error_password').addClass('text-success');
                        $('.error_password').removeClass('text-danger');
                        $('.error_password').text('✔ Correct');

                        $('#error_invite_code').show();
                        $('#error_invite_code').addClass('text-success');
                        $('#error_invite_code').removeClass('text-danger');
                        $('#error_invite_code').text('✔ Correct');

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
                        if (request.responseJSON.errors.invite_code) {
                            $('#error_invite_code').show();
                            $('#error_invite_code').addClass('text-danger');
                            $('#error_invite_code').removeClass('text-success');
                            $('#error_invite_code').text('✖ ' + request.responseJSON.errors.invite_code);
                        } else {
                            $('#error_invite_code').hide();
                        }
                        $('.preloader').hide();
                    }
                });
            }
        </script>

    @endpush

@endsection
