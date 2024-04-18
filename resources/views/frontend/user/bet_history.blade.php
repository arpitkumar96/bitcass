@extends('frontend.layouts.app')
@section('content')
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-4"
        style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <form id="search_form">
                <ul class="bet-history hor-swipe">
                    @foreach ($game_categories as $gckey => $game_category)
                        <li class="bet-item">
                            <label class="bet-megabox d-block mb-3">
                                <input type="radio" name="search_game_category" id="search_game_category"
                                    value="{{ $game_category->id }}" @if ($gckey == 0) checked @endif
                                    onclick="getSubCategory()">
                                <span class="d-block p-2 bet-megabox-elem">
                                    <img src="{{ asset('backend/assets/image/game_categories/' . $game_category->image) }}"
                                        class="img-fluid mb-1">
                                    <span class="d-block text-center">
                                        <h5 class="text-white">{{ $game_category->name }}</h5>
                                    </span>
                                </span></label>
                        </li>
                    @endforeach
                </ul>
                <div class="row">
                    <div class="col-6">
                        <label for="">Choose Type</label>
                        <div class="form-group">
                            <select class="form-control form--control" name="search_game_id" id="search_game_id"
                                aria-label="Default select example" onchange="fillter()">
                                <option value="">Choose Type</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-6">
                        <label for="">Select Date</label>
                        <div class="form-group">
                            <input name="search_date" id="search_date" type="date" class="form-control form--control"
                                onchange="fillter()">
                        </div>
                    </div>
                </div>
            </form>

            <div class="row">
                <div class="col-12">
                    <div class="rechargeh__container">
                        <div class="rechargeh__container-head mb-2">
                            <img src="{{ asset('frontend/assets/images/dashboard/history.png') }}">
                            <h1>Bet history</h1>
                        </div>
                        <div id="bet_history_div">
                        </div>
                    </div>
                </div>
            </div>
            <br><br>
    </section>

    @push('js')
        <script>
            $(getSubCategory());

            function getSubCategory() {
                var search_game_category = $('#search_game_category').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('user.get.game.by.category') }}",
                    data: {
                        _token: "{{ csrf_token() }}",
                        search_game_category: search_game_category
                    },
                    success: function(data) {
                        $('#search_game_id').empty();
                        $('#search_game_id').append("<option value=''>Choose Type</option>");
                        $.each(data, function(key, val) {
                            $('#search_game_id').append("<option value=" + val.id + " >" + val.name +
                                "</option>");
                        });
                        fillter();
                    }
                });
            }

            function fillter() {
                $('.preloader').show();
                var route = "{{ route('user.bet.history') }}";
                var form = $('#search_form').serialize();
                $.ajax({
                    type: 'GET',
                    url: "{{ route('user.bet.history') }}",
                    data: $('#search_form').serialize(),
                    success: function(data) {
                        $('.preloader').hide();
                        $('#bet_history_div').html(data);
                    }
                });
            }
        </script>
    @endpush
@endsection
