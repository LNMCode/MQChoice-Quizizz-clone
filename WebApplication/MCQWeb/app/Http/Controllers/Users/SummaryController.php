<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class SummaryController extends Controller
{
    public function index(Request $request, $idroom, $iduser){
        echo 'idroom' . $idroom;
        echo 'iduser' . $iduser;
        $url_current = 'http://127.0.0.1:3000';
        $response = Http::get($url_current.'/joinroom/getroom?idroom='.$idroom);
        if ($response['message'] != 'fail'){
            $room = $response['doc'];
            echo $room['title'];
            //$player = $this->findPlayerById($iduser, $room['players']);
            //echo $player['play'];
            return view('users.summary', [
                'title' => "Summary",
                'idroom' => $room['idroom'],
                'room' => $room,
            ]);
        }
        return view('users.summary', [
            'title' => 'Summary',
        ]);
    }
}
