<!-- Section6
PHP Appレッスンでは、直前のURIごとに実行する処理を変更する関数を定義していた。
一方でLaravelでは、URIとHTTPメソッドの組み合わせで実行する処理を変更することができる。
URIとHTTPメソッドの組み合わせで実行する処理を指定することをルート定義と呼ぶ。 -->

<?php

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
// /{id} = ルートパラメータ。URLに含める一意の値。