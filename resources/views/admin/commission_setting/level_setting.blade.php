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
            @if(Route::currentRouteName() == 'admin.level.setting.edit')
                <div class="mt-3 text-right">
                    <x-admin.add-button route="{{route('admin.level.setting')}}" text="Add Level"/>
                </div>
            @endif
        </div>
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-8">
                <div class="ibox ">
                    <div class="ibox-content">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-center">Level</th>
                                <th class="text-center">Name</th>
                                <th class="text-center">Image</th>
                                <th class="text-center">Team Number</th>
                                <th class="text-center">Team Betting</th>
                                <th class="text-center">Team Deposite</th>
                                <th class="text-center">Action</th>
                            </tr>
                            </thead>
                            <tbody>
                                @forelse ($level_settings as $key=>$level_setting)
                                    <tr>
                                        <td class="text-center">{{$level_setting->level}}</td>
                                        <td class="text-center">{{$level_setting->name}}</td>
                                        <td class="text-center">
                                            <img src="{{asset('backend/assets/image/level_settings/'.$level_setting->image)}}" height="50px" width="50px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';">
                                        </td>
                                        <td class="text-center">{{abreviateTotalCount($level_setting->team_number)}}</td>
                                        <td class="text-center">{{abreviateTotalCount($level_setting->team_betting)}}</td>
                                        <td class="text-center">{{abreviateTotalCount($level_setting->team_deposite)}}</td>
                                        <td class="text-center">
                                            <x-admin.edit-button route="{{route('admin.level.setting.edit', $level_setting->id)}}" />
                                            <x-admin.delete-button route="{{route('admin.level.setting.delete', $level_setting->id)}}" id="{{$level_setting->id}}" />
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
            <div class="col-lg-4">
                <div class="ibox ">
                    <div class="ibox-content">
                        @isset($edit_level_setting)
                            <form action="{{route('admin.level.setting.update',$edit_level_setting->id)}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                                @method('PUT')
                        @else
                            <form action="{{route('admin.level.setting.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="add_form">
                        @endisset
                            @csrf
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Name</label>
                                        <input type="text" name="name" @isset($edit_level_setting) value="{{old('name',$edit_level_setting->name)}}" @else value="{{old('name')}}" @endisset placeholder="Enter Name..." class="form-control" required>
                                        @error('name')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Image <span class="text-danger">*</span></label>
                                        <div class="custom-file">
                                            <input id="image" type="file" name="image" class="custom-file-input">
                                            <label class="custom-file-label" for="image">Choose file</label>
                                        </div>
                                        <img id="img1" @isset($edit_level_setting) src="{{ asset('backend/assets/image/level_settings/'.$edit_level_setting->image) }}" @else src="{{ asset('backend/assets/image/no-image.png') }}" @endisset alt="" class="mt-2" height="100px" width="100px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';"><br>
                                        @error('image')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Team Number</label>
                                        <input type="number" step="0.1" name="team_number" @isset($edit_level_setting) value="{{old('team_number',$edit_level_setting->team_number)}}" @else value="{{old('team_number')}}" @endisset placeholder="Enter Team Number..." class="form-control" required>
                                        @error('team_number')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Team Betting</label>
                                        <input type="number" step="0.1" name="team_betting" @isset($edit_level_setting) value="{{old('team_betting',$edit_level_setting->team_betting)}}" @else value="{{old('team_betting')}}" @endisset placeholder="Enter Team Betting..." class="form-control" required>
                                        @error('team_betting')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label>Team Deposite</label>
                                        <input type="number" step="0.1" name="team_deposite" @isset($edit_level_setting) value="{{old('team_deposite',$edit_level_setting->team_deposite)}}" @else value="{{old('team_deposite')}}" @endisset placeholder="Enter Team Deposite..." class="form-control" required>
                                        @error('team_deposite')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-12 text-center">
                                    <div class="form-group">
                                        @isset($edit_level_setting)
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
