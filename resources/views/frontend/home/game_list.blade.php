<script>
    $(".navbar .nav-link").on("click", function(){
   $(".navbar").find(".active").removeClass("active");
   $(this).addClass("active");
});
</script>
<div class="row gy-3 justify-content-center mb-2">
    <div class="section-header">
        <h2 class="section-header__title">{{$game_category->name}}</h2>
    </div>
</div>

<nav class="navbar navbar-expand-lg navbar-light">
        @if(count($game_category->gameSubcategory) != 0)
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link active" onclick="getGames('{{$game_category->id}}',null)">All</a>
            </li>
          @foreach ($game_category->gameSubcategory as $sub_key=>$sub_category)
          <li class="nav-item">
            <a class="nav-link" onclick="getGames('{{$game_category->id}}','{{$sub_category->id}}')">{{$sub_category->name}}</a>
          </li>
          @endforeach
        </ul>
        @endif
  </nav>
@php
    $games = $game_category->game;
@endphp
<div class="row gx-2 mt-3 justify-content-center" id="game_list_data_div">
    @include('frontend.home.game_list_data')
</div>
