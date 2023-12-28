<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

// 以下の1行を追記することで、User Modelが扱えるようになる
use App\Models\User;

class Post extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    // 以下を追加
    // この投稿をしたユーザを関連付けるメソッド
    public function user()
    {
        return $this->belongsTo(User::class);
    }    
}
