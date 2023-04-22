<?php

namespace App\Models\Users;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\SoftDeletes;

use App\Models\Posts\Like;
use Auth;

class User extends Authenticatable
{
    use Notifiable;
    use softDeletes;

    const CREATED_AT = null;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'over_name',
        'under_name',
        'over_name_kana',
        'under_name_kana',
        'mail_address',
        'sex',
        'birth_day',
        'role',
        'password'
    ];

    protected $dates = ['deleted_at'];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function posts(){
        return $this->hasMany('App\Models\Posts\Post');
    }

    public function calendars(){
        return $this->belongsToMany('App\Models\Calendars\Calendar', 'calendar_users', 'user_id', 'calendar_id')->withPivot('user_id', 'id');
    }

    public function reserveSettings(){
        return $this->belongsToMany('App\Models\Calendars\ReserveSettings', 'reserve_setting_users', 'user_id', 'reserve_setting_id')->withPivot('id');
    }

    public function subjects(){
        // リレーションの定義
        return $this->belongsToMany(
            'App\Models\Users\Subjects',//最終的な接続先モデル名
            'subject_users',//中間テーブル名
            'user_id',//接続先モデルIDを示す中間テーブル内のカラム名
            'subject_id'//接続元モデルIDを示す中間テーブルのカラム名
        );
    }
    //belongsToMany('①最終的な接続先モデル名','②中間テーブル名','③接続先モデルIDを示す中間テーブル内のカラム名','④接続元モデルIDのカラム名','⑤接続先モデルIDのカラム名','⑥最終的な接続先モデルIDのカラム名')

    // いいねしているかどうか
    public function is_Like($post_id){
        return Like::where('like_user_id', Auth::id())->where('like_post_id', $post_id)->first(['likes.id']);
    }

    public function likePostId(){
        return Like::where('like_user_id', Auth::id());
    }
}
