<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// 追記
use App\Models\Post;

class PostsController extends Controller
{
    public function index(Request $request)
    {
        $posts = Post::all()->sortByDesc('updated_at');

        if (count($posts) > 0) {
            $headline = $posts->shift();
        } else {
            $headline = null;
        }

        // posts/index.blade.php ファイルを渡している
        // また View テンプレートに headline、 posts、という変数を渡している
        return view('posts.index', ['headline' => $headline, 'posts' => $posts]);
    }
}
