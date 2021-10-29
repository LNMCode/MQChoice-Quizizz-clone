<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class AdminController extends Controller
{
    public function index(Request $request){
        
        $cookie = $_COOKIE['userLogin'];
        if(isset($cookie)){
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
                        return view('admin', [
                            'title' => 'Admin page',
                            'data' => $user,
                            'rooms' => $rooms,
                            'type' => gettype($rooms)
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
}
