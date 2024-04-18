<?php

use App\Http\Controllers\Admin\GameController;
use App\Http\Controllers\Admin\GiftController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\StaffController;
use App\Http\Controllers\Admin\ChargeController;
use App\Http\Controllers\Admin\SliderController;
use App\Http\Controllers\Admin\ChannelController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\SupportController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\PlayedGameController;
use App\Http\Controllers\Admin\PaymentTypeController;
use App\Http\Controllers\Admin\WebsiteDataController;
use App\Http\Controllers\Admin\GameCategoryController;
use App\Http\Controllers\Admin\LevelSettingController;
use App\Http\Controllers\Admin\ActivityBannerController;
use App\Http\Controllers\Admin\GameSubCategoryController;
use App\Http\Controllers\Admin\CommissionSettingController;
use App\Http\Controllers\Admin\GameParticipationController;
use App\Http\Controllers\Admin\WalletTransactionController;
use App\Http\Controllers\Admin\WithdrawalRequestController;
use App\Http\Controllers\Admin\WalletRechargeRequestController;

/*
|--------------------------------------------------------------------------
| Admin Routes
|--------------------------------------------------------------------------
|
| Here is where you can register admin routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "admin" middleware group. Now create something great!
|
*/

//Login
Route::get('login', [LoginController::class, 'showLoginForm'])->name('admin.login');
Route::post('login', [LoginController::class, 'login'])->name('admin.login.submit');

Route::group(['middleware'=>'auth:admin','as'=>'admin.'],function () {

    //Dashboard
    Route::get('/', [DashboardController::class, 'index'])->name('dashboard');

    //Category
    Route::resource('game-category', GameCategoryController::class)->except('create');

    //Sub Category
    Route::resource('game-sub-category', GameSubCategoryController::class)->except('create');
    Route::post('get-subcategory-by-categoryid',[GameSubCategoryController::class,'getSubcategoryByCategoryid'])->name('get.subcategory.by.categoryid');

    //Game
    Route::resource('game', GameController::class);
    Route::get('game-status/{id}/{status}', [GameController::class,'gameStatus'])->name('game.status');
    Route::post('get-sub-category-by-category', [GameController::class,'getSubCategoryByCategory'])->name('get.sub.category.by.category');

    //User
    Route::get('users',[UserController::class,'index'])->name('user.index');
    Route::get('block-status/{id}/{status}',[UserController::class,'blockStatus'])->name('block.status');

    //Slider
    Route::resource('slider',SliderController::class)->except(['create','show']);

    //Payment Type
    Route::resource('payment-type',PaymentTypeController::class)->except(['create','destroy']);

    //Channel
    Route::resource('channel',ChannelController::class)->except(['create','destroy']);

    //Wallet Recharge Request
    Route::get('wallet-recharge-request',[WalletRechargeRequestController::class,'index'])->name('wallet.recharge.request');
    Route::get('wallet-recharge-request-status',[WalletRechargeRequestController::class,'status'])->name('wallet.recharge.status');

    //Withdrawal Request
    Route::get('withdrawal-request',[WithdrawalRequestController::class,'index'])->name('withdrawal.request');
    Route::post('withdrawal-request_detail',[WithdrawalRequestController::class,'detail'])->name('withdrawal.request.detail');
    Route::post('withdrawal-request-status/{id}',[WithdrawalRequestController::class,'status'])->name('withdrawal.request.status');

    //Wallet Transaction
    Route::get('wallet-transaction/{user_id}',[WalletTransactionController::class,'index'])->name('wallet.transaction');

    //Start Game
    Route::get('played-games/{game_slug}',[PlayedGameController::class,'index'])->name('played.games');

    //Game Participant
    Route::get('game-participant/{start_game_id}',[GameParticipationController::class,'index'])->name('game.participant');
    Route::post('set-game-result/{start_game_id}',[GameParticipationController::class,'store'])->name('set.game.result');

    //Charge
    Route::get('charge-setting',[ChargeController::class,'index'])->name('charge.setting');
    Route::post('charge-setting/store',[ChargeController::class,'store'])->name('charge.setting.store');

    //Gift
    Route::resource('gift', GiftController::class);

    //Banner
    Route::resource('activity-banner',ActivityBannerController::class);

    //Support
    Route::resource('support', SupportController::class);

    //Commission Setting

        //Joinning
        Route::get('joinning-setting',[CommissionSettingController::class,'joinningSetting'])->name('joinning.setting');
        Route::post('joinning-setting-store',[CommissionSettingController::class,'joinningSettingStore'])->name('joinning.setting.store');

        //Subordinate Joinning
        Route::get('subordinate-joinning-setting',[CommissionSettingController::class,'subordinateJoinningSetting'])->name('subordinate.joinning.setting');
        Route::post('subordinate-joinning-table',[CommissionSettingController::class,'subordinateJoinningTable'])->name('subordinate.joinning.table');
        Route::post('subordinate-joinning-setting-store',[CommissionSettingController::class,'subordinateJoinningSettingStore'])->name('subordinate.joinning.setting.store');

        //First Recharge
        Route::get('first-recharge-setting',[CommissionSettingController::class,'firstRechargeSetting'])->name('first.recharge.setting');
        Route::post('first-recharge-table',[CommissionSettingController::class,'firstRechargeTable'])->name('first.recharge.table');
        Route::post('first-recharge-setting-store',[CommissionSettingController::class,'firstRechargeSettingStore'])->name('first.recharge.setting.store');

        //First Recharge Self
        Route::get('first-recharge-self-setting',[CommissionSettingController::class,'firstRechargeSelfSetting'])->name('first.recharge.self.setting');
        Route::post('first-recharge-self-setting-store',[CommissionSettingController::class,'firstRechargeSelfSettingStore'])->name('first.recharge.self.setting.store');

        //Recharge
        Route::get('recharge-setting',[CommissionSettingController::class,'rechargeSetting'])->name('recharge.setting');
        Route::post('recharge-table',[CommissionSettingController::class,'rechargeTable'])->name('recharge.table');
        Route::post('recharge-setting-store',[CommissionSettingController::class,'rechargeSettingStore'])->name('recharge.setting.store');

        //Game Play
        Route::get('game-play-setting',[CommissionSettingController::class,'gamePlaySetting'])->name('game.play.setting');
        Route::post('game-play-table',[CommissionSettingController::class,'gamePlayTable'])->name('game.play.table');
        Route::post('game-play-setting-store',[CommissionSettingController::class,'gamePlaySettingStore'])->name('game.play.setting.store');

        //Level
        Route::get('level-setting',[LevelSettingController::class,'levelSetting'])->name('level.setting');
        Route::post('level-setting-store',[LevelSettingController::class,'levelSettingStore'])->name('level.setting.store');
        Route::get('level-setting-edit/{id}',[LevelSettingController::class,'levelSettingEdit'])->name('level.setting.edit');
        Route::put('level-setting-update/{id}',[LevelSettingController::class,'levelSettingUpdate'])->name('level.setting.update');
        Route::delete('level-setting-delete/{id}',[LevelSettingController::class,'levelSettingDelete'])->name('level.setting.delete');

    //Profile
    Route::get('profile',[ProfileController::class,'index'])->name('profile');
    Route::post('profile-store',[ProfileController::class,'store'])->name('profile.store');

    //Website Data
    Route::get('website-date',[WebsiteDataController::class,'index'])->name('website.data');
    Route::post('website-date-store',[WebsiteDataController::class,'store'])->name('website.data.store');

    //Startup Notification
    Route::get('startup-notification',[WebsiteDataController::class,'startupNotification'])->name('startup.notification');
    Route::post('startup-notification-store',[WebsiteDataController::class,'startupNotificationStore'])->name('startup.notification.store');

    //Change Password
    Route::post('change-password',[ProfileController::class,'changePassword'])->name('change.password');

    //Staff Management
    Route::resource('roles', RoleController::class);
    Route::resource('staffs', StaffController::class);

    //Logout
    Route::post('logout/', [LoginController::class, 'logout'])->name('logout');

});
