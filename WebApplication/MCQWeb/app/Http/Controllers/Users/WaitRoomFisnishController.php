<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WaitRoomFisnishController extends Controller
{
    public function index(Request $request, $idroom, $iduser){
        // echo 'idroom' . $idroom;
        // echo 'iduser' . $iduser;
        $url_current = 'http://127.0.0.1:3000';
        $response = Http::get($url_current.'/joinroom/getroom?idroom='.$idroom);
        if ($response['message'] != 'fail'){
            $room = $response['doc'];
            $player = $this->findPlayerById($iduser, $room['players']);
            //echo $player['play'];
            $correctNumber = $this->getNumberCorrect($player['play']);
            $inCorrectNumber = sizeof($player['play']) - $correctNumber;
            return view('users.waitroomfinish', [
                'title' => "Wait Room Finish",
                'idroom' => $room['idroom'],
                'iduser' => $player['id'],
                'player' => $player,
                'questions' => $room['data'],
                'correctNumber' => $correctNumber,
                'inCorrectNumber' => $inCorrectNumber,
            ]);
        }
        // When error
        return view('users.waitroomfinish', [
            'title' => "Wait Room Finish",
        ]);
    }

    private function findPlayerById($id, $players){
        foreach ( $players as $player ) {
            if ( $id == $player['id'] ) {
                return $player;
            }
        }
    
        return false;
    }

    private function getNumberCorrect($plays){
        $count = 0;
        foreach ($plays as $play){
            if ($play['istrue']) {
                $count += 1;
            }
        }
        return $count;
    }
}
