<?php

namespace App\Http\Requests\BulletinBoard;

use Illuminate\Foundation\Http\FormRequest;

class MainCategoryRequest extends FormRequest
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
            'main_category' => 'required|max:100|string|unique:main_categories,main_category',
        ];
    }
    public function messages()
    {
        return [
            //
            'main_category.required' => '入力してください',
            'main_category.max' => '100文字以内にしてください',
            'main_category.string' => '無効な文字列です',
            'main_category.unique' => '登録済みです',
        ];
    }
}
