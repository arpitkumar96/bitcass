<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\GameController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\SupportController;
use App\Http\Controllers\ActivityController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\BankDetailController;
use App\Http\Controllers\BetHistoryController;
use App\Http\Controllers\RedeemGiftController;
use App\Http\Controllers\WithdrawalController;
use App\Http\Controllers\GameParticipationController;
use App\Http\Controllers\Frontend\DashboardController;
use App\Http\Controllers\Frontend\Auth\LoginController;
use App\Http\Controllers\WalletRechargeRequestController;
use App\Http\Controllers\Frontend\Auth\RegisterController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::group(['middleware' => 'prevent-back-history'],function(){

    Auth::routes(['register'=>false,'login'=>false,'logout'=>false]);

    Route::view('about', 'frontend.about')->name('about');
    Route::view('k3-game', 'frontend.k3_game')->name('k3_game');
    Route::view('commission', 'frontend.commission')->name('commission');

    //Register
    Route::get('register',[RegisterController::class,'registerShow'])->name('register');
    Route::post('attempt-register',[RegisterController::class,'register'])->name('attempt.register');

    //Login
    Route::get('login',[LoginController::class,'loginShow'])->name('login');
    Route::post('attempt-login',[LoginController::class,'login'])->name('attempt.login');

    Route::group(['middleware'=>['auth:web']],function () {

        //Index
        Route::get('/',[HomeController::class,'index'])->name('index');
        Route::post('game-list-by-category',[HomeController::class,'gameListByCategory'])->name('game.list.by.category');
        Route::post('game-list-by-category-subcategory',[HomeController::class,'gameListByCategorySubcategory'])->name('game.list.by.category.subcategory');

        //Game
        Route::get('game/{game_slug}',[GameController::class,'index'])->name('game');
        Route::get('get-game-detail/{game_id}',[GameController::class,'detail'])->name('get.game.detail');
        Route::get('get-game-history/{game_id}',[GameController::class,'gameHistory'])->name('get.game.history');
        Route::get('get-user-game-history/{game_id}',[GameController::class,'userGameHistory'])->name('get.user.game.history');
        Route::get('get-game-chart/{game_id}',[GameController::class,'gameChart'])->name('get.game.chart');
        Route::get('get-game-wallet-section',[GameController::class,'getGameWalletSection'])->name('get.game.wallet.section');

        Route::get('get-current-wallet-amount',[GameController::class,'getCurrentWalletAmount'])->name('get.current.wallet.amount');


        Route::get('redeemgift',[RedeemGiftController::class,'index'])->name('redeemgift');
        Route::post('redeemgift-store',[RedeemGiftController::class,'store'])->name('redeemgift.store');

        //Activity
        Route::get('activity',[ActivityController::class,'index'])->name('activity');

        //Support
        Route::get('support',[SupportController::class,'index'])->name('support');

        Route::group(['prefix'=>'user','as'=>'user.'],function () {

            //Dashboard
            Route::get('dashboard', [DashboardController::class, 'index'])->name('dashboard');

            //profile
            Route::view('settings', 'frontend.user.profile')->name('settings');
            Route::view('withdrawl-history', 'frontend.user.withdrawl_history')->name('withdrawl_history');
            Route::view('deposit-history', 'frontend.user.deposit_history')->name('deposit_history');
            Route::view('transaction-history', 'frontend.user.transaction_history')->name('transaction_history');
            Route::view('notification', 'frontend.user.notification')->name('notification');
            Route::view('gamestatics', 'frontend.user.gamestatics')->name('gamestatics');
            Route::view('feedback', 'frontend.user.feedback')->name('feedback');
            Route::view('service_notification', 'frontend.user.service_notification')->name('service_notification');



            //Participation
            Route::post('game-participation',[GameParticipationController::class,'store'])->name('game.participation');

            //Wallet Recharge Request
            Route::get('wallet-recharge',[WalletRechargeRequestController::class,'index'])->name('wallet.recharge');
            Route::post('get-channel-by-payment-type',[WalletRechargeRequestController::class,'getChannelByPaymentType'])->name('get.channel.by.payment.type');
            Route::post('get-qr',[WalletRechargeRequestController::class,'getQr'])->name('get.qr');

            //Payment
            Route::get('payment/timeout',[WalletRechargeRequestController::class,'timeout'])->name('payment.timeout');
            Route::get('payment/invalid',[WalletRechargeRequestController::class,'invalid'])->name('payment.invalid');
            Route::get('payment/success',[WalletRechargeRequestController::class,'success'])->name('payment.success');
            Route::get('payment/{transaction_id}',[WalletRechargeRequestController::class,'payment'])->name('payment');
            Route::post('update-utr/{transaction_id}',[WalletRechargeRequestController::class,'updateUtr'])->name('update.utr');

            //Withdrawal
            Route::get('withdrawl',[WithdrawalController::class,'index'])->name('withdrawl');
            Route::post('withdrawl-request',[WithdrawalController::class,'store'])->name('withdrawl.request');

            //Add Bank Detail
            Route::get('bank-detail',[BankDetailController::class,'index'])->name('bank.detail');
            Route::post('bank-detail-store',[BankDetailController::class,'store'])->name('bank.detail.store');

            //Pramotion
            Route::get('promotion',[PromotionController::class,'index'])->name('promotion');
            Route::get('team-report',[PromotionController::class,'teamReport'])->name('team.report');
            Route::get('pramotion-share',[PromotionController::class,'pramotionShare'])->name('pramotion.share');

            //Lotery Page
            Route::get('wallet',[WalletController::class,'index'])->name('wallet');

            //Bet History
            Route::get('bet-history',[BetHistoryController::class,'index'])->name('bet.history');
            Route::post('get-game-by-category',[BetHistoryController::class,'getGameByCategory'])->name('get.game.by.category');

            //Logout
            Route::post('logout',[LoginController::class,'logout'])->name('logout');

        });

    });

});
