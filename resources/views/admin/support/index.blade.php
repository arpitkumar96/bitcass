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
            @if(Route::currentRouteName() == 'admin.support.edit')
            <div class="mt-3 text-right">
                <x-admin.add-button route="{{route('admin.support.index')}}" text="Add Support"/>
            </div>
            @endif
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-6">
                <div class="ibox ">
                    {{-- <div class="ibox-title">

                    </div> --}}
                    <div class="ibox-content">

                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Url</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($supports as $key=>$support)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">{{$support->name}}</td>
                                        <td class="text-center">
                                            <img src="{{asset('backend/assets/image/supports/'.$support->image)}}" height="50px" width="100px">
                                        </td>
                                        <td class="text-center">
                                            <a href="{{$support->url}}" target="_blank">
                                                {{$support->url}}
                                            </a>
                                        </td>
                                        <td class="text-center">
                                            <x-admin.edit-button route="{{route('admin.support.edit', $support->id)}}" />
                                            <x-admin.delete-button route="{{route('admin.support.destroy', $support->id)}}" id="{{$support->id}}" />
                                        </td>
                                    </tr>
                                @empty
                                    <x-admin.empty-table />
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            <div class="col-lg-6">
                <div class="ibox ">
                    <div class="ibox-content">
                        @isset($edit_support)
                            <form action="{{route('admin.support.update',$edit_support->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                                @method('PUT')
                        @else
                            <form action="{{route('admin.support.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                        @endisset
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" @isset($edit_support) value="{{$edit_support->name}}" @endisset placeholder="Enter Name..." class="form-control">
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image <span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input id="image" type="file" name="image" class="custom-file-input" @isset($edit_support) @else required @endisset>
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        <img id="img1" @isset($edit_support) src="{{ asset('backend/assets/image/supports/'.$edit_support->image) }}" @else src="{{ asset('backend/assets/image/no-image.png') }}" @endisset alt="" class="mt-2" height="100px" width="200px"><br>
                                        @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Url</label>
                                        <input type="url" name="url" @isset($edit_support) value="{{$edit_support->url}}" @endisset placeholder="Enter Url..." class="form-control">
                                        @error('url')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        @isset($edit_support)
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
