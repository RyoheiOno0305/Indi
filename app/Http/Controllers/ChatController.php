<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Mail\SampleNotification;
use App\Events\ChatMessageRecieved;
use App\Message;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;

class ChatController extends Controller
{
    


    public function index(){

        return view('chat'); 

    }

    public function create(Request $request){

        \Message::create([
            'body' => $request->message
        ]);

    }
}
