<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class RegisterRequest extends FormRequest
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
            'over_name' => 'required|string|max:10|',
            'under_name' => 'required|string|max:10|',
            'over_name_kana' => 'required|string|max:30|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'under_name_kana' => 'required|string|max:30|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'mail_address' => 'required|max:100|email|unique:users',
            'sex' => 'required|',
            'old_year' => 'required|after:1999',
            'old_month' => 'required|present',
            'old_day' => 'required|before:today',
            'role' => 'required|',
            'password' => 'required|between:8,30|confirmed',
        ];
    }

    public function messages(){
        return [
            //苗字
            'over_name.required' => '入力は必須です',
            'over_name.string' => '無効な入力です',
            'over_name.max' => '姓は10文字以内で入力してください',
            //名前
            'under_name.required' => '入力は必須です',
            'under_name.string' => '無効な入力です',
            'under_name.max' => '名は10文字以内で入力してください',
            //ミョウジ
            'over_name_kana.required' => '入力は必須です',
            'over_name_kana.string' => '無効な入力です',
            'over_name_kana.max' => 'セイは30文字以内で入力してください',
            'over_name_kana.regex' => 'カタカナで入力ください',
            //ナマエ
            'under_name_kana.required' => '入力は必須です',
            'under_name_kana.string' => '無効な入力です',
            'under_name_kana.max' => 'メイは30文字以内で入力してください',
            'under_name_kana.regex' => 'カタカナで入力ください',
            //address
            'mail_address.required' => '入力は必須です',
            'mail_address.max' => '100文字以内で入力してください',
            'mail_address.email' => '形式が無効です',
            'mail_address.unique' => '登録済みのアドレスです',
            //性別
            'sex.required' => '入力は必須です',
            //'sex' => '',
            //生年月日
            'old_year.required' => '年の入力は必須です',
            'old_year.after' => '2000年以降の日付にしてください',
            'old_month.required' => '月の入力は必須です',
            'old_month.present' => '今日までの日付で入力してください',
            'old_day.required' => '日の入力は必須です',
            'old_day.before' => '今日までの日付で入力してください',
            //役割
            'role.required' => '入力は必須です',
            //パスワード
            'password.required' => '入力は必須です',
            'password.between' => '8~30文字にしてください',
            'password.confirmed' => 'パスワードと確認用が一致しません',
        ];
    }
}
