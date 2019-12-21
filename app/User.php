<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Product;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function followers()
    {
        return $this->belongsToMany(self::class, 'follow_users', 'followed_id', 'following_id');
    }

    public function follows()
    {
        return $this->belongsToMany(self::class, 'follow_users', 'following_id', 'followed_id');
    }

    // フォローする
    public function follow(Int $user_id) 
    {
        return $this->follows()->attach($user_id);
    }

    // フォロー解除する
    public function unfollow(Int $user_id)
    {
        return $this->follows()->detach($user_id);
    }

    // フォローしているか
    public function isFollowing(Int $user_id) 
    {
        return (boolean) $this->follows()->where('followed_id', $user_id)->first(['id']);
    }

    // フォローされているか
    public function isFollowed(Int $user_id) 
    {
        return (boolean) $this->followers()->where('following_id', $user_id)->first(['id']);
    }




    // プロダクト関係
    public function products()
    {
        return $this->belongsToMany(Product::class, 'likes', 'user_id', 'product_id');
    }

    // お気にいり
    public function like($product_id) 
    {
        return $this->products()->attach($product_id);
    }

    // お気に入り解除
    public function unlike($product_id)
    {
        return $this->products()->detach($product_id);
    }

    // お気に入りしているか
    public function isLiking($product_id) 
    {
        return (boolean) $this->products()->where('product_id', $product_id)->first(['id']);
    }

    // itemCodeによるお気に入り確認
    public function itemCodeLiking($itemCode)
    {
        return (boolean) $this->products()->where('itemCode', $itemCode)->first(['id']); 
    }

    

    // チャット関連
    public function messages(){
        return $this->belongsTo('App\Message');
    }
    
}
