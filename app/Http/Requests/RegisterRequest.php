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
     *  rules()の前に実行される
     *       $this->merge(['key' => $value])を実行すると、
     *       フォームで送信された(key, value)の他に任意の(key, value)の組み合わせをrules()に渡せる
     */
    public function getValidatorInstance(){
        //プルダウンで選択された値を取得('フォームで送信されたkey','value')
        $datetime = [
            $this-> input('old_year'),
            $this-> input('old_month'),
            $this-> input('old_day')
        ];

        //日付を作成
        $datetime_validation = implode('-', $datetime);

        //rules()に渡す値をセット。→これによってこの場で作った変数にもバリデーションをかけることができる。
        $this->merge(['datetime_validation' => $datetime_validation,]);

        return parent::getValidatorInstance();
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        // dd($datetime_validation);
        return [
            'over_name' => 'required|string|max:10|',
            'under_name' => 'required|string|max:10|',
            'over_name_kana' => 'required|string|max:30|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'under_name_kana' => 'required|string|max:30|regex:/^[ア-ン゛゜ァ-ォャ-ョー]+$/u',
            'mail_address' => 'required|max:100|email|unique:users',
            'sex' => 'required|in:1,2,3',//1,2,3以外の値は認めないよの記述
            // 'old_year' => 'required|after:1999',
            // 'old_month' => 'required|present',
            // 'old_day' => 'required|before:today',
            'datetime_validation' => 'required|date|after:1999-12-31|before:today',//インスタンスで作ったやつ
            'role' => 'required|in:1,2,3,4',//1,2,3以外の値は認めないよの記述
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
            'sex.in' => '無効な値です',

            //生年月日
            'datetime_validation.required' => '入力は必須です',
            'datetime_validation.after' => '2000年以降の日付にしてください',
            'datetime_validation.before' => '今日までの日付で入力してください',
            'datetime_validation.date' => '無効な日付です',

            //役割
            'role.required' => '入力は必須です',
            'role.in' => '無効な値です',

            //パスワード
            'password.required' => '入力は必須です',
            'password.between' => '8~30文字にしてください',
            'password.confirmed' => 'パスワードと確認用が一致しません',
        ];
    }
}
