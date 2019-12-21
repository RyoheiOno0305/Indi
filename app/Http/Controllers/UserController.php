<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;
use App\Profile;
use App\User;
use App\FollowUser;
use Auth;


class UserController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }
        
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::all();
        return view('personal_page.index')->with('users', $users); 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $user_id = Auth::id();
        return view('personal_page.profile')->with('user_id', $user_id);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProfileRequest $request, User $user)
    {
        // 画像
        $request->image->storeAs('public/profile_images', Auth::id() . '.jpg');

        // 自己紹介文
        $profile = new Profile();
        $profile->self_introduction = $request->self_introduction;

        // ユーザーID
        $user_id = Auth::id();
        $profile->user_id = $request->user_id;

        // 保存
        $profile->save();

        return redirect("/user/{$user_id}")->with('success','成功しました');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function show(User $user)
    {
        //
        // 現在のページのユーザーID
        $user_id = $user->id;

        // ログインしているユーザー情報
        $login_user = Auth::user();

        // プロフィール情報
        $profile = Profile::where('user_id',$user_id)->latest()->first();

        // フォローを取得
        $follows = $user->follows()->get();

        // フォロワーを取得
        $followers = $user->followers()->get();

        return view('personal_page.personal')->with(['user_id'=>$user_id, 'profile'=>$profile, 'login_user'=>$login_user, 'follows'=>$follows, 'followers'=>$followers]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function edit(User $user)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Profile $profile)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Profile  $profile
     * @return \Illuminate\Http\Response
     */
    public function destroy(Profile $profile)
    {
        //
    }
}
