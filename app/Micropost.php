<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Micropost extends Model
{
    protected $fillable = ['content'];

    /**
     * この投稿を所有するユーザ。（ Userモデルとの関係を定義）
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    
    /**
     * このユーザがお気に入り登録するmicroposts。（ Userモデルとの関係を定義）
     */
    public function favorite_users()
    {
        return $this->belongsToMany(Micropost::class, 'favorites', 'micropost_id', 'user_id')->withTimestamps();
    }
    
    /**
     * このユーザがお気にいりしているmicropostsの件数をロードする。
     */

     public function loadRelationshipCounts()
    {
        
        $this->loadCount('favorite_users');
    }
    
}
