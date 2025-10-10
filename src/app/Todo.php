<?php
// Section8
// appコンテナ内で
// php artisan make:model Todo
// を実行。
// データベースに登録されているデータを取得する。

namespace App;

use Illuminate\Database\Eloquent\Model;
// LaravelのEloquentとは、Laravelに含まれるデータ用操作ライブラリ。
// Laravelでのデータ操作をシンプルにするORM（Object-Relational Mapping）。
// これにより、データベースのテーブルを、PHPのオブジェクトとして扱えるようになる。


class Todo extends Model
// Section8
// TodoModelをデータベースのtodosテーブルとマッピングする。
// Modelを介することでSQL文を組み立てることなくtodosテーブルを操作することができるようになる。

// 「extends」とは？
// ”継承”の意。つまり、「class Todo extends Model」は、"Modelクラスを継承したTodoクラス"ということ。
// あくまで「Todo」の内容はユーザー定義で、Laravel定義のクラスは「Model」の方。
// これにより、TodoクラスはModelクラスのメソッドを使えるようになる。

// さらに……
// Laravelは、便利な"自動化"が特徴なので、クラス名（今回だとTodo）を元にして、『これならテーブル名はこう！』と判断して、
// 自動的にテーブル名を「todos」にしてくれる。
// テーブル名を変更したい場合は、Modelクラスメソッドの、$table　を使えばOK！

{
    protected $table = 'todos';
    // テーブル名の指定。
    // protected = クラスの中、もしくはTodoクラスを継承しているクラスの中でなら、有効となるアクセス修飾子。保守性確保！

    protected $fillable =
    // Section14
    // $fillableの定義で、代入できる項目に制限をかける。
    [
        'content',
    ];
}

?>