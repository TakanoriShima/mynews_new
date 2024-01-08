<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Profile;

// 以下を追記
use App\Models\ProfileHistory;
use Carbon\Carbon;

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

    public function edit(Request $request)
    {
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        // dd(\Auth::user());
        
        // もし、該当すプロフィールがない、もしくはそのプロフィールを作成したユーザーがログインした自分でなければ
        if(empty($profile) || $profile->user->id != \Auth::id()){
            return redirect('admin/profiles');   
        }
        return view('admin.profiles.edit', ['profile' => $profile]);
    }

    public function update(Request $request)
    {
       // Validationをかける
        $this->validate($request, Profile::$rules);
        
        // Profile Modelからデータを取得する
        $profile = Profile::find($request->id);
        
        // 送信されてきたフォームデータを格納する
        $name = $request->name;
        $gender = $request->gender;
        $hobby = $request->hobby;
        $introduction = $request->introduction;
        
        // Profileインスタンスにプロパティを設定
        $profile->name = $name;
        $profile->gender = $gender;
        $profile->hobby = $hobby;
        $profile->introduction = $introduction;

        // データベースに保存する
        $profile->save();
             
        // 以下を追記     
        $profile_history = new ProfileHistory;
        $profile_history->profile_id = $profile->id;
        $profile_history->edited_at = Carbon::now();
        $profile_history->save();   
        
        return redirect('admin/profiles');
    }
    
    public function index(Request $request)
    {
        $profiles = Profile::all();

        return view('admin.profiles.index', ['profiles' => $profiles]);
    } 
}
