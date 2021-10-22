<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class LoginController extends Controller
{
    public function index(){
        return view('users.login', [
            'title' => "Login",
        ]);
    }

    public function login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $url_current = 'http://127.0.0.1:3000';

        $response = Http::post($url_current.'/login?username='.$username.'&password='.$password);
        $user = json_decode($response, true);
        if(!empty($username) && !empty($password)){
            if($username == $user['username'] && $password == $user['password'])
                $rooms = $this->getListRoomById($user['rooms'], $url_current);
                return view('admin', [
                    'title' => 'Admin page',
                    'data' => $user,
                    'rooms' => $rooms,
                    'type' => gettype($rooms)
                ]);
        }
        return view('users.login', [
            'title' => "Invalid user",
        ]);
    }

    private function getListRoomById(array $ids, $url_current){
        $rooms = array();
        if (sizeof($ids) > 0){
            foreach($ids as $id){
                $response = Http::post($url_current.'/room/getroombyid?idroom='.$id['idroom']);
                array_push($rooms, $response);
            }
        }
        return $rooms;
    }
}
