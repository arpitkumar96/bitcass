<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>{{config('app.name')}}</title>
    <link rel="icon" type="image/png" href="{{ asset('frontend/assets/images/favicon.png') }}" sizes="16x16">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('backend/assets/css/bootstrap-4.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontend/assets/css/main.css') }}">
</head>

<body class="ovr-mdl">

    <style>
        input::placeholder {
            color: #000 !important;
        }

        .mainbox {
            max-width: 640px;
            margin: 0 auto;
        }

        .mainbox .part1 {
            background-color: #f8f8f8;
            margin: 15px;
            padding: 15px;
            box-sizing: border-box;
            border-radius: 10px;
        }

        .mainbox .part1 .name {
            text-align: center;
        }

        .mainbox .part1 .input {
            height: 30px;
            line-height: 30px;
            width: 100%;
            border: 1px solid #ccc;
            margin: 10px 0;
            padding-left: 5px;
        }

        .mainbox .part1 .button {
            justify-content: center;
        }

        .mainbox .part1 .button button {
            margin: 0 auto;
            background-color: #00a6ff;
        }

        .mainbox .part1 .tips {
            color: #e97c75;
            margin-top: 20px;
            margin-bottom: 10px;
            text-align: center;
            font-weight: 700;
        }

        .mainbox .part1 .code {
            justify-content: center;
            margin-bottom: 10px;
        }

        .mainbox .part1 .money {
            text-align: center;
            font-size: 20px;
        }

        .mainbox .part1 .tip img {
            width: 100%;
        }

        .mainbox .part1 .utr {
            justify-content: center;
            margin-top: 10px;
        }

        .mainbox .part1 .utr i {
            color: red;
        }

        .mainbox .part1 .utr input {
            height: 30px;
            line-height: 30px;
            width: 60%;
            border: 1px solid #ccc;
            padding: 0 10px;
        }

        .mainbox .part2 {
            justify-content: center;
        }

        .mainbox .part2 button {
            background-color: #00a6ff;
        }

        .mainbox .part3 {
            background-color: #f8f8f8;
            margin: -20px 15px 15px;
            padding: 20px 15px 15px;
            box-sizing: border-box;
            border-radius: 10px;
            line-height: 20px;
        }

        .flex {
            display: flex;
            flex-direction: row;
        }

        .align-center {
            align-items: center;
        }

        .font-weight-bold {
            font-weight: 700 !important;
        }

        .submitUtr {
            height: 2.4rem !important;
            width: 7rem !important;
            border-radius: 0 !important;
            display: flex;
            justify-content: center;
            align-items: center;
            color: #fff !important;
            background-color: #007bff !important;
            border: 2px solid #007bff !important;
        }

        .bg-primary {
            background-color: #007bff !important;
        }

        .part3 p {
            color: #000;
        }
    </style>
    <div class="mainbox">
        <form action="{{ route('user.update.utr', $wallet_recharge_request->transaction_id) }}" method="POST">
            @csrf
            <div class="part1">
                <div class="name">
                    <span style="color: #000">UPI ID:</span>
                </div>
                <div>
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="{{json_decode($wallet_recharge_request->channel_detail)->upi_id}}" aria-label="{{json_decode($wallet_recharge_request->channel_detail)->upi_id}}" aria-describedby="button-addon2">
                        <button class="btn btn-outline-secondary" type="button" id="button-addon2" onclick="copyTextCode('{{json_decode($wallet_recharge_request->channel_detail)->upi_id}}')">COPY</button>
                    </div>
                </div>
                <div class="tips">
                    <span>FOR SINGLE TRANSACTION ONLY</span>
                </div>
                <div class="code flex align-center">
                    <div>
                        <canvas width="180" height="180" style="display: none;"></canvas>
                        <img style="display: block;" src="{{asset('backend/assets/image/channels/'.json_decode($wallet_recharge_request->channel_detail)->image)}}" class="w-100">
                    </div>
                </div>
                <div class="money text-dark font-weight-bold">
                    <span id="amount">₹ {{$wallet_recharge_request->amount}}</span>
                </div>
                <div class="tip flex align-center">
                    <img src="{{ asset('frontend/assets/images/tip.jpg') }}" alt="">
                </div>
                <div class="utr flex align-center">
                    <span class="flex align-center">
                        <i>*</i>
                        <span style="color: #000;">UTR：</span>
                    </span>
                    <input type="text" name="utr_number" class="utrinput" placeholder="UTR(UPI Ref.ID) must be 12 digits" required>
                </div>
                @error('utr_number')
                    <span class="text-danger">{{$message}}</span>
                @enderror
                <div style="text-align: center;margin-top:10px;color: #000;font-weight:bold;"> Time: <span class="countdown"></span></div>
            </div>
            <div class="part2 flex align-center">
                <button class="py-2 px-4 rounded text-white submitUtr">SUBMIT</button>
            </div>
        </form>
        <div class="part3">
            <p><b>Reminder：</b></p>
            <p>
                1. Saving QR codes or UPI payments and modifying order amount payments are all illegal operations! Don't
                save payments!
            </p>
            <p>
                2. Our UPI payment account changes every day. If a member makes an illegal payment and deposits to a
                deactivated bank card, we will help recover it. The time is uncertain, and it is no longer within the
                scope of the claim!
            </p>
            <p>
                3.After paying from the following payment option：PayTM,PhonePE,GooglePay,BHIM,etc.
            </p>
            <p>
                4. Each tracking order is provided with a UPI certificate.
            </p>
            <p>
                5.Important reminder: After completing the UPI transaction,please backfill Ref No./UTR No./Google Pay :
                UPI Transaction ID/Freecharge: Transaction ID (12digits). If you do not back fill UTR, 100% of the
                deposit transaction will fail. Please be sure to backfill!
            </p>
        </div>
    </div>

    <script src="{{ asset('frontend/assets/js/jquery-3.6.0.min.js') }}"></script>
    <script src="{{ asset('backend/assets/js/sweetalert2.min.js') }}"></script>
    <script>
        var timer2 = "{{ $remaining_time }}";
        clearInterval(interval);
        var interval = setInterval(function() {
            var timer = timer2.split(':');
            var minutes = parseInt(timer[0], 10);
            var seconds = parseInt(timer[1], 10);
            --seconds;
            minutes = (seconds < 0) ? --minutes : minutes;
            if (minutes < 0) clearInterval(interval);
            seconds = (seconds < 0) ? 59 : seconds;
            seconds = (seconds < 10) ? '0' + seconds : seconds;
            $('.countdown').html(minutes + ':' + seconds);
            timer2 = minutes + ':' + seconds;
            if (minutes == 0 && seconds == 0) {
                clearInterval(interval);
                window.location.replace("{{ route('user.payment', $wallet_recharge_request->transaction_id) }}");
            }
        }, 1000);

        function copyTextCode(text) {
            navigator.clipboard.writeText(text);
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 3000,
                timerProgressBar: true,
            });
            Toast.fire({
                icon: "success",
                title: 'UPI ID Copied SuccessfullY!',
            });
        }
    </script>
</body>

</html>
