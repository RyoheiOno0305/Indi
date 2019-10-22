<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Profile;
use Auth;

class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    public function personal()
    {
        return view('personal_page.personal');
    }

    public function profile()
    {
        // ログイン中ユーザー情報を取得
        $user_id = Auth::id();
        return view('personal_page.profile', ['user_id' => $user_id]);
    }

    public function store(ProfileRequest $request)
    {
        // 画像
        $image = $request->image;
        $image->store('public/profile_images');

        // 自己紹介文
        $profile = new Profile;
        $profile->user_id = $request->user_id;
        $profile->self_introduction = $request->self_introduction;
        $profile->save();
        
        return redirect('personal')->with('success', '新しいプロフィールを登録しました');

    }
}
