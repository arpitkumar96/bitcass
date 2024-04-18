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
                <input type="checkbox" name="joinning_status" id="joinning_status" data-toggle="toggle" onchange="getJoinningStatus()" @if(optional($joinning)->status == '1') checked @endif> <br>
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
                        <form action="{{route('admin.joinning.setting.store')}}" method="POST" class="form-example" id="add_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Joinning Bonus (in amount)<span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="commission" class="form-control" value="{{$joinning?$joinning->commission:0}}" placeholder="Enter Joinning Bonus..." required>
                                        @error('commission')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                    <input type="hidden" name="status" id="status" value="{{$joinning?$joinning->status:'0'}}">
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        <x-admin.save-button />
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
            $(getJoinningStatus());

            function getJoinningStatus(){
                if($('#joinning_status').is(":checked")){
                    $('input[type=number]').attr('readonly',false);
                    $('#status').val('1');
                }else{
                    $('input[type=number]').attr('readonly',true);
                    $('#status').val('0');
                }
            }

        </script>

    @endpush

@endsection
