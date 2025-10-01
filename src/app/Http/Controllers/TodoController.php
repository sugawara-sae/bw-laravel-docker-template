<?php
// Section7
// 実行したい処理はここにまとめる。

namespace App\Http\Controllers;

use App\Todo;
use Illuminate\Http\Request;
// Illuminate\Http\Request; = 
// ユーザーがフォームから送信したデータ（入力、バリデーション、ファイルアップロードなど）や
// クッキー、ヘッダー、URLなどのリクエストに関するあらゆる情報を取得できる。


class TodoController extends Controller
{
    public function index()
    // Section7 ~
    // ToDo一覧表示ページの処理内容。
    {
        $todo = new Todo();
        // Section8
        // TodoControllerでTodoModelを使えるようにするために、インスタンス化。
        $todos = $todo->all();
        // Section8
        // ここからtodosテーブルのレコードを全件取得するための実装。
        // 実務では $todos = Todo::all(); と書くのが一般的。
        // $todos = Todo::all();　クラスから直接呼び出し。
        // $todo = new Todo();　$todo->all();　インスタンスを作ってから呼び出し。
        return view('todo.index',['todos' => $todos]);
        // Section7
        // view関数を用いることで、画面として表示したいHTMLを指定することができる。
        // view関数の引数には、表示させたいBladeファイルを指定する必要がある。
        // Section9
        // 取得したデータを画面に渡す。第二引数の実装。
    }


    public function create()
    // Section11 ~
    // 新規作成画面の処理内容。
    {
        return view('todo.create');
    }


    public function store(Request $request)
    // Section13
    // 新規作成のルートに対応するControllerのメソッドを定義。
    // 引数に Request $request と書くことで、
    // $requestにRequestクラスのインスタンスを代入している。
    // Laravelでは、メソッドの引数の左側にクラス名を書くことで、インスタンス化が自動で行われる。
    {
        $inputs = $request->all();
        // Section13
        // フォームから送信されたToDoの内容を取得。
        // Section14
        // ->all()で、フォームから送信された値を一括で取得。

        $todo = new Todo(); 

        $todo->user_id = Auth::id();
        // Section14
        // user_idをフォームからしか受け取らない。
        //  = 悪意のあるユーザーが、フォームを改ざんして他人のuser_idを指定しても無視される。

        $todo->fill($inputs);
        // Section14
        // 連想配列で取得した値を、->fill()を使用して、
        // Todoインスタンスの各プロパティに一括で代入する。

        $todo->save();
        // Section14
        // Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行。
        // 上記の流れをまとめると、 $todo -> fill($request->all()) -> save();

        return redirect()->route('todo.index');
        // Section13
        // ToDoが新規作成された後に、一覧画面を表示させるためのリダイレクト定義。
        // redirect() = ブラウザに「別のURLに移動してね」と指示を出す。
    }

    
    public function show($id)
    // Section16
    // 詳細取得のルートに対応するControllerのメソッドの定義。
    // show()メソッドの引数には、ルート定義で指定したルートパラメータを受け取ることができる。
    // 今回は$idという変数で受け取るようにする。
    {
    $model = new Todo();
    $todo = $model->find($id);
    // Section16
    // find()メソッドで指定のIDのデータを取得。
    // データベースのidカラムが$idの値と一致するレコードを取得。
    return view('todo.show', ['todo' => $todo]);
    }
}

?>