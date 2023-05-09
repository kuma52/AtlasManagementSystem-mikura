<?php

namespace App\Models\Calendars;

use Illuminate\Database\Eloquent\Model;

class ReserveSettings extends Model
{
    const UPDATED_AT = null;
    public $timestamps = false;

    protected $fillable = [
        'setting_reserve',
        'setting_part',
        'limit_users',
    ];

    public function users(){
        return $this->belongsToMany(
            'App\Models\Users\User',//最終的な接続先モデル名
            'reserve_setting_users',//中間テーブル名
            'reserve_setting_id',//接続先モデルIDを示す中間テーブル内のカラム名
            'user_id'//接続元モデルIDを示す中間テーブルのカラム名
            )->withPivot('reserve_setting_id', 'id');
            //reserve_setting_idはカレンダーのID
            //idは中間テーブルのID
            //reserve_setting_id と id カラムは、中間テーブルに自動的に保存されます。そのため、withPivot() メソッドでこれらのカラムを指定する必要はありません。withPivot() メソッドを使用して指定されるカラムは、中間テーブルに自動的に保存されるデフォルトのカラム以外の情報になります。

// おっしゃる通り、この場合の withPivot() メソッドで指定された reserve_setting_id と id は、自動的に中間テーブルに保存されるため、何か特別な意図があるわけではありません。おそらく、開発者が誤解していた可能性があります。

// ただし、withPivot() メソッドを使用して id カラムを指定することは、Laravel 8以前のバージョンでは必要でした。そのバージョンでは、中間テーブルに保存された主キーがデフォルトで id カラムとなっていたため、明示的に withPivot() メソッドで id カラムを指定していた可能性があります。Laravel 8以降では、中間テーブルに主キーがあらかじめ定義されていない場合は、自動的に主キーが設定されます。
    }
}
