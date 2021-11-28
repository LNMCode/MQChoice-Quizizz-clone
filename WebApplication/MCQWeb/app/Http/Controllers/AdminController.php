<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function index(Request $request){
        
        if(isset($_COOKIE['userLogin'])){
            $cookie = $_COOKIE['userLogin'];
            $cookie = json_decode($cookie, true);
            $iduser = $cookie['iduser'];
            $username = $cookie['username'];
            $password = $cookie['password'];
            $url_current = 'http://127.0.0.1:3000';
    
            if(!empty($username) && !empty($password)){
                $response = Http::post($url_current.'/login?username='.$username.'&password='.$password);
                if($response['message'] != 'fail'){
                    $user = $response['doc'];
                    if($username == $user['username'] && $password == $user['password']){
                        $rooms = $this->getListRoomById($user['rooms'], $url_current, $user['id']);
                        $allroom = $this->getallroom($url_current);

                        return view('admin', [
                            'title' => 'Admin page',
                            'data' => $user,
                            'rooms' => $rooms,
                            'allroom' => $allroom,
                            'type' => gettype($rooms),
                            'url' => $url_current.'/room'
                        ]);
                    }
                }
            }
        }
       
        return view('users.login', [
            'title' => "Please login",
        ]);
    }

    private function getListRoomById(array $ids, $url_current, $iduser){
        $rooms = array();
        if (sizeof($ids) > 0){
            foreach($ids as $id){
                $response = Http::post($url_current.'/room/getroombyid?idroom='.$id['idroom'].'&iduser='.$iduser);
                if($response['message'] != 'fail') array_push($rooms, $response['doc']);
            }
        }
        return $rooms;
    }

    public function public(Request $request){
        $ispublic = $request->input('public');
        $url_current = 'http://127.0.0.1:3000';
        if(!empty($ispublic)){
            $response = Http::post($url_current.'/room/public?public='.$ispublic);
            
        }
    }

    private function getallroom($url_current){
        $response = Http::get($url_current.'/room/getallroom');
        return $response['doc'];
    }
}
