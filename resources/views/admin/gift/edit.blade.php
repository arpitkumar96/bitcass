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
        <div class="col-6">
            <div class="mt-3 text-right">
                <x-admin.back-button route="{{route('admin.gift.index')}}" />
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <form action="{{route('admin.gift.update',$gift->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                            @method('PUT')
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Code <span class="text-danger">*</span></label>
                                        <input type="text" id="code" value="{{old('code',$gift->code)}}" placeholder="Enter Code..." class="form-control" readonly>
                                        @error('code')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" id="name" value="{{old('name',$gift->name)}}" placeholder="Enter Name..." class="form-control" required>
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group date_range">
                                        <label class="font-normal">Date <span class="text-danger">*</span></label>
                                        <div class="input-daterange input-group" id="datepicker">
                                            <input type="text" class="form-control-sm form-control" name="start_date" placeholder="Select Start Date..." value="{{old('start_date',date('m/d/Y',strtotime($gift->start_date)))}}" required>
                                            <span class="input-group-addon"><i class="fa fa-calendar"></i></span>
                                            <input type="text" class="form-control-sm form-control" name="end_date" placeholder="Select End Date..." value="{{old('end_date',date('m/d/Y',strtotime($gift->end_date)))}}" required>
                                        </div>
                                        @error('start_date')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        @error('end_date')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Amount <span class="text-danger">*</span></label>
                                        <input type="number" step="0.01" name="amount" id="amount" value="{{old('amount',$gift->amount)}}" placeholder="Enter Amount..." class="form-control" required>
                                        @error('amount')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <div class="custom-file">
                                            <input id="image" type="file" name="image" class="custom-file-input">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        <img id="img1" src="{{asset('backend/assets/image/gifts/'.$gift->image)}}" alt="" class="mt-2" height="100px" width="100px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';"><br>
                                        @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Usage Limitation <span class="text-danger">*</span></label>
                                        <select id="usage_limitation" class="form-control" required onchange="showUsage()" disabled>
                                            <option value="limited" @if(old('usage_limitation',$gift->usage_limitation) == 'limited') selected @endif>Limited</option>
                                            <option value="unlimited" @if(old('usage_limitation',$gift->usage_limitation) == 'unlimited') selected @endif>Unlimited</option>
                                        </select>
                                        @error('usage_limitation')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Number Of Usage <span class="text-danger">*</span></label>
                                        <input type="number" step="0.1" id="number_of_usage" value="{{old('number_of_usage',$gift->number_of_usage)}}" placeholder="Enter Number Of Usage..." class="form-control" readonly>
                                        @error('number_of_usage')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Description</label>
                                        <textarea name="description" id="description" class="form-control" placeholder="Enter Description">{{old('description')}}</textarea>
                                        @error('description')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
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
            image.onchange = evt => {
                const [file] = image.files
                if (file) {
                    img1.src = URL.createObjectURL(file)
                }
            }
        </script>
    @endpush

@endsection
