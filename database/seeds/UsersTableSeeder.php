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
            'under_name' => '文香',
            'over_name_kana' => 'みくら',
            'under_name_kana' => 'ふみか',
            'mail_address' => 'mikura@mail.com',
            'sex' => '2',
            'birth_day' => '19921208',
            'role' => '1',
            'password' => bcrypt('fkuma52'),
            // 'remember_token' => ,
            // 'created_at' => ,
            // 'updated_at' => ,
            // 'deleted_at' => ,
        ]);
    }
}
