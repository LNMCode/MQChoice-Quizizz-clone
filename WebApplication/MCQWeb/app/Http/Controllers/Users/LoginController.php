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
            'isnew' => false,
        ]);
    }

    public function logincreatenew(){
        return view('users.login', [
            'title' => 'Create new a account',
            'isnew' => true,
        ]);
    }

    public function login(Request $request){
        $username = $request->input('username');
        $password = $request->input('password');
        $url_current = 'http://127.0.0.1:3000';

        if(!empty($username) && !empty($password)){
            $response = Http::post($url_current.'/login?username='.$username.'&password='.$password);
            if($response['message'] != 'fail'){
                $user = $response['doc'];
                if($username == $user['username'] && $password == $user['password']){
                    $rooms = $this->getListRoomById($user['rooms'], $url_current, $user['id']);
                    $this->saveUserLogin($user['id'], $user['username'], $user['password']);
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
        return view('users.login', [
            'title' => "Invalid user",
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

    private function saveUserLogin($iduserlogin, $username, $password){
        $cookie_name = 'userLogin';
        $cookie_value = ['iduser' => $iduserlogin, 'username' => $username, 'password' => $password];
        if(!isset($_COOKIE[$cookie_name])) {
            echo "Cookie named '" . $cookie_name . "' is not set!";
            setcookie($cookie_name, json_encode($cookie_value), time() + (86400 * 30), "/"); // 86400 = 1 day
            return false;
        }
        return true;
    }
    
    private function getallroom($url_current){
        $response = Http::get($url_current.'/room/getallroom');
        return $response['doc'];
    }
}
