@extends('admin.layouts.app')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-6">
            <ol class="breadcrumb mt-4">
                <li class="breadcrumb-item">
                    <a href="{{route('admin.dashboard')}}">Dashboard</a>
                </li>
                <li class="breadcrumb-item">
                    <a href="{{route('admin.game.index')}}">Games</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>{{$game->name}}</strong>
                </li>
            </ol>
        </div>
        <div class="col-6">
            <div class="mt-3 text-right">
                <x-admin.back-button route="{{route('admin.game.index')}}" />
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <form action="{{route('admin.played.games',$game->slug)}}" id="search_form">
                            <div class="row">
                                <div class="col-sm-5 m-b-xs"></div>
                                <div class="col-sm-4 m-b-xs">
                                    <div class="form-group date_range">
                                        <label class="font-normal">Date</label>
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="form-control-sm form-control" name="search_start_date" placeholder="--/--/----" value="{{$search_start_date}}" onchange="fillter()">
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control-sm form-control" name="search_end_date" placeholder="--/--/----" value="{{$search_end_date}}" onchange="fillter()">
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-3 m-b-xs">
                                    <label for="search_key">Search</label>
                                    <div class="input-group">
                                        <input placeholder="Search" type="text" name="search_key" id="search_key" value="{{$search_key}}" class="form-control form-control-sm" onkeyup="fillter()">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-sm btn-primary dim">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </form>
                        <div id="table_div">
                            @include('admin.played_game.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')

    <script>

        function fillter(){
            $('.tbody').addClass('loading')
            var route = "{{route('admin.played.games',$game->slug)}}";
            var form = $('#search_form').serialize();
            $.ajax({
                type: 'GET',
                url: "{{route('admin.played.games',$game->slug)}}",
                data: $('#search_form').serialize(),
                success: function(data) {
                    window.history.pushState("", "", route+'?'+form);
                    $('.tbody').removeClass('loading');
                    $('#table_div').html(data);
                    $('[data-toggle="tooltip"]').tooltip();
                }
            });
        }

    </script>

@endpush

@endsection
