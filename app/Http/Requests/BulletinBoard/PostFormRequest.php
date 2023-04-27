<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class PostFormRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            //'post_category_id' => 'required|',//「登録されているサブカテゴリ―か」
            'post_title' => 'required|string|max:100|',
            'post_body' => 'required|string|max:500|',
        ];
    }

    public function messages(){
        return [
            //タイトル
            'post_title.required' => 'タイトルは必須項目です',
            'post_title.string' => 'タイトルの入力内容が無効です',
            //'post_title.min' => 'タイトルは4文字以上入力してください。',
            'post_title.max' => 'タイトルは100文字以内で入力してください。',

            //投稿内容
            //'post_body.min' => '内容は10文字以上入力してください。',
            'post_body.required' => '投稿内容は必須項目です',
            'post_body.string' => '投稿の入力内容が無効です',
            'post_body.max' => '投稿の最大文字数は500文字です',
        ];
    }
}
