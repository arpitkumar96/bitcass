<!-- Footer Section Ends Here -->
<!-- bootstrap 5 js -->
<script src="{{asset('frontend/assets/js/bootstrap.min.js')}}"></script>
<!-- Pluglin Link -->
<script src="{{asset('frontend/assets/js/slick.min.js')}}"></script>
<!-- main js -->
<script src="{{asset('frontend/assets/js/main.js')}}"></script>

    <script>
        function copyTextCode(text) {
            navigator.clipboard.writeText(text);
            $('.preloader').show();
            $('#loader_text').text('Text Copied Successfully!');
            setTimeout(function() {
                $('.preloader').hide();
                $('#loader_text').text('Loading...');
            }, 1000);
        }
    </script>

@stack('js')
