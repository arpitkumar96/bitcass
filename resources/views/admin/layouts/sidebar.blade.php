<nav class="navbar-default navbar-static-side" role="navigation">
    <div class="sidebar-collapse">
        <ul class="nav metismenu" id="side-menu">
            <li style="padding: 10px;">
                <div class="dropdown profile-element">
                    <a href="{{route('index')}}" target="_blank">
                        <img alt="image" src="{{ asset('backend/assets/image/logo.png') }}" style="height: 50px;width: 100%;" />
                    </a>
                </div>
                <div class="logo-element">
                    <a href="{{route('index')}}" target="_blank">
                        <img alt="image" src="{{ asset('backend/assets/image/small_logo.png') }}" style="height: 50px;width: 100%;" />
                    </a>
                </div>
            </li>
            @can('dashboard')
                <li @if(in_array(Route::currentRouteName(), ['admin.dashboard'])) class="active" @endif>
                    <a href="{{route('admin.dashboard')}}"><i class="fa fa-th-large"></i> <span class="nav-label">Dashboard</span></a>
                </li>
            @endcan

            @canany(['game_category-list','game_subcategory-list','game-list'])
                <li @if(in_array(Route::currentRouteName(), ['admin.game-category.index','admin.game-category.edit','admin.game-sub-category.index','admin.game-sub-category.edit','admin.game.index','admin.game.create','admin.game.edit','admin.played.games','admin.game.participant'])) class="active" @endif>
                    <a href="#"><i class="fa fa-gamepad"></i> <span class="nav-label">Game Management</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('game_category-list')
                            <li @if(in_array(Route::currentRouteName(), ['admin.game-category.index','admin.game-category.edit'])) class="active" @endif>
                                <a href="{{route('admin.game-category.index')}}">Category</a>
                            </li>
                        @endcan
                        @can('game_subcategory-list')
                            <li @if(in_array(Route::currentRouteName(), ['admin.game-sub-category.index','admin.game-sub-category.edit'])) class="active" @endif>
                                <a href="{{route('admin.game-sub-category.index')}}">Sub Category</a>
                            </li>
                        @endcan
                        @can('game-list')
                            <li @if(in_array(Route::currentRouteName(), ['admin.game.index','admin.game.create','admin.game.edit','admin.played.games','admin.game.participant'])) class="active" @endif>
                                <a href="{{route('admin.game.index')}}">Game</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @can('user-list')
                <li @if(in_array(Route::currentRouteName(), ['admin.user.index','admin.wallet.transaction'])) class="active" @endif>
                    <a href="{{route('admin.user.index')}}"><i class="fa fa-users"></i> <span class="nav-label">User</span></a>
                </li>
            @endcan

            @can('gift-list')
                <li @if(in_array(Route::currentRouteName(), ['admin.gift.index','admin.gift.create','admin.gift.edit'])) class="active" @endif>
                    <a href="{{route('admin.gift.index')}}"><i class="fa fa-gift"></i> <span class="nav-label">Gift</span></a>
                </li>
            @endcan

            @can('recharge_request-list')
                <li @if(in_array(Route::currentRouteName(), ['admin.wallet.recharge.request'])) class="active" @endif>
                    <a href="{{route('admin.wallet.recharge.request')}}"><i class="fas fa-download"></i> <span class="nav-label">Recharge Request</span></a>
                </li>
            @endcan

            @can('withdrawal_request-list')
                <li @if(in_array(Route::currentRouteName(), ['admin.withdrawal.request'])) class="active" @endif>
                    <a href="{{route('admin.withdrawal.request')}}"><i class="fas fa-upload"></i> <span class="nav-label">Withdrawal Request</span></a>
                </li>
            @endcan

            @canany(['payment_type-list','payment_channel-list'])
                <li @if(in_array(Route::currentRouteName(), ['admin.payment-type.index','admin.payment-type.edit','admin.channel.index','admin.channel.edit'])) class="active" @endif>
                    <a href="#"><i class="fa fa-credit-card"></i> <span class="nav-label">Payment</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('payment_type-list')
                            <li @if(in_array(Route::currentRouteName(), ['admin.payment-type.index','admin.payment-type.edit'])) class="active" @endif>
                                <a href="{{route('admin.payment-type.index')}}">Type</a>
                            </li>
                        @endcan

                        @can('payment_channel-list')
                            <li @if(in_array(Route::currentRouteName(), ['admin.channel.index','admin.channel.edit'])) class="active" @endif>
                                <a href="{{route('admin.channel.index')}}">Channel</a>
                            </li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @can('activity_banner-list')
                <li @if(in_array(Route::currentRouteName(), ['admin.activity-banner.index','admin.activity-banner.create','admin.activity-banner.edit'])) class="active" @endif>
                    <a href="{{route('admin.activity-banner.index')}}"><i class="fa fa-images"></i> <span class="nav-label">Activity Banner</span></a>
                </li>
            @endcan

            @canany(['joinning-bonus','subordinate_joinning-bonus','first_recharge_self-bonus','first_recharge-commission','recharge-commission','game_play-commission','level-setting'])
                <li @if(in_array(Route::currentRouteName(), ['admin.joinning.setting','admin.subordinate.joinning.setting','admin.level.setting','admin.first.recharge.setting','admin.recharge.setting','admin.game.play.setting','admin.level.setting.edit','admin.first.recharge.self.setting'])) class="active" @endif>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Commission Setting</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('joinning-bonus')
                            <li @if(in_array(Route::currentRouteName(), ['admin.joinning.setting'])) class="active" @endif><a href="{{route('admin.joinning.setting')}}">Joinning</a></li>
                        @endcan

                        @can('subordinate_joinning-bonus')
                            <li @if(in_array(Route::currentRouteName(), ['admin.subordinate.joinning.setting'])) class="active" @endif><a href="{{route('admin.subordinate.joinning.setting')}}">Subordinate Joinning</a></li>
                        @endcan

                        @can('first_recharge_self-bonus')
                            <li @if(in_array(Route::currentRouteName(), ['admin.first.recharge.self.setting'])) class="active" @endif><a href="{{route('admin.first.recharge.self.setting')}}">First Recharge Self</a></li>
                        @endcan

                        @can('first_recharge-commission')
                            <li @if(in_array(Route::currentRouteName(), ['admin.first.recharge.setting'])) class="active" @endif><a href="{{route('admin.first.recharge.setting')}}">First Recharge</a></li>
                        @endcan

                        @can('recharge-commission')
                            <li @if(in_array(Route::currentRouteName(), ['admin.recharge.setting'])) class="active" @endif><a href="{{route('admin.recharge.setting')}}">Recharge</a></li>
                        @endcan

                        @can('game_play-commission')
                            <li @if(in_array(Route::currentRouteName(), ['admin.game.play.setting'])) class="active" @endif><a href="{{route('admin.game.play.setting')}}">Game Play</a></li>
                        @endcan

                        @can('level-setting')
                            <li @if(in_array(Route::currentRouteName(), ['admin.level.setting','admin.level.setting.edit'])) class="active" @endif><a href="{{route('admin.level.setting')}}">Level</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['slider','charges','support','website-data','startup-notification'])
                <li @if(in_array(Route::currentRouteName(), ['admin.slider.index','admin.slider.edit','admin.charge.setting','admin.support.index','admin.support.edit','admin.website.data','admin.startup.notification'])) class="active" @endif>
                    <a href="#"><i class="fa fa-cogs"></i> <span class="nav-label">Website Setting</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('slider')
                            <li @if(in_array(Route::currentRouteName(), ['admin.slider.index','admin.slider.edit'])) class="active" @endif><a href="{{route('admin.slider.index')}}">Slider</a></li>
                        @endcan

                        @can('charges')
                            <li @if(in_array(Route::currentRouteName(), ['admin.charge.setting'])) class="active" @endif><a href="{{route('admin.charge.setting')}}">Charges</a></li>
                        @endcan

                        @can('support')
                            <li @if(in_array(Route::currentRouteName(), ['admin.support.index','admin.support.edit'])) class="active" @endif><a href="{{route('admin.support.index')}}">Support</a></li>
                        @endcan

                        @can('website-data')
                            <li @if(in_array(Route::currentRouteName(), ['admin.website.data'])) class="active" @endif><a href="{{route('admin.website.data')}}">Website Data</a></li>
                        @endcan

                        @can('startup-notification')
                            <li @if(in_array(Route::currentRouteName(), ['admin.startup.notification'])) class="active" @endif><a href="{{route('admin.startup.notification')}}">Startup Notification</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

            @canany(['role-list','staff-list'])
                <li @if(in_array(Route::currentRouteName(), ['admin.roles.index','admin.roles.create','admin.roles.edit','admin.staffs.index','admin.staffs.create','admin.staffs.edit'])) class="active" @endif>
                    <a href="#"><i class="fa fa-users-cog"></i> <span class="nav-label">Staff Management</span>
                        <span class="fa arrow"></span>
                    </a>
                    <ul class="nav nav-second-level">
                        @can('role-list')
                            <li @if(in_array(Route::currentRouteName(), ['admin.roles.index','admin.roles.create','admin.roles.edit'])) class="active" @endif><a href="{{route('admin.roles.index')}}">Role</a></li>
                        @endcan

                        @can('staff-list')
                            <li @if(in_array(Route::currentRouteName(), ['admin.staffs.index','admin.staffs.create','admin.staffs.edit'])) class="active" @endif><a href="{{route('admin.staffs.index')}}">Staff</a></li>
                        @endcan
                    </ul>
                </li>
            @endcanany

        </ul>
    </div>
</nav>
