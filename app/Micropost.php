<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content', 'user_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
//お気に入り登録
public function favorited()
    {
        return $this->belongsToMany(User::class, 'post_favorite', 'follow_id', 'favorite_id')->withTimestamps();
    }
    public function favorite($userId)
{
    // 既にお気に入りしているかの確認
    $exist = $this->is_favoriting($userId);

    if ($exist) {
        // 既にフォローしていれば何もしない
        return false;
    } else {
        // 未フォローであればフォローする
        $this->favoritings()->attach($userId);
        return true;
    }
}

public function unfavorite($userId)
{
    // 既にイイねしているかの確認
    $exist = $this->is_favoriting($userId);


    if ($exist && !$its_me) {
        // 既にフォローしていればフォローを外す
        $this->favoritings()->detach($userId);
        return true;
    } else {
        // 未フォローであれば何もしない
        return false;
    }
}

public function is_favoriting($userId) {
    return $this->favoritings()->where('follow_id', $userId)->exists();
}
}
