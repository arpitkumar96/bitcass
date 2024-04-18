@extends('frontend.layouts.app')
@section('content')
    <!-- Profile Section Starts Here -->
    <section class="profile-section padding-top bg_img padding-bottom mt-5" style="background: url({{ asset('frontend/assets/images/top/bg.png') }});">
        <div class="container">
            <div class="profile-edit-wrapper">
                <form action="#" method="POST" >
                    <div class="row">
                        <div class="col-xl-12">
                            <div class="profile__thumb__edit text-center custom--card">
                                <div class="card--body">
                                    <div class="thumb">
                                        <img src="{{ asset('frontend/assets/images/dashboard/user.png') }}" class="userAvatar">
                                    </div>
                                    <div class="profile__info">
                                        <h4 class="name">Demo User</h4>
                                        <p class="username">UID | {{ Auth::guard('web')->user()->user_id }} <i class="las la-copy"></i></p>
                                        <input type="file" class="form-control d-none" id="update-photo">
                                        <label for="update-photo">Update Profile Picture</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-xl-12 mt-2 mb-5">
                            <div class="custom--card card--lg">
                                <div class="card--body">
                                    <div class="row gy-3">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="uname" class="form-label">Name</label>
                                                <input id="text" type="uname" class="form-control form--control style-two" value="" placeholder="Name">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="password" class="form-label">old Password</label>
                                                <div class="input-profile-icon"><i class="las la-lock"></i></div>
                                                <input id="password" type="text" class="form-control form--control style--two" value="" placeholder="old Password">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="new_password" class="form-label">New Login Password</label>
                                                <div class="input-profile-icon"><i class="las la-lock"></i></div>
                                                <input id="new_password" type="text" class="form-control form--control style--two" value="" placeholder="New Password">
                                            </div>
                                        </div>

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="confirm_new_password" class="form-label">Confirm New Password</label>
                                                <div class="input-profile-icon"><i class="las la-lock"></i></div>
                                                <input id="confirm_new_password" type="text" class="form-control form--control style--two" value="" placeholder="Confirm Password">
                                            </div>
                                        </div>

                                        <div class="col">
                                            <button type="submit">Update Profile</button>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
