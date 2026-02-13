<?php
// Section20
// バリデーション実装。
// dockerのappコンテナ内で php artisan make:request TodoRequest を実行してファイル作成。

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TodoRequest extends FormRequest
// FormRequest は Illuminate\Http\Request を継承しているため、
// TodoController.phpの $request->all() などは変更せずに動いてくれる。
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
        // ここがfalseのままだと全てのリクエストを受け付けなくなる。
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'content' => 'required|max:255',
            // keyは入力欄のname属性、valueは検証するバリデーションルール。
            // required = 「入力が必須」
            // max:** = 「入力された値が指定の文字数以下」
        ];
    }

    public function messages()
    {
        return [
            'content.required' => 'ToDoが入力されていません。',
            'content.max' => 'ToDoは :max 文字以内で入力してください。',
            // 入力欄のname属性.ルール => メッセージ
        ];
    }
}
