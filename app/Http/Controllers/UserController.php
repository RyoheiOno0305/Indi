<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\ProfileRequest;

class ProfileController extends Controller
{

    /**
     * プロフィールの保存
     *
     * @param ProfileRequest $request
     * @return Response
     */
    public function store(ProfileRequest $request)
    {
    }
}

class UserController extends Controller
{
    
    public function personal()
    {
        return view('personal_page.personal');
    }

    public function profile()
    {
        return view('personal_page.profile');
    }

    public function store(ProfileRequest $request)
    {
        $request->image->store('public/profile_images');

        return redirect('personal')->with('success', '新しいプロフィールを登録しました');

    }
}
