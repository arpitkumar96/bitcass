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
        @can('payment_channel-create')
            <div class="col-6">
                @if(Route::currentRouteName() == 'admin.channel.edit')
                    <div class="mt-3 text-right">
                        <x-admin.add-button route="{{route('admin.channel.index')}}" text="Add Channel"/>
                    </div>
                @endif
            </div>
        @endcan
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            @isset($edit_channel)
                @can('payment_channel-edit')
                    <div class="col-lg-8">
                @else
                    <div class="col-lg-12">
                @endcan
            @else
                @can('payment_channel-create')
                    <div class="col-lg-8">
                @else
                    <div class="col-lg-12">
                @endcan
            @endisset
                <div class="ibox ">
                    <div class="ibox-content">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Payment Type</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">UPI ID</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Status</th>
                                @can('payment_channel-edit')
                                    <th class="text-center">Action</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($channels as $key=>$channel)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">{{$channel->paymentType->name}}</td>
                                        <td class="text-center">{{$channel->name}}</td>
                                        <td class="text-center">{{$channel->upi_id}}</td>
                                        <td class="text-center">
                                            <img src="{{asset('backend/assets/image/channels/'.$channel->image)}}" height="50px" width="50px">
                                        </td>
                                        <td class="text-center">
                                            @if($channel->status == '1')
                                                @can('payment_channel-status')
                                                    <a href="{{route('admin.channel.show',$channel->id)}}?status=0">
                                                        <span class="badge badge-primary">Active</span>
                                                    </a>
                                                @else
                                                    <span class="badge badge-primary">Active</span>
                                                @endcan
                                            @else
                                                @can('payment_channel-status')
                                                    <a href="{{route('admin.channel.show',$channel->id)}}?status=1">
                                                        <span class="badge badge-danger">Inactive</span>
                                                    </a>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endcan
                                            @endif
                                        </td>
                                        @can('payment_channel-edit')
                                            <td class="text-center">
                                                <x-admin.edit-button route="{{route('admin.channel.edit', $channel->id)}}" />
                                            </td>
                                        @endcan
                                    </tr>
                                @empty
                                    <x-admin.empty-table />
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @isset($edit_channel)
                @can('payment_channel-edit')
                    <div class="col-lg-4">
                @else
                    <div class="col-lg-12">
                @endcan
            @else
                @can('payment_channel-create')
                    <div class="col-lg-4">
                @else
                    <div class="col-lg-12">
                @endcan
            @endisset
            @isset($edit_channel)
                @can('payment_channel-edit')
                    <div class="ibox ">
                        <div class="ibox-content">
                            @isset($edit_channel)
                                <form action="{{route('admin.channel.update',$edit_channel->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                                    @method('PUT')
                            @else
                                <form action="{{route('admin.channel.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                            @endisset
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Payment Type <span class="text-danger">*</span></label>
                                            <select name="payment_type_id" id="payment_type_id" class="form-control select2" required>
                                                <option value="">Select Payment Type</option>
                                                @foreach (App\Models\PaymentType::all() as $payment_type)
                                                    <option value="{{$payment_type->id}}" @isset($edit_channel) @if(old('payment_type_id',$edit_channel->payment_type_id) == $payment_type->id) selected @endif @else @if(old('payment_type_id') == $payment_type->id) selected @endif @endisset>{{$payment_type->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_type_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" @isset($edit_channel) value="{{$edit_channel->name}}" @endisset placeholder="Enter Name..." class="form-control" required>
                                            @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>UPI ID <span class="text-danger">*</span></label>
                                            <input type="text" name="upi_id" @isset($edit_channel) value="{{$edit_channel->upi_id}}" @endisset placeholder="Enter UPI ID..." class="form-control" required>
                                            @error('upi_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>QR @isset($edit_channel) @else <span class="text-danger">*</span> @endisset</label>
                                            <div class="custom-file">
                                                <input id="image" type="file" name="image" class="custom-file-input">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <img id="img1" @isset($edit_channel) src="{{ asset('backend/assets/image/channels/'.$edit_channel->image) }}" @else src="{{ asset('backend/assets/image/no-image.png') }}" @endisset alt="" class="mt-2" height="100px" width="100px"><br>
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            @isset($edit_channel)
                                                <x-admin.update-button />
                                            @else
                                                <x-admin.save-button />
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endcan
            @else
                @can('payment_channel-create')
                    <div class="ibox ">
                        <div class="ibox-content">
                            @isset($edit_channel)
                                <form action="{{route('admin.channel.update',$edit_channel->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                                    @method('PUT')
                            @else
                                <form action="{{route('admin.channel.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                            @endisset
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Payment Type <span class="text-danger">*</span></label>
                                            <select name="payment_type_id" id="payment_type_id" class="form-control select2" required>
                                                <option value="">Select Payment Type</option>
                                                @foreach (App\Models\PaymentType::all() as $payment_type)
                                                    <option value="{{$payment_type->id}}" @isset($edit_channel) @if(old('payment_type_id',$edit_channel->payment_type_id) == $payment_type->id) selected @endif @else @if(old('payment_type_id') == $payment_type->id) selected @endif @endisset>{{$payment_type->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('payment_type_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" @isset($edit_channel) value="{{$edit_channel->name}}" @endisset placeholder="Enter Name..." class="form-control" required>
                                            @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>UPI ID <span class="text-danger">*</span></label>
                                            <input type="text" name="upi_id" @isset($edit_channel) value="{{$edit_channel->upi_id}}" @endisset placeholder="Enter UPI ID..." class="form-control" required>
                                            @error('upi_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>QR @isset($edit_channel) @else <span class="text-danger">*</span> @endisset</label>
                                            <div class="custom-file">
                                                <input id="image" type="file" name="image" class="custom-file-input">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <img id="img1" @isset($edit_channel) src="{{ asset('backend/assets/image/channels/'.$edit_channel->image) }}" @else src="{{ asset('backend/assets/image/no-image.png') }}" @endisset alt="" class="mt-2" height="100px" width="100px"><br>
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            @isset($edit_channel)
                                                <x-admin.update-button />
                                            @else
                                                <x-admin.save-button />
                                            @endisset
                                        </div>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                @endcan
            @endisset
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
