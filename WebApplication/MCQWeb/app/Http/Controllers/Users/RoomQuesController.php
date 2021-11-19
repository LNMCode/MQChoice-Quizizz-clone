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
        $response = Http::get($url_current.'/joinroom/getroom?idroom='.$idroom);
        $isExits = $this->checkCookieExist();
        if($response['message'] != 'fail' && $isExits){
            $cookie = $_COOKIE['userRoom'];
            $cookie = json_decode($cookie, true);
            $iduser = $cookie['iduser'];

            $rooms = $response['doc'];
            // $playerById = current(array_filter($rooms['players'], function($e) use($iduser) {
            //     return $e['id'] == $iduser;
            // }));

            // $listQuesAnswered = $playerById['play'];
            // $listIdsQuesAnswered = array();
            // if (sizeOf($listIdsQuesAnswered) > 0){
            //     foreach ($listQuesAnswered as $ans){
            //         array_push($listIdsQuesAnswered, $ans['idques']);
            //     }
            // } 

            // $listQues = sizeof($listIdsQuesAnswered) > 0 ? array_filter($rooms['data'], function($v) use ($listIdsQuesAnswered) {
            //     return !in_array($v['idques'], $listIdsQuesAnswered);
            // }) : $rooms['data'];
    
            // if (sizeof($rooms) != 0){
    
            // }

            $listQues = $rooms['data'];
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