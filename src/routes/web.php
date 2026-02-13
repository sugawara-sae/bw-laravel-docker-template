<?php

// Section6
// PHP Appレッスンでは、直前のURLごとに実行する処理を変更する関数を定義していた。
// 一方でLaravelでは、URIとHTTPメソッドの組み合わせで実行する処理を変更することができる。
// URIとHTTPメソッドの組み合わせで実行する処理を指定することをルート定義と呼ぶ。

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/',function(){
  return view('welcome');
});
// 保守性の観点から、実行したい処理はTodoController.phpにまとめる。
// Controllerに処理を移すには、
// Route::get() の第二引数に対象のControllerとそのメソッドを指定する必要がある。


Route::get('/todo', 'TodoController@index')->name('todo.index');
// Section7
// 実行したい処理をTodoController.phpに移す。
// 『'URL = /todo'に、'getアクセス'が来たら、'TodoController.php内'の'indexメソッド'を実行。』
// Section13
// ToDoが新規作成された後に、一覧画面を表示させるため、リダイレクトの処理をする。
// （ = ルート名の追記）

Route::get('/todo/create', 'TodoController@create')->name('todo.create');
// Section11
// 「ToDoを追加」のボタンを押した時にリクエストするルートを定義。
// Section12
// ->name で、ルートに名前をつける

Route::post('/todo', 'TodoController@store')->name('todo.store');
// Section13
// 新規作成するためのルート設定。HTTPはpost。

Route::get('/todo/{id}', 'TodoController@show')->name('todo.show');
// Section16
// 詳細画面への遷移ボタンをクリックした際にリクエストするルートを定義。
// /{id} = ルートパラメータ。URIに含める一意の値。{}で変数ということを示す。
// {id} は index.blade.php から受け取って、TodoController.phpのshowメソッドに渡す。

Route::get('/todo/{id}/edit', 'TodoController@edit')->name('todo.edit');
// Section18
// 詳細画面から編集画面へのルート定義。
// 詳細画面と更新画面で画面を分けるため、編集画面のルートの最後には /edit を追加。

Route::put('/todo/{id}', 'TodoController@update')->name('todo.update');
// Section19
// 編集画面から更新の操作。

Route::delete('/todo/{id}', 'TodoController@delete')->name('todo.delete');
// Section21
// 削除機能の実装。