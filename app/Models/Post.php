<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use App\Models\User;

// 以下の1行を追記することで、History Modelが扱えるようになる
use App\Models\History;

class Post extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');

    public static $rules = array(
        'title' => 'required',
        'body' => 'required',
    );
    
    // この投稿をしたユーザを関連付けるメソッド
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    
    // 以下を追加
    // この投稿に関する履歴を関連付けるメソッド
    public function histories()
    {
        return $this->hasMany(History::class);
    }
}
