<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HostRoomController extends Controller
{
    public function index(Request $request, $idroom){
        $url_current = 'http://127.0.0.1:3000';
        $roomIsOpen = $this->openRoom($idroom, $url_current);
        if(isset($idroom) && $roomIsOpen){
            $cookie = $_COOKIE['userLogin'];
            $cookie = json_decode($cookie, true);
            $iduser = $cookie['iduser'];

            $response = Http::post($url_current.'/room/getroombyid?idroom='.$idroom.'&iduser='.$iduser);
            if($response['message'] != 'fail'){
                $room = $response['doc'];
                return view('host.hostroom',[
                    'title' => 'Host Room'.$idroom,
                    'room' => $room,
                    'iduser' => $iduser,
                ]);
            }
        }

        return view('host.hostroom',[
            'title' => 'Host Room'.$idroom,
            'room' => null,
            'iduser' => null,
        ]);
    }

    private function openRoom($id, $url_current){
        $response = Http::post($url_current.'/room/openroom?idroom='.$id);
        $room = $response;
        return $room['message'] == 'ok' ? true : false;
    }
}
