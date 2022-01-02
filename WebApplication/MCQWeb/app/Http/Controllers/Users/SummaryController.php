<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SummaryController extends Controller
{
    public function index(Request $request, $idroom, $iduser){
        $url_current = 'http://127.0.0.1:3000';
        $response = Http::get($url_current.'/joinroom/getroom?idroom='.$idroom);
        if ($response['message'] != 'fail'){
            $room = $response['doc'];
            //$player = $this->findPlayerById($iduser, $room['players']);
            //echo $player['play'];
            $playerranked = $this->sortRanked($room['players']);
            if ($iduser == "null"){
                $this->removeAllPlayerInRoom($room['idroom']);
            }
            return view('users.summary', [
                'title' => "Summary",
                'idroom' => $room['idroom'],
                'players' => $room['players'],
                'rankedlist' => $playerranked,
                'iduser' => $iduser
            ]);
        }
        return view('users.summary', [
            'title' => 'Summary',
        ]);
    }

    private function sortRanked($array){
        $output = array();
        foreach($array as $player){
            $score = 0;
            foreach($player['play'] as $play){
                if ($play['istrue']){
                    $score++;
                }
            }
            $id = $player['id'];
            $output[$id] = $score;
        }
        asort($output);
        $output = array_reverse($output, TRUE);
        return $output;
    }

    private function removeAllPlayerInRoom($idroom){
        $url_current = 'http://127.0.0.1:3000';
        $res = Http::post($url_current.'/room/removeallplayer?idroom='.$idroom);
    }
}
