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
                <input type="checkbox" name="recharge_status" id="recharge_status" data-toggle="toggle" onchange="getRechargeStatus()" @if(optional($recharge)->status == '1') checked @endif> <br>
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
                        <form action="{{route('admin.recharge.setting.store')}}" method="POST" class="form-example" id="add_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Level<span class="text-danger">*</span></label>
                                        <select name="level" id="level" class="form-control select" onchange="getCommissionTable()" required>
                                            @foreach ($levels as $level)
                                                <option value="{{$level->level}}" @if(optional($recharge)->level == $level->level) selected @endif>{{$level->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('level')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Tier<span class="text-danger">*</span></label>
                                        <select name="tier" id="tier" class="form-control select" onchange="getCommissionTable()" required>
                                            @for ($i = 1; $i <= 10; $i++)
                                                <option value="{{$i}}" @if(optional($recharge)->tier == $i) selected @endif>{{$i}}</option>
                                            @endfor
                                        </select>
                                        @error('tier')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <input type="hidden" name="status" id="status" value="{{$recharge?$recharge->status:'0'}}">
                                <div class="col-md-12" id="table_div">

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
            $(getCommissionTable());
            function getCommissionTable(){
                var number_of_level = $('#level').val();
                var number_of_tier = $('#tier').val();

                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.recharge.table') }}",
                    data: {
                        _token:"{{csrf_token()}}",
                        number_of_level:number_of_level,
                        number_of_tier:number_of_tier,
                    },
                    success: function(data) {
                        $('#table_div').html(data.view);
                        getRechargeStatus();
                    }
                });
            }

            function getRechargeStatus(){
                var number_of_level = $('#level').val();
                var number_of_tier = $('#tier').val();

                if($('#recharge_status').is(":checked")){
                    $('.select').prop('disabled',false);
                    $('input[type=number]').attr('readonly',false);
                    $('#status').val('1');
                }else{
                    $('.select').prop('disabled',true);
                    $('input[type=number]').attr('readonly',true);
                    $('#status').val('0');
                    $('form').append('<input type="hidden" name="level" id="disabled_level" value="'+number_of_level+'">');
                    $('form').append('<input type="hidden" name="tier" id="disabled_tier" value="'+number_of_tier+'">');
                }
                $('#disabled_level').remove();
                $('#disabled_tier').remove();
            }

        </script>

    @endpush

@endsection
