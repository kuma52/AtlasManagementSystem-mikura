<?php

namespace App\Models\Posts;

use Illuminate\Database\Eloquent\Model;

class PostSubCategories extends Model
{
    //
    protected $fillable = [
        'post_id',

        'sub_category_id',
    ];

    public function setUpdatedAtAttribute($value){
    }

    // リレーションの定義
    public function post(){
        return $this->belongsTo('App\Models\Post');
    }

    public function subCategory(){
        return $this->belongsTo('App\Models\Categories\SubCategory');
    }
}
