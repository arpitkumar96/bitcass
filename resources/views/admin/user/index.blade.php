@extends('admin.layouts.app')
@section('content')
    <div class="row wrapper border-bottom white-bg page-heading">
        <div class="col-6">
            <ol class="breadcrumb mt-4">
                <li class="breadcrumb-item">
                    <a href="{{route('admin.dashboard')}}">Dashboard</a>
                </li>
                @isset($page_title)
                    <li class="breadcrumb-item active">
                        <strong>{{$page_title}}</strong>
                    </li>
                @endisset
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <form action="{{route('admin.user.index')}}" id="search_form">
                            <div class="row">
                                <div class="col-sm-1 m-b-xs"></div>
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
                                    <label for="search_invite_code">Invite Code</label>
                                    <div class="input-group">
                                        <input placeholder="Invite Code" type="text" name="search_invite_code" id="search_invite_code" value="{{$search_invite_code}}" class="form-control form-control-sm" onkeyup="fillter()">
                                    </div>
                                </div>
                                <div class="col-sm-3 m-b-xs" style="padding:0px 0px 0px 0px">
                                    <label for="search_key">Search</label>
                                    <div class="input-group">
                                        <input placeholder="Name/Id/Phone" type="text" name="search_key" id="search_key" value="{{$search_key}}" class="form-control form-control-sm" onkeyup="fillter()">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-sm btn-primary dim">Search</button>
                                        </span>
                                    </div>
                                </div>
                                <div class="col-sm-1 m-b-xs text-left" style="margin-top: 28px; padding:0px">
                                    <button type="submit" name="export" value="export" class="btn btn-sm btn-primary dim">Export</button>
                                </div>
                            </div>
                        </form>
                        <div id="table_div">
                            @include('admin.user.table')
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
                var route = "{{route('admin.user.index')}}";
                var form = $('#search_form').serialize();
                $.ajax({
                    type: 'GET',
                    url: "{{route('admin.user.index')}}",
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
