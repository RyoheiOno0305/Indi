<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Ramsey\Uuid\Uuid;

class Product extends Model
{
    //
    // ユーザー関係
    public function users(){
        return $this->belongsToMany(User::class, 'likes', 'product_id', 'user_id');
    }

    // フォローされているか
    public function isLiked(Int $user_id) 
    {
        return (boolean) $this->users()->where('user_id', $user_id)->first(['id']);
    }

    // idをuuidで自動生成↓手順
    // プライマリーキーのカラム名
    protected $primaryKey = 'id';

    // プライマリーキーの型
    protected $keyType = 'string';

    // プライマリーキーは自動連番か？
    public $incrementing = false;

    // コンストラクタを追加
    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);

        // newした時に自動的にuuidを設定する。
        $this->attributes['id'] = Uuid::uuid4()->toString();
    }
    
    
}
