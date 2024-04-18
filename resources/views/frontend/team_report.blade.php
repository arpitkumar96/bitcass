@extends('frontend.layouts.app')
@section('content')
    <section class="about-section padding-top bg_img padding-bottom overflow-hidden mt-3"
        style="background: url({{ asset('frontend/assets/images/top/bg.png') }});"> <br>
        <div class="container">
            <div class="row gy-2 gx-2 mb-3">
                <div class="col-md-12">
                    <div class="input-group rounded">
                        <input type="search" class="form-control form--control rounded" placeholder="Search subordinate UID"
                            aria-label="Search" aria-describedby="search-addon" />
                        <span class="input-group-text border-0" id="search-addon">
                            <i class="fas fa-search"></i>
                        </span>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <select class="form-control form--control" aria-label="Default select example">
                            <option selected>All</option>
                            <option value="1">One</option>
                            <option value="2">Two</option>
                            <option value="3">Three</option>
                        </select>
                    </div>
                </div>
                <div class="col-md-6">
                    <div class="form-group">
                        <input id="date" type="date" class="form-control form--control">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="content">
                    <div class="commission">
                        <div class="commission__body">
                            <div>
                                <span>{{$deposite_count}}</span>
                                <span>Deposit number</span>
                            </div><span></span>
                            <div>
                                <span>{{$deposite_sum}}</span>
                                <span>Deposit amount</span>
                            </div>
                        </div>
                        <div class="commission__body">
                            <div>
                                <span>{{$game_participation_count}}</span>
                                <span>Number of bettors</span>
                            </div><span></span>
                            <div>
                                <span>{{$game_participation_sum}}</span>
                                <span>Total bet</span>
                            </div>
                        </div>
                        {{-- <div class="commission__body">
                            <div>
                                <span>0</span>
                                <span>Number of people making first deposit</span>
                            </div><span></span>
                            <div>
                                <span>0</span>
                                <span>First deposit amount</span>
                            </div>
                        </div> --}}
                    </div>
                </div>
                <div class="record__main">
                    <div>
                        @forelse ($teams as $team)
                            <div class="record__main-info">
                                <div class="record__main-info__title flex_between">
                                    <div>UID:{{$team->user_id}} <a href="#"> <i class="fa fa-copy"></i> </a></div>
                                </div>
                                <div class="record__main-info__money item flex_between">
                                    <span>Level</span><span>{{$team->level}}</span>
                                </div>

                                <div class="record__main-info__time item flex_between">
                                    <span>Deposit amount</span><span>{{$team->deposite_sum_amount}}</span>
                                </div>

                                <div class="record__main-info__time item flex_between">
                                    <span>Commission</span><span>{{$team->commission_sum_commission??0}}</span>
                                </div>

                                <div class="record__main-info__time item flex_between">
                                    <span>Time</span><span>{{$team->created_at}}</span>
                                </div>
                            </div>
                        @empty

                        @endforelse
                    </div>
                </div>
            </div>
        </div><br><br>
    </section>
@endsection
