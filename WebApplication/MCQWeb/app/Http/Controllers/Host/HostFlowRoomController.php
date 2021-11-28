<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class HostFlowRoomController extends Controller
{
    public function index(Request $request){
        $idroom = $request->idroom;
        $iduser = $request->iduser;
        $url_current = 'http://127.0.0.1:3000';

        $response = Http::post($url_current.'/room/getroombyid?idroom='.$idroom.'&iduser='.$iduser);
        if($response['message'] != 'fail'){
            //echo $response; 
            return view('host.hostflowroom',[
                'title' => 'Host flow room '.$idroom,
                'idroom' => $idroom,
                'iduser' => $iduser,
                'room' => $response['doc']
            ]);
        }
        return view('host.hostflowroom',[
            'title' => 'Host flow room '.$idroom,
            'idroom' => $idroom,
            'iduser' => $iduser
        ]);
    }
}
