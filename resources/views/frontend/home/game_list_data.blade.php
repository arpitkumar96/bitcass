@forelse ($games as $game)
    <div class="col-lg-4 col-6 col-sm-10">
        <div class="blog-item mb-0">
            <div class="blog-item__thumb">
                <a href="{{route('game',$game->slug)}}"> <img src="{{asset('backend/assets/image/games/'.$game->image)}}" alt=""></a>
            </div>
            <div class="blog-item__content">
                <h4 class="title-game mb-1"><a href="{{route('game',$game->slug)}}">{{$game->name}}</a></h4>
            </div>
        </div>
    </div>
@empty
    Comming Soon...
@endforelse
