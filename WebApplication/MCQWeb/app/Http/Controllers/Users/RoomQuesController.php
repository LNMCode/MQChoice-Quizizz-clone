<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class RoomQuesController extends Controller
{
    public function index(Request $request){
        $idroom = $request->idroom;
        $url_current = 'http://127.0.0.1:3000';
        $response = Http::get($url_current.'/joinroom/getques?idroom='.$idroom);
        $isExits = $this->checkCookieExist();
        if($response['message'] != 'fail' && $isExits){
            $rooms = $response['doc'];
            $listQues = $rooms['data'];
    
            $cookie = $_COOKIE['userRoom'];
            $cookie = json_decode($cookie, true);
            $iduser = $cookie['iduser'];
            
            echo $idroom;
            if (sizeof($rooms) != 0){
    
            }
            return view('users.roomques', [
                'title' => 'Room Started',
                'idroom' => $idroom,
                'iduser' => $iduser,
                'listQues' => $listQues
            ]);
        }
    }

    private function checkCookieExist(){
        $cookie_name = 'userRoom';
        if(!isset($_COOKIE[$cookie_name])) {
            echo "Cookie named '" . $cookie_name . "' is not set!";
            return false;
        }
        return true;
    }

}