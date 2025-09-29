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
        $content = $request->input('content');

        $todo = new Todo(); 
        // todosテーブルの1レコードを表すTodoクラスをインスタンス化
        $todo->content = $content;
        // Todoインスタンスのカラム名のプロパティに保存したい値を代入
        $todo->save();
        // Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行

        return redirect()->route('todo.index');
    }
}

?>