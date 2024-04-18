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
                {{-- <li class="breadcrumb-item active">
                    <strong>Basic Form</strong>
                </li> --}}
            </ol>
        </div>
        <div class="col-6">
            <div class="mt-3 text-right">
                <x-admin.back-button route="{{route('admin.game.index')}}" />
            </div>
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <form action="{{route('admin.game.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Category <span class="text-danger">*</span></label>
                                        <select name="game_category_id" id="game_category_id" class="form-control select2" onchange="getSubCategory()" required>
                                            <option value="">Select Category...</option>
                                            @foreach ($categories as $category)
                                                <option value="{{$category->id}}">{{$category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('game_category_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Sub Category</label>
                                        <select name="game_sub_category_id" id="game_sub_category_id" class="form-control select2">
                                            <option value="">Select Sub Category...</option>
                                        </select>
                                        @error('game_sub_category_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        <input type="text" name="name" class="form-control" placeholder="Enter Name..." required>
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Duration <span class="text-danger">*</span></label>
                                        <select name="duration" id="duration" class="form-control">
                                            <option value="1">1 min.</option>
                                            <option value="3">3 min.</option>
                                            <option value="5">5 min.</option>
                                            <option value="10">10 min.</option>
                                        </select>
                                        @error('duration')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label>Image</label>
                                        <div class="custom-file">
                                            <input id="image" type="file" name="image" class="custom-file-input">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        <img id="img1" src="{{asset('backend/assets/image/no-image.png')}}" alt="" class="mt-2" height="100px" width="100px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';"><br>
                                        @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>How to Paly</label>
                                        <textarea name="how_to_play" class="form-control summernote"></textarea>
                                        @error('how_to_play')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
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
            image.onchange = evt => {
                const [file] = image.files
                if (file) {
                    img1.src = URL.createObjectURL(file)
                }
            }

            function getSubCategory(){
                var category_id = $('#game_category_id').val();
                $.ajax({
                    type: 'POST',
                    url: "{{ route('admin.get.sub.category.by.category') }}",
                    data: {
                        _token:"{{csrf_token()}}",
                        category_id:category_id
                    },
                    success: function(data) {
                        $('#game_sub_category_id').empty();
                        $('#game_sub_category_id').append('<option value="">Select Sub Category...</option>');
                        $.each(data.sub_categories, function(key, val) {
                            $('#game_sub_category_id').append("<option value="+val.id+" >"+val.name+"</option>");
                        });
                    }
                });
            }
        </script>
    @endpush

@endsection
