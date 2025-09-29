<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;


class TodoController extends Controller
{
    public function index()
    {
        $todo = new Todo();
        $todos = $todo->all();

        return view('todo.index',['todos' => $todos]);
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    {
        $inputs = $request->all();
        // フォームから送信された入力欄を連想配列で取得できる。

        $todo = new Todo(); 
        // todosテーブルの1レコードを表すTodoクラスをインスタンス化
        $todo->user_id = Auth::id();
        // user_idをフォームからしか受け取らない。
        //  = 悪意のあるユーザーが、フォームを改ざんして他人のuser_idを指定しても無視される。
        $todo->fill($inputs);
        // ->fill()を使用することで、引数に指定した連想配列を一括代入できる。
        $todo->save();
        // Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行

        return redirect()->route('todo.index');
    }
}

?>