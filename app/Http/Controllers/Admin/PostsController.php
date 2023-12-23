<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class PostsController extends Controller
{
    // 以下を追記
    public function create()
    {
        return view('admin.posts.create');
    }
}
