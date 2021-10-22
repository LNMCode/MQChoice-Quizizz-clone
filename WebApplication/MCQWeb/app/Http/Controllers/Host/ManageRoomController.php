<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class ManageRoomController extends Controller
{
    public function index(Request $request, $idroom){
        $url_current = 'http://127.0.0.1:3000';
        if(isset($idroom)){
            $response = Http::post($url_current.'/room/getroombyid?idroom='.$idroom);
            $room = json_decode($response, true);
            return view('host.manageroom',[
                'title' => 'Manage Room '.$idroom,
                'room' => $room
            ]);
        }

        return view('host.manageroom', [
            'title' => 'Manage room',
            'room' => null
        ]);
    }
}
