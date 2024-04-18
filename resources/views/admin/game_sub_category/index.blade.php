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
        @can('game_subcategory-create')
            <div class="col-6">
                @if(Route::currentRouteName() == 'admin.game-sub-category.edit')
                    <div class="mt-3 text-right">
                        <x-admin.add-button route="{{route('admin.game-sub-category.index')}}" text="Add Game Sub Category"/>
                    </div>
                @endif
            </div>
        @endcan
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            @isset($edit_game_sub_category)
                @can('game_subcategory-edit')
                    <div class="col-lg-6">
                @else
                    <div class="col-lg-12">
                @endcan
            @else
                @can('game_subcategory-create')
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
                                <th class="text-center">Category</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Image</th>
                                @canany(['game_subcategory-edit', 'game_subcategory-delete'])
                                    <th class="text-center">Action</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($game_sub_categories as $key=>$game_sub_category)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">{{$game_sub_category->category->name}}</td>
                                        <td class="text-center">{{$game_sub_category->name}}</td>
                                        <td class="text-center">
                                            <img src="{{asset('backend/assets/image/game_sub_categories/'.$game_sub_category->image)}}" height="50px" width="50px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';" >
                                        </td>
                                        @canany(['game_subcategory-edit', 'game_subcategory-delete'])
                                            <td class="text-center">
                                                @can('game_subcategory-edit')
                                                    <x-admin.edit-button route="{{route('admin.game-sub-category.edit', $game_sub_category->id)}}" />
                                                @endcan
                                                @can('game_subcategory-delete')
                                                    <x-admin.delete-button route="{{route('admin.game-sub-category.destroy', $game_sub_category->id)}}" id="{{$game_sub_category->id}}" />
                                                @endcan
                                            </td>
                                        @endcanany
                                    </tr>
                                @empty
                                    <x-admin.empty-table />
                                @endforelse
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
            @isset($edit_game_sub_category)
                @can('game_subcategory-edit')
                    <div class="col-lg-6">
                @else
                    <div class="col-lg-12">
                @endcan
            @else
                @can('game_subcategory-create')
                    <div class="col-lg-6">
                @else
                    <div class="col-lg-12">
                @endcan
            @endisset
            @isset($edit_game_sub_category)
                @can('game_subcategory-edit')
                <div class="ibox ">
                    <div class="ibox-content">
                        @isset($edit_game_sub_category)
                            <form action="{{route('admin.game-sub-category.update',$edit_game_sub_category->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                                @method('PUT')
                        @else
                            <form action="{{route('admin.game-sub-category.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                        @endisset
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Game Category <span class="text-danger">*</span></label>
                                        <select name="game_category_id" id="game_category_id" class="form-control select2" onchange="getSubCategory()" required>
                                            <option value="">Select Game Category...</option>
                                            @foreach ($game_categories as $game_category)
                                                <option value="{{$game_category->id}}" @isset($edit_game_sub_category) @if($edit_game_sub_category->game_category_id == $game_category->id) selected @endif @endisset>{{$game_category->name}}</option>
                                            @endforeach
                                        </select>
                                        @error('game_category_id')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                        <span class="text-danger" id="game_category_error"></span>
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name <span class="text-danger">*</span></label>
                                        {{-- <input type="text" name="name" @isset($edit_game_sub_category) value="{{$edit_game_sub_category->name}}" @endisset placeholder="Enter Name..." class="form-control"> --}}
                                        <select name="name" id="name" class="form-control select2" required>
                                            <option value="">Select Subcategory...</option>
                                        </select>
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
                                        <img id="img1" @isset($edit_game_sub_category) src="{{ asset('backend/assets/image/game_sub_categories/'.$edit_game_sub_category->image) }}" @else src="{{asset('backend/assets/image/no-image.png')}}" @endisset alt="" class="mt-2" height="100px" width="100px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';"><br>
                                        @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        @isset($edit_game_sub_category)
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
                @can('game_subcategory-create')
                    <div class="ibox ">
                        <div class="ibox-content">
                            @isset($edit_game_sub_category)
                                <form action="{{route('admin.game-sub-category.update',$edit_game_sub_category->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                                    @method('PUT')
                            @else
                                <form action="{{route('admin.game-sub-category.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                            @endisset
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Game Category <span class="text-danger">*</span></label>
                                            <select name="game_category_id" id="game_category_id" class="form-control select2" onchange="getSubCategory()" required>
                                                <option value="">Select Game Category...</option>
                                                @foreach ($game_categories as $game_category)
                                                    <option value="{{$game_category->id}}" @isset($edit_game_sub_category) @if($edit_game_sub_category->game_category_id == $game_category->id) selected @endif @endisset>{{$game_category->name}}</option>
                                                @endforeach
                                            </select>
                                            @error('game_category_id')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                            <span class="text-danger" id="game_category_error"></span>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            {{-- <input type="text" name="name" @isset($edit_game_sub_category) value="{{$edit_game_sub_category->name}}" @endisset placeholder="Enter Name..." class="form-control"> --}}
                                            <select name="name" id="name" class="form-control select2" required>
                                                <option value="">Select Subcategory...</option>
                                            </select>
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
                                            <img id="img1" @isset($edit_game_sub_category) src="{{ asset('backend/assets/image/game_sub_categories/'.$edit_game_sub_category->image) }}" @else src="{{asset('backend/assets/image/no-image.png')}}" @endisset alt="" class="mt-2" height="100px" width="100px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';"><br>
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            @isset($edit_game_sub_category)
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

            @isset($edit_game_sub_category)
                getSubCategory();
            @endisset

            function getSubCategory(){
                var game_category_id = $('#game_category_id').val();
                $('#game_category_error').text('');
                $.ajax({
                    type: 'POST',
                    url: "{{route('admin.get.subcategory.by.categoryid')}}",
                    data: {
                        _token:"{{csrf_token()}}",
                        game_category_id:game_category_id
                    },
                    success: function(data) {
                        $('#name').empty();
                        $('#name').append("<option value=''>Select Subcategory...</option>");
                        @isset($edit_game_sub_category)
                            var edit_subcategory_name = "{{$edit_game_sub_category->name}}";
                        @else
                            var edit_subcategory_name = null;
                        @endisset
                        $.each(data.subcategories, function(key,val) {
                            if(edit_subcategory_name == val){
                                $('#name').append('<option value="'+val+'" selected>'+val+'</option>');
                            }else{
                                $('#name').append('<option value="'+val+'">'+val+'</option>');
                            }
                        });
                    },error: function(request, status, error) {
                        $('#game_category_error').text(request.responseJSON.message);
                    }
                });
            }

        </script>
    @endpush

@endsection
