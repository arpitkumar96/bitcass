<?php

namespace App\Console\Commands;

use Carbon\Carbon;
use App\Models\Game;
use App\Models\User;
use App\Models\Wallet;
use App\Models\StartGame;
use Illuminate\Console\Command;
use App\Models\GameParticipation;
use App\Http\Controllers\Admin\GamePlayCommissionController;

class WinGo10MinGame extends Command
{

    protected $signature = 'app:win-go10-min-game';

    protected $description = 'This will declare WinGo 10Min Reslut and again start Game.';

    public function handle(){
        $game = Game::whereHas('subCategory',function($query){
            $query->where('name','Win Go');
        })->where('duration',10)->first();

        $old_start_game = StartGame::where('game_id',$game->id)->where('is_running','1')->latest()->first();

        if($old_start_game){
            $zero = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','number')->where('data','0')->sum('final_amount');
            $one = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','number')->where('data','1')->sum('final_amount');
            $two = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','number')->where('data','2')->sum('final_amount');
            $three = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','number')->where('data','3')->sum('final_amount');
            $four = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','number')->where('data','4')->sum('final_amount');
            $five = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','number')->where('data','5')->sum('final_amount');
            $six = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','number')->where('data','6')->sum('final_amount');
            $seven = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','number')->where('data','7')->sum('final_amount');
            $eight = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','number')->where('data','8')->sum('final_amount');
            $nine = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','number')->where('data','9')->sum('final_amount');

            $violet = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','color')->where('data','violet')->sum('final_amount');
            $green = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','color')->where('data','green')->sum('final_amount');
            $red = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','color')->where('data','red')->sum('final_amount');

            $big = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','size')->where('data','big')->sum('final_amount');
            $small = GameParticipation::where('start_game_id',$old_start_game->id)->where('type','size')->where('data','small')->sum('final_amount');

            $total_zero_winning_amount = ($zero*9) + ($violet*4.5) + ($small*2) + ($red*1.5);
            $total_one_winning_amount = ($one*9) + ($green*2) + ($small*2);
            $total_two_winning_amount = ($two*9) + ($red*2) + ($small*2);
            $total_three_winning_amount = ($three*9) + ($green*2) + ($small*2);
            $total_four_winning_amount = ($four*9) + ($red*2) + ($small*2);
            $total_five_winning_amount = ($five*9) + ($violet*4.5) + ($big*2) + ($green*1.5);
            $total_six_winning_amount = ($six*9) + ($red*2) + ($big*2);
            $total_seven_winning_amount = ($seven*9) + ($green*2) + ($big*2);
            $total_eight_winning_amount = ($eight*9) + ($red*2) + ($big*2);
            $total_nine_winning_amount = ($nine*9) + ($green*2) + ($big*2);

            $total_amount_array = [$total_zero_winning_amount,$total_one_winning_amount,$total_two_winning_amount,$total_three_winning_amount,$total_four_winning_amount,$total_five_winning_amount,$total_six_winning_amount,$total_seven_winning_amount,$total_eight_winning_amount,$total_nine_winning_amount];

            if($old_start_game->winning_number){
                $winning_number = $old_start_game->winning_number;
            }else{
                if(GameParticipation::where('start_game_id',$old_start_game->id)->count() == 0){
                    $winning_number = mt_rand(0,9);
                }else{
                    $total_bet_value = GameParticipation::where('start_game_id',$old_start_game->id)->sum('final_amount');
                    if(min(array_filter($total_amount_array)) >= $total_bet_value){
                        $winning_number = array_search(min($total_amount_array),$total_amount_array);
                    }else{
                        $winning_number = array_search(min(array_filter($total_amount_array)),$total_amount_array);
                    }
                }
            }
            if($winning_number >= 5){
                $winning_size = 'big';
            }else{
                $winning_size = 'small';
            }

            switch ($winning_number) {
                case 0:
                    $winning_color = 'red-violet';
                    break;
                case 1:
                    $winning_color = 'green';
                    break;
                case 2:
                    $winning_color = 'red';
                    break;
                case 3:
                    $winning_color = 'green';
                    break;
                case 4:
                    $winning_color = 'red';
                    break;
                case 5:
                    $winning_color = 'green-violet';
                    break;
                case 6:
                    $winning_color = 'red';
                    break;
                case 7:
                    $winning_color = 'green';
                    break;
                case 8:
                    $winning_color = 'red';
                    break;
                case 9:
                    $winning_color = 'green';
                    break;
                default:
                    break;
            }

            $old_running_game = StartGame::where('id',$old_start_game->id)->first();
            $old_running_game->winning_number = $winning_number;
            $old_running_game->winning_color = $winning_color;
            $old_running_game->winning_size = $winning_size;
            $old_running_game->is_running = '0';

            $game_participants = GameParticipation::where('start_game_id',$old_running_game->id)->get();

            foreach ($game_participants as $game_participant) {
                $final_game_participant = GameParticipation::where('id',$game_participant->id)->first();

                $is_win = '0';
                $win_amount = 0;
                $lose_amount = 0;

                if($final_game_participant->type == 'number'){
                    if($winning_number == $final_game_participant->data){
                        $is_win = '1';
                        $win_amount = ($final_game_participant->final_amount * 9);
                    }
                }elseif($final_game_participant->type == 'color'){
                    $selected_color = $final_game_participant->data;
                    if($selected_color == 'red'){
                        switch ($winning_number) {
                            case 0:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 1.5);
                                break;
                            case 2:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 2);
                                break;
                            case 4:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 2);
                                break;
                            case 6:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 2);
                                break;
                            case 8:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 2);
                                break;
                            default:
                                break;
                        }
                    }elseif($selected_color == 'green'){
                        switch ($winning_number) {
                            case 1:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 2);
                                break;
                            case 3:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 2);
                                break;
                            case 5:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 1.5);
                                break;
                            case 7:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 2);
                                break;
                            case 9:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 2);
                                break;
                            default:
                                break;
                        }
                    }elseif($selected_color == 'violet'){
                        switch ($winning_number) {
                            case 0:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 4.5);
                                break;
                            case 5:
                                $is_win = '1';
                                $win_amount = ($final_game_participant->final_amount * 4.5);
                                break;
                            default:
                                break;
                        }
                    }
                }elseif($final_game_participant->type == 'size'){
                    if($winning_size == $final_game_participant->data){
                        $is_win = '1';
                        $win_amount = ($final_game_participant->final_amount * 2);
                    }
                }else{
                    $lose_amount = $final_game_participant->final_amount;
                }

                $final_game_participant->is_win = $is_win;
                $final_game_participant->win_amount = $win_amount;
                $final_game_participant->save();

                if($is_win == '1'){
                    $user_wallet = new Wallet;
                    $user_wallet->user_id = $game_participant->user_id;
                    $user_wallet->type_id = $final_game_participant->id;
                    $user_wallet->amount = $win_amount;
                    $user_wallet->transaction_type = 'credit';
                    $user_wallet->type = 'reward';
                    $user_wallet->save();

                    $user = User::where('id',$game_participant->user_id)->first();
                    $user->total_wallet_amount = $user->total_wallet_amount + $win_amount;
                    $user->save();

                    $invite_code = $user->invite_code;

                    $commission_distribution = new GamePlayCommissionController;
                    $commission_distribution->commissionDistribution($invite_code,$final_game_participant->id,$win_amount);
                }
            }

            $old_running_game->save();
        }

        $total_this_game = StartGame::where('game_id',$game->id)->whereDate('created_at', Carbon::today())->count();

        $start_game = new StartGame;
        $start_game->start_game_id = date('Ymd').'0'.($game->id.'0000')+$total_this_game+1;
        $start_game->game_id = $game->id;
        $start_game->duration = $game->duration;
        $start_game->save();
    }
}
