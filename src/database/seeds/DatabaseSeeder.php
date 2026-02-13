<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call
        // Section5
        // callメソッドへの登録で、作成したシーダークラスの実行。
        // appコンテナ内で　php artisan db:seed　を実行して、
        // DatabaseSeeder.phpのcallメソッドを実行。

        // なぜ「TodoSeeder.php」に記載のシーダークラスを、「DatabaseSeeder.php」で呼びだすのか？
        // php artisan db:seed　のコマンドが呼び出しているのが、この「DatabaseSeeder.php」だから。
        // 大きなプロジェクトになると、シーダーファイルが複数作成されることは多々あり、
        // この「DatabaseSeeder.php」にまとめておくことで、一気に複数のシーダークラスを実行することができる。
        (
            [
            TodoSeeder::class,
            ]
        );
    }
}
