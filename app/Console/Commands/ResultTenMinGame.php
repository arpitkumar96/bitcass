<?php

namespace App\Console\Commands;

use App\Models\StartGame;
use Illuminate\Console\Command;
use App\Models\GameParticipation;

class ResultTenMinGame extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:result-ten-min-game';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        if (date('s') >= 55) {
            $old_start_games = StartGame::where('duration',10)->where('is_running','1')->get();

            foreach ($old_start_games as $key => $old_start_game) {
                $winning_number = rand(0,9);
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
                $old_running_game->save();

                $game_participants = GameParticipation::where('start_game_id',$old_running_game->id)->get();

                foreach ($game_participants as $game_participant) {
                    $final_game_participant = GameParticipation::where('id',$game_participant->id)->first();

                    $is_win = '0';
                    $win_amount = 0;
                    $lose_amount = 0;

                    if($final_game_participant->type == 'number'){
                        if($winning_number == $final_game_participant->data){
                            $is_win = '1';
                            $win_amount = ($final_game_participant->amount * 9) * $final_game_participant->quantity;
                        }
                    }elseif($final_game_participant->type == 'color'){
                        $selected_color = $final_game_participant->data;
                        if($selected_color == 'red'){
                            switch ($winning_number) {
                                case 0:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 1.5) * $final_game_participant->quantity;
                                    break;
                                case 2:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 2) * $final_game_participant->quantity;
                                    break;
                                case 4:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 2) * $final_game_participant->quantity;
                                    break;
                                case 6:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 2) * $final_game_participant->quantity;
                                    break;
                                case 8:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 2) * $final_game_participant->quantity;
                                    break;
                                default:
                                    break;
                            }
                        }elseif($selected_color == 'green'){
                            switch ($winning_number) {
                                case 1:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 2) * $final_game_participant->quantity;
                                    break;
                                case 3:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 2) * $final_game_participant->quantity;
                                    break;
                                case 5:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 1.5) * $final_game_participant->quantity;
                                    break;
                                case 7:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 2) * $final_game_participant->quantity;
                                    break;
                                case 9:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 2) * $final_game_participant->quantity;
                                    break;
                                default:
                                    break;
                            }
                        }elseif($selected_color == 'violet'){
                            switch ($winning_number) {
                                case 0:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 4.5) * $final_game_participant->quantity;
                                    break;
                                case 5:
                                    $is_win = '1';
                                    $win_amount = ($final_game_participant->amount * 4.5) * $final_game_participant->quantity;
                                    break;
                                default:
                                    break;
                            }
                        }
                    }elseif($final_game_participant->type == 'size'){
                        if($winning_size == $final_game_participant->data){
                            $is_win = '1';
                            $win_amount = ($final_game_participant->amount * 2) * $final_game_participant->quantity;
                        }
                    }else{
                        $lose_amount = $final_game_participant->amount;
                    }

                    $final_game_participant->is_win = $is_win;
                    $final_game_participant->win_amount = $win_amount;
                    $final_game_participant->save();
                }
            }
        }
    }
}
