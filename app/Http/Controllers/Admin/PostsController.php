<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Post;

class PostsController extends Controller
{
    public function create()
    {
        return view('admin.posts.create');
    }

    public function store(Request $request)
    {
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

        return redirect('admin/posts/create');
    }    
    
    public function index(Request $request)
    {
        $cond_title = $request->cond_title;
        if ($cond_title != null) {
            // 検索されたら検索結果を取得する
            $posts = Post::where('title', $cond_title)->get();
        } else {
            // それ以外はすべてのニュースを取得する
            $posts = Post::all();
        }
        return view('admin.posts.index', ['posts' => $posts, 'cond_title' => $cond_title]);
    }    
    
    public function edit(Request $request)
    {
        // Post Modelからデータを取得する
        $post = Post::find($request->id);
        
        // もし、該当するニュースがない、もしくはそのニュースを作成したユーザーがログインした自分でなければ
        if(empty($post) || $post->user != \Auth::user()){
            return redirect('admin/posts');   
        }
        return view('admin.posts.edit', ['post' => $post]);
    }

    public function update(Request $request)
    {
        // Validationをかける
        $this->validate($request, Post::$rules);
        
        // Post Modelからデータを取得する
        $post = Post::find($request->id);
        
        // 送信されてきたフォームデータを格納する
        $title = $request->title;
        $body = $request->body;
        $file = $request->file('image');
        
        // Postインスタンスにプロパティを設定
        $post->title = $title;
        $post->body = $body;

        // フォームから画像が送信されてきたら、保存して、$post->image_path に画像のパスを保存する
        if ($file !== null) {
            $path = $file->store('public/image');
            $post->image_path = basename($path);
        }
        
        // データベースに保存する
        $post->save();
        
        return redirect('admin/posts');
    }
    
    // 以下を追記
    public function destroy(Request $request)
    {
        // 該当するPost Modelを取得
        $post = Post::find($request->id);

        if($post->user_id == \Auth::id()){
            // 削除する
            $post->delete();
        }

        return redirect('admin/posts');
    }
}
