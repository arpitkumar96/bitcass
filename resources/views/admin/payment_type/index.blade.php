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
        @can('payment_type-create')
            <div class="col-6">
                @if(Route::currentRouteName() == 'admin.payment-type.edit')
                    <div class="mt-3 text-right">
                        <x-admin.add-button route="{{route('admin.payment-type.index')}}" text="Add Payment Type"/>
                    </div>
                @endif
            </div>
        @endcan
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            @isset($edit_payment_type)
                @can('payment_type-edit')
                    <div class="col-lg-6">
                @else
                    <div class="col-lg-12">
                @endcan
            @else
                @can('payment_type-create')
                    <div class="col-lg-6">
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
                                <th class="text-center">Name</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Status</th>
                                @can('payment_type-edit')
                                    <th class="text-center">Action</th>
                                @endcan
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($payment_types as $key=>$payment_type)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">{{$payment_type->name}}</td>
                                        <td class="text-center">
                                            <img src="{{asset('backend/assets/image/payment_types/'.$payment_type->image)}}" height="50px" width="50px">
                                        </td>
                                        <td class="text-center">
                                            @if($payment_type->status == '1')
                                                @can('payment_type-status')
                                                    <a href="{{route('admin.payment-type.show',$payment_type->id)}}?status=0">
                                                        <span class="badge badge-primary">Active</span>
                                                    </a>
                                                @else
                                                    <span class="badge badge-primary">Active</span>
                                                @endcan
                                            @else
                                                @can('payment_type-status')
                                                    <a href="{{route('admin.payment-type.show',$payment_type->id)}}?status=1">
                                                        <span class="badge badge-danger">Inactive</span>
                                                    </a>
                                                @else
                                                    <span class="badge badge-danger">Inactive</span>
                                                @endcan
                                            @endif
                                        </td>
                                        @can('payment_type-edit')
                                            <td class="text-center">
                                                <x-admin.edit-button route="{{route('admin.payment-type.edit', $payment_type->id)}}" />
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
            @isset($edit_payment_type)
                @can('payment_type-edit')
                    <div class="col-lg-6">
                @else
                    <div class="col-lg-12">
                @endcan
            @else
                @can('payment_type-create')
                    <div class="col-lg-6">
                @else
                    <div class="col-lg-12">
                @endcan
            @endisset
            @isset($edit_payment_type)
                @can('payment_type-edit')
                    <div class="ibox ">
                        <div class="ibox-content">
                            @isset($edit_payment_type)
                                <form action="{{route('admin.payment-type.update',$edit_payment_type->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                                    @method('PUT')
                            @else
                                <form action="{{route('admin.payment-type.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                            @endisset
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" @isset($edit_payment_type) value="{{$edit_payment_type->name}}" @endisset placeholder="Enter Name..." class="form-control" required>
                                            @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <div class="custom-file">
                                                <input id="image" type="file" name="image" class="custom-file-input">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <img id="img1" @isset($edit_payment_type) src="{{ asset('backend/assets/image/payment_types/'.$edit_payment_type->image) }}" @else src="{{ asset('backend/assets/image/no-image.png') }}" @endisset alt="" class="mt-2" height="100px" width="100px"><br>
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            @isset($edit_payment_type)
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
                @can('payment_type-create')
                    <div class="ibox ">
                        <div class="ibox-content">
                            @isset($edit_payment_type)
                                <form action="{{route('admin.payment-type.update',$edit_payment_type->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                                    @method('PUT')
                            @else
                                <form action="{{route('admin.payment-type.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                            @endisset
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            <input type="text" name="name" @isset($edit_payment_type) value="{{$edit_payment_type->name}}" @endisset placeholder="Enter Name..." class="form-control" required>
                                            @error('name')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Image</label>
                                            <div class="custom-file">
                                                <input id="image" type="file" name="image" class="custom-file-input">
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <img id="img1" @isset($edit_payment_type) src="{{ asset('backend/assets/image/payment_types/'.$edit_payment_type->image) }}" @else src="{{ asset('backend/assets/image/no-image.png') }}" @endisset alt="" class="mt-2" height="100px" width="100px"><br>
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            @isset($edit_payment_type)
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
