<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(){
        if(isset($_COOKIE['userLogin'])){
            $cookie = $_COOKIE['userLogin'];
            $cookie = json_decode($cookie, true);
            $iduser = $cookie['iduser'];
            $username = $cookie['username'];
            $password = $cookie['password'];

            if(!empty($username) && !empty($password)){
                return view('home', [
                    'title' => 'Home page',
                    'data' => $username,
                ]);
            }
        }
        return view('Home', [
            'title' => "Home Page",
            'data' => null
        ]);
    }

    public function signout(){
        $cookie = $_COOKIE['userLogin'];
        if(isset($cookie)){
            setcookie('userLogin', '' , time() - 3600);
            unset($cookie);
        }
        return view('home', [
            'title' => 'Home page',
            'data' => null,
        ]);
    }
}
