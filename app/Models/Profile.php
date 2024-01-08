<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;

// 以下を追加
use App\Models\ProfileHistory;

class Profile extends Model
{
    use HasFactory;
    
    protected $guarded = array('id');

    public static $rules = array(
        'name' => 'required',
        'gender' => 'required',
        'hobby' => 'required',
        'introduction' => 'required',
    );   
    
    // 以下を追加
    // このプロフィールを持つユーザを関連付けるメソッド
    public function user()
    {
        return $this->belongsTo(User::class);
    } 
    
    // 以下を追加
    // このプロフィールの持つ編集履歴を関連付けるメソッド
    public function histories()
    {
        return $this->hasMany(ProfileHistory::class);
    }
}
