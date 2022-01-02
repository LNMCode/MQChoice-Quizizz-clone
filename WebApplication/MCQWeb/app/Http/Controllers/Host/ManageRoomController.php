<?php

namespace App\Http\Controllers\Host;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Storage;
use Auth;
use Response;

class ManageRoomController extends Controller
{
    public function index(Request $request, $idroom){
        $url_current = 'http://127.0.0.1:3000';
        if(isset($idroom)){
            $cookie = $_COOKIE['userLogin'];
            $cookie = json_decode($cookie, true);
            $iduser = $cookie['iduser'];

            if(isset($idroom)){
                $response = Http::post($url_current.'/room/getroombyid?idroom='.$idroom.'&iduser='.$iduser);
                if($response['message'] != 'fail'){
                    $room = $response['doc'];
                    return view('host.manageroom',[
                        'title' => 'Manage Room '.$idroom,
                        'room' => $room,
                        'url' => $url_current.'/room'
                    ]);
                }
            } else {
                return view('host.manageroom',[
                    'title' => 'Manage Room create new',
                    'room' => null,
                    'url' => $url_current.'/room'
                ]);
            }
        }

        return view('host.manageroom', [
            'title' => 'Manage room',
            'room' => null,
            'url' => $url_current.'/room'
        ]);
    }

    public function downloadform(){
        $file= public_path(). "/download/form_question.csv";

        $headers = array(
                'Content-Type: text/csv',
                );

        return Response::download($file, 'form_question.csv', $headers);
    }

    public function insertform(Request $request){
        $path = $request->file('file')->store('public/storefile');
        $idroom = $request->input('idroom');
        $index = $request->input('index');
        $contents = Storage::get($path);
       # echo dd($contents);
        $array = explode("\r\n",$contents);
        unset($array[0]);
        unset($array[count($array)]);
        
        array_push($array, $idroom);
        array_push($array, $index);
        $response = Http::withHeaders(['Content-Type' => 'application/json'])
                    ->send('POST', 'http://127.0.0.1:3000/room/addquestionbycsv', [
                        'body' => json_encode($array),
                    ])->json();
        return redirect()->back();
    }
}
