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
                    <a href="{{route('admin.played.games',$game->slug)}}">{{$game->name}}</a>
                </li>
                <li class="breadcrumb-item active">
                    <strong>{{$start_game->start_game_id}}</strong>
                </li>
            </ol>
        </div>
        <div class="col-3">
            @can('game-played-set-result')
                @if($start_game->is_running == '1')
                    <div class="mt-3 text-right">
                        <a href="#" class="btn btn-w-m btn-primary dim" style="margin-bottom:0px !important" onclick="setResult()"><i class="fa fa-file-text"></i>  Set Result</a>
                    </div>
                @endif
            @endcan
        </div>
        <div class="col-3">
            <div class="mt-3 text-right">
                <x-admin.back-button route="{{route('admin.played.games',$game->slug)}}" />
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <form action="{{route('admin.game.participant',$start_game->start_game_id)}}" id="search_form">
                            <div class="row">
                                <div class="col-sm-6 m-b-xs">
                                    <h4>Game Result:-</h4>
                                    <b>Number:</b> {{$start_game->winning_number}}<br>
                                    <b>Color:</b> {{$start_game->winning_color}}<br>
                                    <b>Size:</b> {{$start_game->winning_size}} <br>
                                    <b>Result Declare By: </b> @if($start_game->result_declare_by) {{App\Models\Admin::find($start_game->result_declare_by)->name}} @else Automatic @endif
                                </div>
                                <div class="col-sm-3 m-b-xs">
                                    <label for="search_win_lose">Win/Lose</label>
                                    <select class="form-control-sm form-control select2" id="search_win_lose" name="search_win_lose" onchange="fillter()">
                                        <option value="">Select Win/Lose...</option>
                                        <option value="0" @if($search_win_lose == '0') selected @endif>Lose</option>
                                        <option value="1" @if($search_win_lose == '1') selected @endif>Win</option>
                                    </select>
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
                            @include('admin.game_participation.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="modal inmodal" id="myModal" tabindex="-1" role="dialog" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content animated bounceInRight">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal"><span aria-hidden="true">&times;</span><span class="sr-only">Close</span></button>
                    <h4 class="modal-title">Set Result</h4>
                </div>
                <form class="form-example" id="set_result_form">
                    <div class="modal-body">
                        <div class="form-group">
                            <label>Select Number</label>
                            <select name="select_number" id="select_number" class="form-control" required>
                                <option value="">Select Number</option>
                                <option value="0" @if($start_game->winning_number == '0') selected @endif>0</option>
                                <option value="1" @if($start_game->winning_number == '1') selected @endif>1</option>
                                <option value="2" @if($start_game->winning_number == '2') selected @endif>2</option>
                                <option value="3" @if($start_game->winning_number == '3') selected @endif>3</option>
                                <option value="4" @if($start_game->winning_number == '4') selected @endif>4</option>
                                <option value="5" @if($start_game->winning_number == '5') selected @endif>5</option>
                                <option value="6" @if($start_game->winning_number == '6') selected @endif>6</option>
                                <option value="7" @if($start_game->winning_number == '7') selected @endif>7</option>
                                <option value="8" @if($start_game->winning_number == '8') selected @endif>8</option>
                                <option value="9" @if($start_game->winning_number == '9') selected @endif>9</option>
                            </select>
                            <span class="text-danger" id="error_result_number"></span>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
                        <button type="button" class="btn btn-primary" onclick="saveResult()">Save</button>
                    </div>
                </form>
            </div>
        </div>
    </div>

    @push('js')

    <script>

        var Toast = Swal.mixin({
            toast: true,
            position: 'top-end',
            showConfirmButton: false,
            timer: 3000
        });

        function fillter(){
            $('tbody').addClass('loading')
            var route = "{{route('admin.game.participant',$start_game->start_game_id)}}";
            var form = $('#search_form').serialize();
            $.ajax({
                type: 'GET',
                url: "{{route('admin.game.participant',$start_game->start_game_id)}}",
                data: $('#search_form').serialize(),
                success: function(data) {
                    window.history.pushState("", "", route+'?'+form);
                    $('tbody').removeClass('loading');
                    $('#table_div').html(data);
                }
            });
        }

        function setResult(){
            $('#myModal').modal('show');
        }

        function saveResult(){
            var result_number = $('#select_number').val();
            $.ajax({
                type: 'POST',
                url: "{{route('admin.set.game.result',$start_game->start_game_id)}}",
                data: {
                    _token:"{{csrf_token()}}",
                    result_number:result_number
                },
                success: function(data) {
                    $('#myModal').modal('hide');
                    Toast.fire({
                        icon: 'success',
                        title: data.message
                    });
                    setTimeout(function () {
                        location.reload();
                    },2000);
                },error: function(request, status, error) {
                    if (request.responseJSON.errors.result_number) {
                        $('#error_result_number').show();
                        $('#error_result_number').text(request.responseJSON.errors.result_number);
                    }else{
                        $('#myModal').modal('hide');
                        Toast.fire({
                            icon: 'error',
                            title: request.responseJSON.errors.message
                        });
                        setTimeout(function () {
                            location.reload();
                        },2000);
                    }
                }
            });
        }

    </script>

@endpush

@endsection
