<?php

namespace App\Http\Controllers\Ajax;
use App\Events\MessageCreated;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Message;
use App\User;
use Auth;

class ChatController extends Controller
{
    public function index($recieve) { 
        // 新着順にメッセージ一覧を取得
        $loginId = Auth::id();
        return Message::where('send', $loginId)->where('recieve', $recieve)->orWhere( function ($query)
        use ($loginId, $recieve)
        {
            $query->where('send', $recieve);
            $query->where('recieve', $loginId);
        })->get();
    }

    public function create(Request $request) { 
        // メッセージを登録
        $message = Message::create([
            'message' => $request->message,
            'send' => $request->loginId,
            'recieve' => $request->recieve
        ]);

        event(new MessageCreated($message));

        
    }
}