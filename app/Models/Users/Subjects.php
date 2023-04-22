<?php

namespace App\Models\Users;

use Illuminate\Database\Eloquent\Model;

use App\Models\Users\User;

class Subjects extends Model
{
    const UPDATED_AT = null;


    protected $fillable = [
        'subject'
    ];

    public function users(){
        // リレーションの定義
        return $this->belongsToMany(
            'App\Models\Users\User',//最終的な接続先モデル名
            'subject_users',//中間テーブル名
            'subject_id',//接続元モデルIDのカラム名
            'user_id'//接続先モデルIDを示す中間テーブル内のカラム名
        );
    }

    //belongsToMany('①最終的な接続先モデル名','②中間テーブル名','③接続先モデルIDを示す中間テーブル内のカラム名','④接続元モデルIDのカラム名','⑤接続先モデルIDのカラム名','⑥最終的な接続先モデルIDのカラム名')
}
