@extends('admin.layouts.app')
@section('content')
    @push('css')

        <style>
            .input-form-control:focus, .single-line:focus {
                border-color: #1ab394;
            }
            .input-form-control:focus-visible {
                outline: 0px;
            }
            .input-form-control{
                width: 70px;
                text-align: center;
                background-color: #FFFFFF;
                background-image: none;
                border: 1px solid #e5e6e7;
                border-radius: 1px;
                color: inherit;
                display: block;
                padding: 6px 12px;
                transition: border-color 0.15s ease-in-out 0s, box-shadow 0.15s ease-in-out 0s;
            }
        </style>

    @endpush
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
                <input type="checkbox" name="first_recharge_self_status" id="first_recharge_self_status" data-toggle="toggle" onchange="getFirstRechargeSelfStatus()" @if(optional($first_recharge_self)->status == '1') checked @endif> <br>
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
                        <form action="{{route('admin.first.recharge.self.setting.store')}}" method="POST" class="form-example" id="add_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>First Recharge Self Bonus (in amount)<span class="text-danger">*</span></label>
                                        <div class="input-group">
                                            <input type="number" step="0.01" name="commission" class="form-control" value="{{$first_recharge_self?$first_recharge_self->commission:0}}" placeholder="Enter First Recharge Self Bonus..." required>
                                            @error('commission')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <select name="method" class="input-form-control select" id="method">
                                                <option value="percent" @if(optional($first_recharge_self)->method == 'percent') selected @endif>%</option>
                                                <option value="amount" @if(optional($first_recharge_self)->method == 'amount') selected @endif>₹</option>
                                            </select>
                                        </div>
                                    </div>
                                    <input type="hidden" name="status" id="status" value="{{$first_recharge_self?$first_recharge_self->status:'0'}}">
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
            $(getFirstRechargeSelfStatus());

            function getFirstRechargeSelfStatus(){
                var method=$('#method').val();
                if($('#first_recharge_self_status').is(":checked")){
                    $('.select').prop('disabled',false);
                    $('input[type=number]').attr('readonly',false);
                    $('#status').val('1');
                }else{
                    $('.select').prop('disabled',true);
                    $('input[type=number]').attr('readonly',true);
                    $('#status').val('0');
                    $('form').append('<input type="hidden" name="method" id="disabled_method" value="'+method+'">');
                }
                $('#disabled_method').remove();
            }

        </script>

    @endpush

@endsection
