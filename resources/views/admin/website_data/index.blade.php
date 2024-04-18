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
    </div>
    <div class="wrapper wrapper-content">
        <div class="row">
            <div class="col-lg-12">
                <div class="ibox ">
                    <div class="ibox-content">
                        <form action="{{route('admin.website.data.store')}}" method="POST" enctype="multipart/form-data" class="form-example" id="update_form">
                            @csrf
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Logo</label>
                                        <div class="custom-file">
                                            <input id="logo" type="file" name="logo" class="custom-file-input">
                                            <label class="custom-file-label" for="logo">Choose file</label>
                                        </div>
                                        @php
                                            if(isset($website_data['logo'])){
                                                $logo = $website_data['logo'];
                                            }else{
                                                $logo = null;
                                            }
                                        @endphp
                                        <img id="logo_preview" src="{{asset('backend/assets/image/website_data/'.$logo)}}" alt="" class="mt-2" height="100px" width="200px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';"><br>
                                        @error('logo')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Small Logo</label>
                                        <div class="custom-file">
                                            <input id="small_logo" type="file" name="small_logo" class="custom-file-input">
                                            <label class="custom-file-label" for="small_logo">Choose file</label>
                                        </div>
                                        @php
                                            if(isset($website_data['small_logo'])){
                                                $small_logo = $website_data['small_logo'];
                                            }else{
                                                $small_logo = null;
                                            }
                                        @endphp
                                        <img id="small_logo_preview" src="{{asset('backend/assets/image/website_data/'.$small_logo)}}" alt="" class="mt-2" height="100px" width="100px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';"><br>
                                        @error('small_logo')
                                            <span class="text-danger">{{$message}}</span>
                                        @enderror
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label>Favicon</label>
                                        <div class="custom-file">
                                            <input id="favicon" type="file" name="favicon" class="custom-file-input">
                                            <label class="custom-file-label" for="favicon">Choose file</label>
                                        </div>
                                        @php
                                            if(isset($website_data['favicon'])){
                                                $favicon = $website_data['favicon'];
                                            }else{
                                                $favicon = null;
                                            }
                                        @endphp
                                        <img id="favicon_preview" src="{{asset('backend/assets/image/website_data/'.$favicon)}}" alt="" class="mt-2" height="50px" width="50px" onerror="this.onerror=null;this.src='{{asset('backend/assets/image/no-image.png')}}';"><br>
                                        @error('favicon')
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
            logo.onchange = evt => {
                const [file] = logo.files
                if (file) {
                    logo_preview.src = URL.createObjectURL(file)
                }
            }

            small_logo.onchange = evt => {
                const [file] = small_logo.files
                if (file) {
                    small_logo_preview.src = URL.createObjectURL(file)
                }
            }

            favicon.onchange = evt => {
                const [file] = favicon.files
                if (file) {
                    favicon_preview.src = URL.createObjectURL(file)
                }
            }
        </script>
    @endpush

@endsection
