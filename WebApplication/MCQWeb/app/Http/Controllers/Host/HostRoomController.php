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
            $response = Http::post($url_current.'/room/getroombyid?idroom='.$idroom);
            $room = json_decode($response, true);
            return view('host.hostroom',[
                'title' => 'Host Room'.$idroom,
                'room' => $room
            ]);
        }

        return view('host.hostroom',[
            'title' => 'Host Room'.$idroom,
            'room' => null
        ]);
    }

    private function openRoom($id, $url_current){
        $response = Http::post($url_current.'/room/openroom?idroom='.$id);
        $room = json_decode($response, true);
        return $room['message'] == 'ok';
    }
}
