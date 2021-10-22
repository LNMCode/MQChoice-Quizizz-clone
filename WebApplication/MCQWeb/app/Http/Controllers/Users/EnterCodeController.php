<?php

namespace App\Http\Controllers\Users;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class EnterCodeController extends Controller
{
    public function index(){
        return view('users.entercode', [
            'title' => "Join room",
        ]);
    }
}
