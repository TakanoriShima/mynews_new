<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

// 以下の1行を追記することで、Post Modelが扱えるようになる
use App\Models\Post;

class PostsController extends Controller
{
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
        // 以下を追記
        
        // Validationを行う
        $this->validate($request, Post::$rules);

        // フォーム画面から送られてきた各種値を取得
        $title = $request->title;
        $body = $request->body;
        $file = $request->file('image');

        // 空のPostインスタンスを作成
        $post = new Post;
        
        // Postインスタンスにプロパティを設定
        $post->user_id = \Auth::id(); // ログインしているユーザーのid
        $post->title = $title;
        $post->body = $body;

        // フォームから画像が送信されてきたら、保存して、$post->image_path に画像のパスを保存する
        if ($file !== null) {
            $path = $file->store('public/image');
            $post->image_path = basename($path);
        } else {
            $post->image_path = null;
        }

        // データベースに保存する
        $post->save();
        
        // 追記ここまで

        return redirect('admin/posts/create');
    }    
}
