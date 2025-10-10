# Laravel-Lessonの振り返り


## 今回、Dockerのコンテナ内で、「artisan」を実行して作成したファイルは4つ。
### XXX_create_todos_table.php
### TodoSeeder.php
### Todo.php
### TodoController.php
## なぜこの4つだけDocker内コマンドが必要だったのか？

artisanコマンドで作成したファイルと、手動で作成したファイルは使い所が違うから。

artisanコマンドは、Laravelの「決まりに沿ったコードを自動で作る」ことができる。
つまり、artisanコマンドで作ると、ミスが少ないし、チームでも一貫性が保てる！

逆にartisanで作らなかったものは、自由に作ってOKなファイル。
index.phpや、create.phpなど、表示用のファイルは手動作成！


## Section15までに登場するall()メソッドは2つ。
### Todo::all()
### $request->all()
## なぜこの2つは返り値が違う？

all()メソッドは、使用するモデルやクラスによって、返り値が全く違う。
PHPでは、メソッド名が同じでもクラスが違えば別物。
（ = それぞれのクラスで定義されている。）
Laravelはこれを活かして、各クラスで直感的な命名（all()、get()、save()など）をしているだけ。

↓ 例　↓

● Request (Illuminate\Http\Request)
リクエストに含まれる全データを取得。
返り値 = 配列（array）

● Model (Illuminate\Database\Eloquent\Model)
DBから全レコードを取得。
返り値 = Eloquent Collection

● Collection (Illuminate\Support\Collection)
コレクションの全要素を取得（実際はall()は配列返すだけ）。
返り値 = 配列（array）

● Validator (Illuminate\Validation\Validator)
バリデーション後の全入力データを取得。
返り値 = 配列（array）


## TodoController.php で登場する
### return redirect()->route('todo.index');
## について。
## return redirect() はインスタンスではないのに、なぜアロー演算子が使える？

redirect() はLaravelのグローバル関数 で、Redirectorのインスタンス を返すから。

ちなみに……
route() も単体だとグローバル関数に分類される。
ただし redirect()->route() の route() は、Redirector オブジェクトの route() メソッド に分類される。


## Section17では、新たなクラス内関数として、以下の定義が登場した。
### public function __construct(Todo $todo)
### {
###   $this->todo = $todo;
### }
## これは、この後に続く関数内でも度々使用される。
## なぜ一つの関数内で定義したものが、他の関数内でも使用できるのか？

まず大前提として、「関数の中の変数」と「クラスの中の変数」は違う！

ひとつひとつ整理すると……
$todo は「ただの変数」。関数の中でだけ使える。
$this は、「今動いてる"クラス"のインスタンス自身」を指す特別なキーワード。
つまり、 $this->todo と表記することで、クラス全体で使える「クラスのプロパティ」になる。
そこで、
$this->todo = $todo
と代入定義を行うと、その後に続く関数でも、 $this->todo が共通設定で使用できるようになる。

要は、「『$this->』のついてるものは特別に、クラス内どこでも使えますよ！」ということ。




# 番外編！オブジェクトについてのあれこれ！


## よく 
## $** = new ** 
## という、
## 「"インスタンス化した物"を"変数"に代入する」
## という記述を見るけど、わざわざ変数に代入するのはなぜ？

変数に代入すると、状態を持ち続けるオブジェクトになるから！

例　）
$user = new User();
$user->name = "Taro";
echo $user->name;

出力結果："Taro"

　↑ これは状態を保持している。この後 $user を何度でも使って、$user->name を参照できる。

(new User())->name = "Taro";
echo (new User())->name;

出力結果：NULL

　↑ これは、Userクラスのインスタンスを一時的に作って、name プロパティに "Taro" を代入してるけど、
　　それ以降にそのオブジェクトを参照する術（すべ）がない。