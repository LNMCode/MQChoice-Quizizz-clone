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
            $cookie = $_COOKIE['userLogin'];
            $cookie = json_decode($cookie, true);
            $iduser = $cookie['iduser'];

            if(isset($idroom)){
                $response = Http::post($url_current.'/room/getroombyid?idroom='.$idroom.'&iduser='.$iduser);
                if($response['message'] != 'fail'){
                    $room = $response['doc'];
                    return view('host.manageroom',[
                        'title' => 'Manage Room '.$idroom,
                        'room' => $room,
                        'url' => $url_current.'/room'
                    ]);
                }
            } else {
                return view('host.manageroom',[
                    'title' => 'Manage Room create new',
                    'room' => null,
                    'url' => $url_current.'/room'
                ]);
            }
        }

        return view('host.manageroom', [
            'title' => 'Manage room',
            'room' => null,
            'url' => $url_current.'/room'
        ]);
    }
}
