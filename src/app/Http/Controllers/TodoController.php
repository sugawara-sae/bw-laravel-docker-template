<?php

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
// Illuminate\Http\Request; = 
// ユーザーがフォームから送信したデータ（入力、バリデーション、ファイルアップロードなど）や
// クッキー、ヘッダー、URLなどのリクエストに関するあらゆる情報を取得できる。


class TodoController extends Controller
{
    public function index()
    {
        $todo = new Todo();
        $todos = $todo->all();
        // 実務では $todos = Todo::all(); と書くのが一般的。
        // $todos = Todo::all();　クラスから直接呼び出し。
        // $todo = new Todo();　$todo->all();　インスタンスを作ってから呼び出し。
        return view('todo.index',['todos' => $todos]);
        // viewでindex.blade.phpに渡す。
    }

    public function create()
    {
        return view('todo.create');
    }

    public function store(Request $request)
    // public function store(...)
        //store はメソッド名。Laravelでは「新しいデータを保存する処理」にこの名前をよく使う。
    // Request $request
        // Request は Laravelの HTTPリクエストを扱うクラス。
        // $request はそのクラスの インスタンス（実体）。
        // つまり、送られてきたフォームの中身（入力データ）を扱えるようにしている。
    {
        $inputs = $request->all();
        // フォームから送信された入力欄を連想配列で取得できる。

        $todo = new Todo(); 
        // todosテーブルの1レコードを表すTodoクラスをインスタンス化。
        $todo->user_id = Auth::id();
        // user_idをフォームからしか受け取らない。
        //  = 悪意のあるユーザーが、フォームを改ざんして他人のuser_idを指定しても無視される。
        $todo->fill($inputs);
        // ->fill()を使用することで、引数に指定した連想配列を一括代入できる。
        $todo->save();
        // Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行
        // 上記の流れをまとめると、 $todo -> fill($request->all()) -> save();
        return redirect()->route('todo.index');
        // redirect() = ブラウザに「別のURLに移動してね」と指示を出す。
        // route('ルート名') = 名前付きルートを指定して、そのURLを自動生成する。
    }
}

?>