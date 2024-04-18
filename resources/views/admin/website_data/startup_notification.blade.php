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
        <div class="col-6 text-right">
            <ol class="mt-4">
                <input type="checkbox" name="status" id="status" data-toggle="toggle" onchange="getStatus()" @if(optional($notification)->status == '1') checked @endif> <br>
                @error('status')
                    <span class="text-danger">{{$message}}</span>
                @enderror
            </ol>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <form action="{{route('admin.startup.notification.store')}}" method="POST" class="form-example" id="update_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Startup Notification</label>
                                        <textarea name="startup_notification" id="startup_notification" class="form-control summernote">{{optional($notification)->data}}</textarea>
                                        @error('startup_notification')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="status_val" id="status_val" value="{{$notification?$notification->status:'0'}}">
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <x-admin.update-button />
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>

    @push('js')

        <script>
            $(getStatus());

            function getStatus(){
                if($('#status').is(":checked")){
                    $('#status_val').val('1');
                    $('.summernote').summernote('enable');
                }else{
                    $('#status_val').val('0');
                    $('.summernote').summernote('disable');
                }
            }

        </script>

    @endpush

@endsection
