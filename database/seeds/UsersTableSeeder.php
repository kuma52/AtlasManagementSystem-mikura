<?php

use Illuminate\Database\Seeder;
use App\Models\Users\User;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *DBに対するデータ設定の実行
     * @return void
     */
    public function run()
    {
        DB::table('users')->insert([
            // 'id' => ,
            'over_name' => '三倉',
            'under_name' => '健寛',
            'over_name_kana' => 'ミクラ',
            'under_name_kana' => 'タケヒロ',
            'mail_address' => 'takehiro@mail.com',
            'sex' => '1',
            'birth_day' => '20000204',
            'role' => '1',
            'password' => bcrypt('takehiro'),
            // 'remember_token' => ,
            // 'created_at' => ,
            // 'updated_at' => ,
            // 'deleted_at' => ,
        ]);
    }
}
