<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

class ProfilesController extends Controller
{
    public function create()
    {
        return view('admin.profiles.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, Profile::$rules);

        // フォーム画面から送られてきた各種値を取得
        $name = $request->name;
        $gender = $request->gender;
        $hobby = $request->hobby;
        $introduction = $request->introduction;
        $file = $request->file('image');

        // 空のProfileインスタンスを作成
        $profile = new Profile;
        
        // Profileインスタンスにプロパティを設定
        $profile->user_id = \Auth::id(); // ログインしているユーザーのid
        $profile->name = $name;
        $profile->gender = $gender;
        $profile->hobby = $hobby;
        $profile->introduction = $introduction;

        // データベースに保存する
        $profile->save();
        return redirect('admin/profiles/create');
    }

    public function edit()
    {
        return view('admin.profiles.edit');
    }

    public function update()
    {
        return redirect('admin/profiles/edit');
    }
}
