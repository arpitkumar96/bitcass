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
        @can('activity_banner-create')
            <div class="col-6">
                <div class="mt-3 text-right">
                    <x-admin.add-button route="{{route('admin.activity-banner.create')}}" text="Add Activity Banner"/>
                </div>
            </div>
        @endcan
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <form action="{{route('admin.activity-banner.index')}}" id="search_form">
                            {{-- <div class="row">
                                <div class="col-sm-3 m-b-xs">
                                    <label for="search_category">Category</label>
                                    <select class="form-control-sm form-control select2" id="search_category" name="search_category" onchange="getSubCategory()">
                                        <option value="">Select Category...</option>
                                        @foreach ($categories as $category)
                                            <option value="{{$category->id}}" @if($search_category == $category->id) selected @endif>{{$category->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3 m-b-xs">
                                    <label for="search_subcategory">Subcategory</label>
                                    <select class="form-control-sm form-control select2" id="search_subcategory" name="search_subcategory" onchange="fillter()">
                                        <option value="">Select SubCategory...</option>
                                        @foreach ($subcategories as $subcategory)
                                            <option value="{{$subcategory->id}}" @if($search_subcategory == $subcategory->id) selected @endif>{{$subcategory->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-sm-3 m-b-xs">
                                    <label for="search_status">Status</label>
                                    <select class="form-control-sm form-control select2" id="search_status" name="search_status" onchange="fillter()">
                                        <option value="">Select Status...</option>
                                        <option value="0" @if($search_status == '0') selected @endif>Inactive</option>
                                        <option value="1" @if($search_status == '1') selected @endif>Active</option>
                                    </select>
                                </div>
                                <div class="col-sm-3 m-b-xs">
                                    <label for="search_duration">Duration</label>
                                    <select class="form-control-sm form-control select2" id="search_duration" name="search_duration" onchange="fillter()">
                                        <option value="">Select Duration...</option>
                                        <option value="1" @if($search_duration == '1') selected @endif>1 min.</option>
                                        <option value="3" @if($search_duration == '3') selected @endif>3 min.</option>
                                        <option value="5" @if($search_duration == '5') selected @endif>5 min.</option>
                                        <option value="10" @if($search_duration == '10') selected @endif>10 min.</option>
                                    </select>
                                </div>
                                <div class="col-sm-9 m-b-xs"></div>
                                <div class="col-sm-3 m-b-xs">
                                    <label for="search_key">Search</label>
                                    <div class="input-group">
                                        <input placeholder="Search" type="text" name="search_key" id="search_key" value="{{$search_key}}" class="form-control form-control-sm" onkeyup="fillter()">
                                        <span class="input-group-append">
                                            <button type="submit" class="btn btn-sm btn-primary dim">Search</button>
                                        </span>
                                    </div>
                                </div>
                            </div> --}}
                        </form>
                        <div id="table_div">
                            @include('admin.activity_banner.table')
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')

        <script>

            function fillter(){
                $('tbody').addClass('loading')
                var route = "{{route('admin.activity-banner.index')}}";
                var form = $('#search_form').serialize();
                $.ajax({
                    type: 'GET',
                    url: "{{route('admin.activity-banner.index')}}",
                    data: $('#search_form').serialize(),
                    success: function(data) {
                        window.history.pushState("", "", route+'?'+form);
                        $('tbody').removeClass('loading');
                        $('#table_div').html(data);
                        $('[data-toggle="tooltip"]').tooltip();
                    }
                });
            }

        </script>

    @endpush

@endsection
