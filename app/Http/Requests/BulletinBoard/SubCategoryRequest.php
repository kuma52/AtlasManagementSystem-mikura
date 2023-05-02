<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class SubCategoryRequest extends FormRequest
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
            //
            'main_category_id' => 'required|exists:main_categories,id',
            //exists:テーブル名,カラム名→テーブル名に登録されているカラム名の値か
            'sub_category' => 'required|max:100|string|unique:sub_categories,sub_category',
        ];
    }

    public function messages()
    {
        return [
            //
            'sub_category.required' => '未入力です',
            'sub_category.max' => '100文字以内にしてください',
            'sub_category.string' => '無効な文字列です',
            'sub_category.unique' => '登録済みです',
            'main_category_id.required' => 'メインカテゴリを選択してください',
            'main_category_id.exists' => 'メインカテゴリの値が無効です',
        ];
    }
}
