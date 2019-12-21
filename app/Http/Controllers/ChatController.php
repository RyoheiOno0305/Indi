<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SampleNotification;
use App\Events\ChatMessageRecieved;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use App\User;
use App\Message;
use App\Room;

class ChatController extends Controller
{
    public function index($recieve){

        $loginId = Auth::id();

        // メッセージを取得
        $messages = Message::where('send', $loginId)->where('recieve', $recieve)->orWhere( function ($query) use($loginId , $recieve){
            $query->where('send', $recieve);
            $query->where('recieve', $loginId);
        })->get();
        
        return view('chat')->with(['recieve'=>$recieve, 'loginId' => $loginId, 'messages' => $messages]); 
        
    }

    public function json(){
        $loginId = Auth::id();
        
        $users = User::where('id', $loginId)->orWhere(function ($query){
            $query->where('id', 2);
        })->get();
        $messages = Message::all();
        return [
            'messages' =>$messages,
            'users' => $users
        ];
        // $name = $user->name;
        // dd($name);
    }

     
}
