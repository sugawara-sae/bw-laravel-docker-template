<?php
// Section7
// appコンテナ内で
// php artisan make:controller TodoController
// を実行。
// web.phpに記述したルートで、実行したい処理はここにまとめる。

namespace App\Http\Controllers;

use App\Todo;
// new Todo（ = Todoモデル）を使用するための宣言。
// 「Todo.php」で作成した　class Todo extends Model　を継承している。

use App\Http\Requests\TodoRequest;
// use Illuminate\Http\Request;
// store(Request $request)（ = Request クラス）を使用するための宣言。
// ここで宣言しておくことで、クラス名のみの記述で作動するようになる。
// この宣言がない場合は、完全修飾名（フルパス）が必要になる。
// つまり、 $request = new \Illuminate\Http\Request(); の記述が必要になる。


class TodoController extends Controller
{
    public function index()
    // Section7 ~
    // ToDo一覧表示ページの処理内容。
    {
        // $todo = new Todo();
        // Section8
        // TodoControllerでTodoModelを使えるようにするために、インスタンス化。
        // データ型：オブジェクト（App\Todo）

        // $todos = $todo->all();
        // Section8
        // ここからtodosテーブルのレコードを全件取得するための実装。
        // 実務では $todos = Todo::all(); と書くのが一般的。
        // $todos = Todo::all();　クラスから直接呼び出し。
        // $todo = new Todo();　$todo->all();　インスタンスを作ってから呼び出し。
        // データ型：array

        $todos = $this->todo->all();
        // Section17
        // $this->todo の投入。メソッドの修正。

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


    public function store(TodoRequest $request)
    // Section13
    // 新規作成のルートに対応するControllerのメソッドを定義。
    // 引数に Request $request と書くことで、
    // $requestにRequestクラスのインスタンスを注入している。
    // メソッドインジェクション。
    // Laravelでは、メソッドの引数の左側にクラス名を書くことで、インスタンス化が自動で行われる。
    // $requestのデータ型：オブジェクト（Illuminate\Http\Requestモデルのインスタンス）
    {
        $inputs = $request->all();
        // Section13
        // フォームから送信されたToDoの内容を取得。
        // Section14
        // ->all()で、フォームから送信された値を連想配列の形で一括で取得。
        // データ型：array

        // $todo = new Todo(); 

        // $todo->fill($inputs);
        // Section14
        // 連想配列で取得した値を、->fill()を使用して、
        // Todoインスタンスの各プロパティに一括で代入する。

        // $todo->save();
        // Section14
        // Todoインスタンスの`->save()`を実行してオブジェクトの状態をDBに保存するINSERT文を実行。
        // 上記の流れをまとめると、 $todo -> fill($request->all()) -> save();

        $this->todo->fill($inputs);
        $this->todo->save();
        // Section17
        // $this->todo の投入。メソッドの修正。

        return redirect()->route('todo.index');
        // Section13
        // ToDoが新規作成された後に、一覧画面を表示させるためのリダイレクト定義。
        // redirect() = ブラウザに「別のURLに移動してね」と指示を出す。
        // これができると、 PHP-LESSON の時のように、「store.php」のファイルを作成する必要がない！
    }


    public function show($id)
    // Section16
    // 詳細取得のルートに対応するControllerのメソッドの定義。
    // show()メソッドの引数には、ルート定義で指定したルートパラメータを受け取ることができる。
    // 今回は$idという変数で受け取るようにする。
    {
        // $model = new Todo();
        // $todo = $model->find($id);
        // Section16
        // find()メソッドで指定のIDのデータを取得。
        // データベースのidカラムが$idの値と一致するレコードを取得。

        $todo = $this->todo->find($id);
        // Section17
        // $this->todo の投入。メソッドの修正。

        return view('todo.show', ['todo' => $todo]);
    }


        private $todo; 
    // Section17

    public function __construct(Todo $todo)
    // Section17
    // __construct() = クラスが作られるとき最初に呼ばれる特別な関数。
    // Todo クラスのインスタンスを自動で作って、$todo に代入。
    // 毎回 new Todo() する必要がなくなる。
    {
        $this->todo = $todo;
        // Section17
        // $this = TodoControllerのインスタンス。
        // $this->todo = Todoモデルのインスタンス。
        // $todoを、$this->todoにしまう。あとで他のメソッドで使えるようにしておく。
    }


    public function edit($id)
    // Section18
    // 編集対象のデータの取得
    {
        $todo = $this->todo->find($id);
        // Section18
        // 該当するidのデータを取得。

        return view('todo.edit',['todo' => $todo]);
        // Section18
        // 編集画面に表示。
    }


    public function update(TodoRequest $request, $id)
    // Section19
    // 更新リクエストの値を取得。
    {
        $inputs = $request->all();
        // Section19
        // 更新データの内容を取得。
        // データ型：array

        $todo = $this->todo->find($id);
        // Section19
        // データベースから、該当idの内容を取得。
        // データ型：オブジェクト（App\Todo）

        $todo->fill($inputs)->save();
        // Section19
        // save()メソッドでcontentの上書き。

        return redirect()->route('todo.show', $todo->id);
        // Section19
        // 詳細画面へのリダイレクト。
        // データベースの編集が終わったら、TodoControllerのshowメソッドを呼び出す。
    }


    public function delete($id)
    // Section21
    // 削除機能の実装。
    {
        $todo = $this->todo->find($id);
        // Section21
        // 該当idの内容を取得。

        $todo->delete();
        // Section21
        // 削除の実行。

        return redirect()->route('todo.index');
    }
}

?>