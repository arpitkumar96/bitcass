@extends('frontend.layouts.app')
@section('content')

    {{-- Slider Section Start --}}
    <section class="container bg_img slider mt-70 pb-2">
        <div id="carouselExampleSlidesOnly" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-inner">
                @foreach ($sliders as $slider_key=>$slider)
                    <div class="carousel-item @if($slider_key == 0) active @endif">
                        <img src="{{asset('backend/assets/image/sliders/'.$slider->image)}}" class="d-block w-100" alt="...">
                    </div>
                @endforeach
            </div>
        </div>
    </section>
    {{-- Slider Section End --}}

    <section class="game-section padding-top padding-bottom bg_img" style="background: url({{asset('frontend/assets/images/game/bg3.jpg')}});">
        <div class="container">

            {{-- Game Section Start Here --}}
            <div class="row gx-2 justify-content-center">
                @foreach ($game_categories as $game_category)
                    <div class="col-4 col-xl-4 col-md-4 col-sm-6" onclick="getGameList('{{$game_category->id}}')">
                        <a href="#game_section" style="width: 100%;">
                            <div class="game-item">
                                <div class="game-inner">
                                    <div class="game-item__thumb">
                                        <img src="{{asset('backend/assets/image/game_categories/'.$game_category->image)}}" alt="{{$game_category->name}}">
                                    </div>
                                    <div class="game-item__content">
                                        <h4 class="title">{{$game_category->name}}</h4>
                                    </div>
                                </div>
                                <div class="ball"></div>
                            </div>
                        </a>
                    </div>
                @endforeach
            </div>
            {{-- Game Section End Here --}}

            <div class="col-12 col-xl-12 col-md-12 col-sm-12 mt-3">
                <div class="game-item2">
                    <div class="row gx-2">
                        <div class="col-4">
                            <div class="game-inner">
                                <div class="game-item__thumb">
                                    <a href="#"><img src="{{asset('frontend/assets/images/game/item3.png')}}" alt=""></a>
                                </div>
                                <div class="game-item__content">
                                    <h4 class="title"><a href="#">Sports</a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="game-inner">
                                <div class="game-item__thumb">
                                    <a href="#"><img src="{{asset('frontend/assets/images/game/item22.png')}}" alt=""></a>
                                </div>
                                <div class="game-item__content">
                                    <h4 class="title"><a href="#">Popular</a></h4>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="game-inner">
                                <div class="game-item__thumb">
                                    <a href="#"><img src="{{asset('frontend/assets/images/game/item33.png')}}" alt=""></a>
                                </div>
                                <div class="game-item__content">
                                    <h4 class="title"><a href="#">Casino</a></h4>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-12 col-xl-12 col-md-12 col-sm-12 mt-4">
                <div class="row gx-3">
                    <div class="col-6">
                        <div class="game-item3">
                            <div class="row">
                                <div class="col-7 gx-0">
                                    <div class="game-item__thumb">
                                        <img src="{{asset('frontend/assets/images/game/pvc.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="game-inner">
                                        <div class="game-item__content">
                                            <h4 class="title mt-5">PVC</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-6">
                        <div class="game-item3">
                            <div class="row">
                                <div class="col-7 gx-0">
                                    <div class="game-item__thumb">
                                        <img src="{{asset('frontend/assets/images/game/fishing.png')}}" alt="">
                                    </div>
                                </div>
                                <div class="col-5">
                                    <div class="game-inner">
                                        <div class="game-item__content">
                                            <h4 class="title mt-5">Fishing</h4>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section padding-top padding-bottom bg_img">
        <div class="container">
            <div class="row gx-2 justify-content-center">
                <div class="section-header">
                    <h2 class="section-header__title">Game</h2>
                </div>
                <div class="col-lg-3 col-6 col-sm-10">
                    <div class="blog-item">
                        <div class="blog-item__thumb">
                           <a href="#"> <img src="{{asset('frontend/assets/images/blog/item1.png')}}" alt="blog"></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-sm-10">
                    <div class="blog-item">
                        <div class="blog-item__thumb">
                            <a href="#"> <img src="{{asset('frontend/assets/images/blog/item2.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-sm-10">
                    <div class="blog-item">
                        <div class="blog-item__thumb">
                            <a href="#"> <img src="{{asset('frontend/assets/images/blog/item3.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 col-6 col-sm-10">
                    <div class="blog-item">
                        <div class="blog-item__thumb">
                            <a href="#"> <img src="{{asset('frontend/assets/images/blog/item2.png')}}" alt=""></a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="blog-section padding-bottom bg_img" id="game_section">
        <div class="container mt-3" id="game_list_div"></div>
    </section>

    {{-- Top Investor & Winner Section Starts Here --}}
    <section class="top-section padding-top padding-bottom bg_img" style="background:url({{asset('frontend/assets/images/top/bg.png')}}) center">
        <div class="container">
            <div class="row align-items-center gy-4">
                <div class="col-lg-12">
                    <h3 class="part-title mb-3">Winning information</h3>
                    <div class="top-investor-slider">
                        <div class="investor-item">
                            <div class="investor-item__thumb">
                                <img src="{{asset('frontend/assets/images/top/user.jpg')}}" alt="top">
                                <p class="amount">Win</p>
                            </div>
                            <div class="investor-item__content">
                                <h6 class="name">Mem***TVU</h6>
                                <p>Receive ₹500.00</p>
                            </div>
                        </div>
                        <div class="investor-item">
                            <div class="investor-item__thumb">
                                <img src="{{asset('frontend/assets/images/top/user.jpg')}}" alt="top">
                                <p class="amount">Win</p>
                            </div>
                            <div class="investor-item__content">
                                <h6 class="name">Mem***JLM</h6>
                                <p>Receive ₹300.00</p>
                            </div>
                        </div>
                        <div class="investor-item">
                            <div class="investor-item__thumb">
                                <img src="{{asset('frontend/assets/images/top/user.jpg')}}" alt="top">
                                <p class="amount">Win</p>
                            </div>
                            <div class="investor-item__content">
                                <h6 class="name">Mem***JTM</h6>
                                <p>Receive ₹700.00</p>
                            </div>
                        </div>
                        <div class="investor-item">
                            <div class="investor-item__thumb">
                                <img src="{{asset('frontend/assets/images/top/user.jpg')}}" alt="top">
                                <p class="amount">Win</p>
                            </div>
                            <div class="investor-item__content">
                                <h6 class="name">Mem***KLM</h6>
                                <p>Receive ₹1000.00</p>
                            </div>
                        </div>
                        <div class="investor-item">
                            <div class="investor-item__thumb">
                                <img src="{{asset('frontend/assets/images/top/user.jpg')}}" alt="top">
                                <p class="amount">Win</p>
                            </div>
                            <div class="investor-item__content">
                                <h6 class="name">Mem***LMJ</h6>
                                <p class="mb-0">Receive ₹2000.00</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <div class="cla-wrapper text-center">
                        <h3 class="title mb-3">! Winner !</h3>
                        <div class="thumb">
                            <img src="{{asset('frontend/assets/images/top/bg2.png')}}" alt="top">
                        </div>
                    </div>
                </div>
                <div class="col-lg-12">
                    <h3 class="part-title mb-3">Today Ranking information</h3>
                    <div class="top-investor-slider">
                        <div class="investor-item">
                            <div class="investor-item__thumb">
                                <img src="{{asset('frontend/assets/images/top/user.jpg')}}" alt="top">
                                <p class="amount">No. 1</p>
                            </div>
                            <div class="investor-item__content">
                                <h6 class="name">Mem***JLM</h6>
                            </div>
                        </div>
                        <div class="investor-item">
                            <div class="investor-item__thumb">
                                <img src="{{asset('frontend/assets/images/top/user.jpg')}}" alt="top">
                                <p class="amount">No. 2</p>
                            </div>
                            <div class="investor-item__content">
                                <h6 class="name">Mem***TVU</h6>
                            </div>
                        </div>
                        <div class="investor-item">
                            <div class="investor-item__thumb">
                                <img src="{{asset('frontend/assets/images/top/user.jpg')}}" alt="top">
                                <p class="amount">No. 3</p>
                            </div>
                            <div class="investor-item__content">
                                <h6 class="name">Mem***JLM</h6>
                            </div>
                        </div>
                        <div class="investor-item">
                            <div class="investor-item__thumb">
                                <img src="{{asset('frontend/assets/images/top/user.jpg')}}" alt="top">
                                <p class="amount">No. 4</p>
                            </div>
                            <div class="investor-item__content">
                                <h6 class="name">Mem***JML</h6>
                            </div>
                        </div>
                        <div class="investor-item">
                            <div class="investor-item__thumb">
                                <img src="{{asset('frontend/assets/images/top/user.jpg')}}" alt="top">
                                <p class="amount">No. 5</p>
                            </div>
                            <div class="investor-item__content">
                                <h6 class="name">Mem***TVU</h6>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section><br><br>
    {{-- Top Investor & Winner Section Ends Here --}}


    <div class="modals fade" id="myModal" tabindex="-1" aria-labelledby="winning_modal_label" aria-hidden="true"  data-bs-backdrop="static" data-bs-keyboard="false">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered">
            <div class="van-contents">
                <div class="van-dialog__header">
                    <div class="van-header">
                        <h5>Notification</h5>
                        {{-- <p class="tip">Each account can only receive rewards once</p> --}}
                    </div>
                </div>
                <div class="van-dialog__content">
                    <div class="container y-scrl">
                        <div class="first_list-item mt-2 mb-2">
                            {!!optional($startup_notification)->data!!}
                        </div>
                    </div>
                    <div class="footer">
                        {{-- <div class="active">No more reminders today</div> --}}
                        <div class="btn">Confirm</div>
                    </div>
                </div>
                <div data-bs-dismiss="modal" class="closeBtn"></div>
            </div>
        </div>
    </div>
    {{-- How Section Starts Here --}}

    {{-- <section class="how-section padding-top padding-bottom bg_img mb-5">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-lg-12">
                    <div class="section-header text-center">
                        <h2 class="section-header__title">How to Play Game</h2>
                        <p>A casino is a facility for certain types of gambling. Casinos are often built combined with hotels, resorts.</p>
                    </div>
                </div>
            </div>
            <div class="row gy-4 justify-content-center">
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="how-item">
                        <div class="how-item__thumb">
                            <i class="las la-user-plus"></i>
                            <div class="badge badge--lg badge--round radius-50">01</div>
                        </div>
                        <div class="how-item__content">
                            <h4 class="title">Sign Up First & Login</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="how-item">
                        <div class="how-item__thumb">
                            <i class="las la-id-card"></i>
                            <div class="badge badge--lg badge--round radius-50">02</div>
                        </div>
                        <div class="how-item__content">
                            <h4 class="title">Complete you Profile</h4>
                        </div>
                    </div>
                </div>
                <div class="col-sm-6 col-md-4 col-lg-4">
                    <div class="how-item">
                        <div class="how-item__thumb">
                            <i class="las la-dice"></i>
                            <div class="badge badge--lg badge--round radius-50">03</div>
                        </div>
                        <div class="how-item__content">
                            <h4 class="title">Choose a Game & Play</h4>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section> --}}

    {{-- How Section Ends Here --}}

    @push('js')

        <script>
            @if($startup_notification)
                $(document).ready(function(){
                    $("#myModal").modal('show');
                },5000);
            @endif

            function getGameList(game_category_id){
                $('.preloader').show();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('game.list.by.category') }}",
                    data: {
                        _token:"{{csrf_token()}}",
                        game_category_id:game_category_id
                    },
                    success: function(data) {
                        $('#game_list_div').html(data.view);
                        $('.preloader').hide();
                    }
                });
            }

            function getGames(category_id,sub_category_id){
                $('.preloader').show();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('game.list.by.category.subcategory') }}",
                    data: {
                        _token:"{{csrf_token()}}",
                        category_id:category_id,
                        sub_category_id:sub_category_id,
                    },
                    success: function(data) {
                        $('#game_list_data_div').html(data.view);
                        $('.preloader').hide();
                    }
                });
            }

        </script>

    @endpush

@endsection
