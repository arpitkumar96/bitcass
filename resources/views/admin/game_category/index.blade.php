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
        @can('game_category-create')
            <div class="col-6">
                @if(Route::currentRouteName() == 'admin.game-category.edit')
                    <div class="mt-3 text-right">
                        <x-admin.add-button route="{{route('admin.game-category.index')}}" text="Add Game Category"/>
                    </div>
                @endif
            </div>
        @endcan
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            @isset($edit_game_category)
                @can('game_category-edit')
                    <div class="col-lg-6">
                @else
                    <div class="col-lg-12">
                @endcan
            @else
                @can('game_category-create')
                    <div class="col-lg-6">
                @else
                    <div class="col-lg-12">
                @endcan
            @endisset
                <div class="ibox">
                    <div class="ibox-content">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">#</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Image</th>
                                @canany(['game_category-edit', 'game_category-delete'])
                                    <th class="text-center">Action</th>
                                @endcanany
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($game_categories as $key=>$game_category)
                                    <tr>
                                        <td class="text-center">{{$key + 1}}</td>
                                        <td class="text-center">{{$game_category->name}}</td>
                                        <td class="text-center">
                                            <img src="{{asset('backend/assets/image/game_categories/'.$game_category->image)}}" height="50px" width="50px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';" >
                                        </td>
                                        @canany(['game_category-edit', 'game_category-delete'])
                                            <td class="text-center">
                                                @can('game_category-edit')
                                                    <x-admin.edit-button route="{{route('admin.game-category.edit', $game_category->id)}}" />
                                                @endcan
                                                @can('game_category-delete')
                                                    <x-admin.delete-button route="{{route('admin.game-category.destroy', $game_category->id)}}" id="{{$game_category->id}}" />
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
            @isset($edit_game_category)
                @can('game_category-edit')
                    <div class="col-lg-6">
                @else
                    <div class="col-lg-12">
                @endcan
            @else
                @can('game_category-create')
                    <div class="col-lg-6">
                @else
                    <div class="col-lg-12">
                @endcan
            @endisset
            @isset($edit_game_category)
                @can('game_category-edit')
                    <div class="ibox ">
                        <div class="ibox-content">
                            @isset($edit_game_category)
                                <form action="{{route('admin.game-category.update',$edit_game_category->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                                    @method('PUT')
                            @else
                                <form action="{{route('admin.game-category.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                            @endisset
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            {{-- <input type="text" name="name" @isset($edit_game_category) value="{{$edit_game_category->name}}" @endisset placeholder="Enter Name..." class="form-control"> --}}
                                            <select name="name" id="name" class="form-control select2" required>
                                                <option value="">Select Category</option>
                                                <option value="Lottery" @isset($edit_game_category) @if($edit_game_category->name == 'Lottery') selected @endif @endisset>Lottery</option>
                                                <option value="Original" @isset($edit_game_category) @if($edit_game_category->name == 'Original') selected @endif @endisset>Original</option>
                                                <option value="Slot" @isset($edit_game_category) @if($edit_game_category->name == 'Slot') selected @endif @endisset>Slot</option>
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
                                                <input id="image" type="file" name="image" class="custom-file-input" required>
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <img id="img1" @isset($edit_game_category) src="{{ asset('backend/assets/image/game_categories/'.$edit_game_category->image) }}" @else src="{{asset('backend/assets/image/no-image.png')}}" @endisset alt="" class="mt-2" height="100px" width="100px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';"><br>
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            @isset($edit_game_category)
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
                @can('game_category-create')
                    <div class="ibox ">
                        <div class="ibox-content">
                            @isset($edit_game_category)
                                <form action="{{route('admin.game-category.update',$edit_game_category->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                                    @method('PUT')
                            @else
                                <form action="{{route('admin.game-category.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                            @endisset
                                @csrf
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group">
                                            <label>Name <span class="text-danger">*</span></label>
                                            {{-- <input type="text" name="name" @isset($edit_game_category) value="{{$edit_game_category->name}}" @endisset placeholder="Enter Name..." class="form-control"> --}}
                                            <select name="name" id="name" class="form-control select2" required>
                                                <option value="">Select Category</option>
                                                <option value="Lottery" @isset($edit_game_category) @if($edit_game_category->name == 'Lottery') selected @endif @endisset>Lottery</option>
                                                <option value="Original" @isset($edit_game_category) @if($edit_game_category->name == 'Original') selected @endif @endisset>Original</option>
                                                <option value="Slot" @isset($edit_game_category) @if($edit_game_category->name == 'Slot') selected @endif @endisset>Slot</option>
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
                                                <input id="image" type="file" name="image" class="custom-file-input" required>
                                                <label class="custom-file-label" for="image">Choose file</label>
                                            </div>
                                            <img id="img1" @isset($edit_game_category) src="{{ asset('backend/assets/image/game_categories/'.$edit_game_category->image) }}" @else src="{{asset('backend/assets/image/no-image.png')}}" @endisset alt="" class="mt-2" height="100px" width="100px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';"><br>
                                            @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="col-md-12 text-center">
                                        <div class="form-group">
                                            @isset($edit_game_category)
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
