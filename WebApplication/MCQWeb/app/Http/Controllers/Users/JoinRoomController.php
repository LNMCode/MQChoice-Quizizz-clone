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
        $isExist = $this->saveCookie($idRoom, $iduser, $nameUser);
        $response = Http::get($url_current.'/joinroom/getroom?idroom='.$idRoom);
        #echo $response;
        if($response['message'] != 'fail'){
            $room = $response['doc'];
            $isResetPlay = false;
            
            if (isset($room)){
                if(!$room['isopen']){
                    $this->removeCookie();
                    return view('users.entercode', [
                        'title' => "Room is not open, please contact host room",
                    ]); 
                }
                //echo $isExist;
                if($isExist){
                    $cookie = $_COOKIE['userRoom'];
                    $cookie = json_decode($cookie, true);
                    $iduser = $cookie['iduser'];
                    $nameuser = $cookie['nameuser'];
                    if($this->checkUserExist($room['players'], $iduser)){
                        // Hoi co muon reset hay continous
                        //print('Da ton tai tai khoan');
                        // Check them la da played chua,
                        // neu roi chi ms hoi
                        if($room['isstart']){
                            // Ktra da choi chua o day >
                            return view('users.joinroom', [
                                'title' => 'Join Room',
                                'textBody' => 'Do you want reset all answer?',
                                'room' => $room,
                                'iduser' => $iduser,
                                'nameuser' => $nameuser,
                                'isCheckStart' => false,
                            ]);       
                        } else {
                            return view('users.joinroom', [
                                'title' => 'Join Room',
                                'textBody' => 'Wait host start room',
                                'room' => $room,
                                'iduser' => $iduser,
                                'nameuser' => $nameuser,
                                'isCheckStart' => false
                            ]);
                        }
                        // Neu chua thi start luon
                    } else {
                        // Throw error not availble in server
                    }
                } else {
                    //print('Chua ton tai tai khoan');
                    //insert user
                    $this->insertUserToRoom($url_current,$idRoom, $iduser, $nameUser);
                    if(!$room['isstart']){
                        return view('users.joinroom', [
                            'title' => 'Join Room',
                            'textBody' => 'Wait host start room',
                            'room' => $room,
                            'iduser' => $iduser,
                            'nameuser' => $nameUser,
                            'isCheckStart' => false
                        ]);       
                    }else {
                        //print('Chuyen thang qua luon vi bat dau roi');
                        return view('users.roomques', [
                            'title' => 'Room Started',
                            'idroom' => $idRoom,
                            'iduser' => $iduser,
                            'nameuser' => $nameUser,
                            'listQues' => $room['data']
                        ]);
                    }
                }   
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
            //echo "Cookie named '" . $cookie_name . "' is not set!";
            setcookie($cookie_name, json_encode($cookie_value), time() + (86400 * 30), "/"); // 86400 = 1 day
            return false;
        }
        return true;
    }

    private function removeCookie(){
        if(isset($_COOKIE['userRoom'])){
            setcookie('userRoom', '' , time() - 3600);
            unset($cookie);
        }
    }
}
