@extends('frontend.layouts.app')
@section('content')

    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-5" style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-12 mb-4" id="wallet_section">
                    @include('frontend.game.wallet_section')
                </div>
                <div class="col-12">
                    @if(count($game->subCategory->game) != 0)
                        <ul class="nav nav-pills hor-swipe">
                            @foreach ($game->subCategory->game as $sub_category_game)
                                <li class="nav-item">
                                    <a id="a_sub_cat_{{$sub_category_game->id}}" class="a_sub_cat nav-link @if($game->id == $sub_category_game->id) active @endif text-center" onclick="getGameDetail('{{$sub_category_game->id}}')">
                                        <img src="{{ asset('backend/assets/image/games/'.$sub_category_game->image) }}" class="img-fluid"> <br>
                                        {{$sub_category_game->name}}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </div>
            </div>
            <div id="running_game_div">
                @include('frontend.game.running_game')
            </div>

    </section>

    @push('js')
        <script>
            function getGameDetail(subcategory_id){
                $('.preloader').show();
                $.ajax({
                    type: 'GET',
                    url: "{{route('get.game.detail','')}}/"+subcategory_id,
                    success: function(data) {
                        $('.a_sub_cat').removeClass('active');
                        $('#a_sub_cat_'+subcategory_id).addClass('active');
                        $('#running_game_div').html(data.view);
                        refreshWalletSection();
                        $('.preloader').hide();
                        if(data.remaining_time == '00:00'){
                            getGameDetail(subcategory_id);
                        }
                    }
                });
            }

            $(".navbar .nav-link").on("click", function(){
                $(".navbar").find(".active").removeClass("active");
                $(this).addClass("active");
            });

            function refreshWalletSection(){
                $.ajax({
                    type: 'GET',
                    url: "{{route('get.game.wallet.section')}}",
                    success: function(data) {
                        $('#wallet_section').html(data.view)
                    }
                });
            }
        </script>
    @endpush
@endsection
