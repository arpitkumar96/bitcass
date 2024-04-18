<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [

            'dashboard',

            'game_category-list',
            'game_category-create',
            'game_category-edit',
            'game_category-delete',

            'game_subcategory-list',
            'game_subcategory-create',
            'game_subcategory-edit',
            'game_subcategory-delete',

            'game-list',
            'game-create',
            'game-edit',
            'game-delete',
            'game-status',
            'game-played',
            'game-played-company-profit',
            'game-played-participant',
            'game-played-set-result',

            'user-list',
            'user-block',
            'user-wallet',

            'gift-list',
            'gift-create',
            'gift-edit',
            'gift-delete',
            'gift-status',

            'recharge_request-list',
            'recharge_request-approval',

            'withdrawal_request-list',
            'withdrawal_request-approval',

            'payment_type-list',
            'payment_type-create',
            'payment_type-edit',
            'payment_type-status',

            'payment_channel-list',
            'payment_channel-create',
            'payment_channel-edit',
            'payment_channel-status',

            'activity_banner-list',
            'activity_banner-create',
            'activity_banner-edit',
            'activity_banner-delete',

            'joinning-bonus',

            'subordinate_joinning-bonus',

            'first_recharge_self-bonus',

            'first_recharge-commission',

            'recharge-commission',

            'game_play-commission',

            'level-setting',

            'slider',

            'charges',

            'support',

            'website-data',

            'startup-notification',

            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'staff-list',
            'staff-create',
            'staff-edit',
            'staff-delete',
        ];

        $routes = [

            'admin.dashboard',

            'admin.game-category.index',
            'admin.game-category.index',
            'admin.game-category.index',
            'admin.game-category.index',

            'admin.game-sub-category.index',
            'admin.game-sub-category.index',
            'admin.game-sub-category.index',
            'admin.game-sub-category.index',

            'admin.game.index',
            'admin.game.index',
            'admin.game.index',
            'admin.game.index',
            'admin.game.index',
            'admin.game.index',
            'admin.game.index',
            'admin.game.index',
            'admin.game.index',

            'admin.user.index',
            'admin.user.index',
            'admin.user.index',

            'admin.gift.index',
            'admin.gift.index',
            'admin.gift.index',
            'admin.gift.index',
            'admin.gift.index',

            'admin.wallet.recharge.request',
            'admin.wallet.recharge.request',

            'admin.withdrawal.request',
            'admin.withdrawal.request',

            'admin.payment-type.index',
            'admin.payment-type.index',
            'admin.payment-type.index',
            'admin.payment-type.index',

            'admin.channel.index',
            'admin.channel.index',
            'admin.channel.index',
            'admin.channel.index',

            'admin.activity-banner.index',
            'admin.activity-banner.index',
            'admin.activity-banner.index',
            'admin.activity-banner.index',

            'admin.joinning.setting',

            'admin.subordinate.joinning.setting',

            'admin.first.recharge.self.setting',

            'admin.first.recharge.setting',

            'admin.recharge.setting',

            'admin.game.play.setting',

            'admin.level.setting',

            'admin.slider.index',

            'admin.charge.setting',

            'admin.support.index',

            'admin.website.data',

            'admin.startup.notification',

            'admin.roles.index',
            'admin.roles.index',
            'admin.roles.index',
            'admin.roles.index',

            'admin.staffs.index',
            'admin.staffs.index',
            'admin.staffs.index',
            'admin.staffs.index',
        ];

        foreach ($permissions as $key=>$permission) {
            $data=explode('-',$permission);

            $permissions_data = Permission::where('name', $permission)->first();
            if(!$permissions_data){
                $permissions_data = new Permission;
            }
            $permissions_data->name=$permission;
            $permissions_data->parent_name=$data[0];
            $permissions_data->guard_name = 'admin';
            $permissions_data->route_name = $routes[$key];
            $permissions_data->save();
        }
    }
}
