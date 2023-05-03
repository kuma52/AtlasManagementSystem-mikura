<?php
namespace App\Searchs;

use App\Models\Users\User;

class SelectIdDetails implements DisplayUsers{

  // 改修課題：選択科目の検索機能
  public function resultUsers($keyword, $category, $updown, $gender, $role, $subjects){
    if(is_null($keyword)){//キーワードがnullの場合
      $keyword = User::get('id')->toArray();//すべてのユーザーを取得
    }else{//キーワードがnullじゃなかったら
      $keyword = array($keyword);//キーワードに即した配列を取得
    }

    if(is_null($gender)){//性別がnullの場合
      $gender = ['1', '2'];
    }else{
      $gender = array($gender);
    }

    if(is_null($role)){//役割がnullの場合
      $role = ['1', '2', '3', '4', '5'];
    }else{
      $role = array($role);
    }

    $users = User::with('subjects')//subjectsと関係のあるuserデータを取得
    ->whereIn('id', $keyword)
    ->where(function($q) use ($role, $gender){
      $q->whereIn('sex', $gender)
      ->whereIn('role', $role);
    })
    ->whereHas('subjects', function($q) use ($subjects){
      $q->whereIn('subjects.id', $subjects);
    })
    ->orderBy('id', $updown)->get();
    return $users;
  }

}
