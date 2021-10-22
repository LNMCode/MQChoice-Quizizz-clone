<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use App\Models\Room;
use \Datetime;

class JoinRoomController extends Controller
{

    public function index(Request $request){
        $nameUser = $request->input('name');
        $idRoom =  $request->input('idroom');
        $url_current = 'http://127.0.0.1:3000';
        $iduser = time();
        $response = Http::post($url_current.'/room/getroombyid?idroom='.$idRoom);
        $room = json_decode($response, $array=true);
        $isResetPlay = false;
        
        if (isset($room)){
            if(!$room['isopen']){
                return view('users.entercode', [
                    'title' => "Room is not start",
                ]); 
            }
            $isExist = $this->saveCookie($idRoom, $iduser, $nameUser);
            if($isExist){
                $cookie = $_COOKIE['userRoom'];
                $cookie = json_decode($cookie, true);
                $iduser = $cookie['iduser'];
                if($this->checkUserExist($room['players'], $iduser)){
                    // Hoi co muon reset hay continous
                    print('Da ton tai tai khoan');
                    // Check them la da played chua,
                    // neu roi chi ms hoi
                    if($room[0]['isstart']){
                        return view('users.joinroom', [
                            'title' => 'Join Room',
                            'textBody' => 'Do you want reset all answer?',
                            'isCheckStart' => true,
                        ]);       
                    }
                    // Neu chua thi start luon
                }
            } else {
                print('Chua ton tai tai khoan');
                //insert user
                $this->insertUserToRoom($url_current,$idRoom, $iduser, $nameUser);
            }
            if(!$room['isstart']){
                return view('users.joinroom', [
                    'title' => 'Join Room',
                    'textBody' => 'Wait host start room',
                    'isCheckStart' => false
                ]);       
            }else {
                print('Chuyen thang qua luon vi bat dau roi');
            }
        }

        // return view not have room (todo) will edit return
        return view('users.entercode', [
            'title' => "Room not available",
        ]); 
    }

    private function checkUserExist(array $users, $id){
        foreach ($users as $user) {
            if ($user['id'] == $id) {
                return true;
            }
        }
        return false;
    }

    private function moveToRoom(Request $request){

    }

    private function insertUserToRoom($url_current, $idroom, $iduser, $nameuser){
        Http::put($url_current.'/joinroom/addusertoroom?idroom='.$idroom.'&iduser='.$iduser.'&nameuser='.$nameuser);
    }

    private function saveCookie($idroom, $iduser, $nameuser){
        $cookie_name = 'userRoom';
        $cookie_value = ['idroom' => $idroom, 'iduser' => $iduser, 'nameuser' => $nameuser];
        if(!isset($_COOKIE[$cookie_name])) {
            echo "Cookie named '" . $cookie_name . "' is not set!";
            setcookie($cookie_name, json_encode($cookie_value), time() + (86400 * 30), "/"); // 86400 = 1 day
            return false;
        }
        return true;
    }
}
