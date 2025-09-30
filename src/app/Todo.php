<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
// LaravelのEloquentとは、Laravelに含まれるデータ用操作ライブラリ。
// Laravelでのデータ操作をシンプルにするORM（Object-Relational Mapping）
// 使用にはconfig/database.phpを設定する必要がある。
// これにより、データベースのテーブルを、PHPのオブジェクトとして扱えるようになる。

class Todo extends Model
{
    protected $table = 'todos';

    protected $fillable =
    // $fillableの定義で、代入できる項目に制限をかける。
    [
        'content',
    ];
}

?>