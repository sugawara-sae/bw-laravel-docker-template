<?php
// Section5
// シーダーによるテストデータの導入。
// appコンテナ内で
// php artisan make:seeder TodoSeeder
// を実行してシーダーファイルを作成。


use Illuminate\Database\Seeder;
// Illuminate\Database\Seeder; = 
// アプリケーションの初期セットアップや、テスト時に必要な初期データをデータベースに投入する。

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    // Section5
    // テストデータの投入。連想配列の形で用意。
    {
        DB::table('todos')->truncate();
        // Section5
        // truncate() = 該当のテーブルのレコードをすべて削除するTRUNCATE文を実行。
        // シーダーの実行により、開発者間のテストデータに差異が生じないようにするため、
        // 元々テーブルに存在していたデータを削除後、テストデータを投入する。
        
        $testData =
        [
            [
                'content' => 'PHP Appセクションを終える',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'content' => 'Laravel Lessonを終える',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('todos')->insert($testData);
        // Section5
        // 用意したテストデータをtodosテーブルに投入。
        // DB::table('todos') = tableメソッドの引数のテーブルを操作するための準備。
        // insert() = 引数のデータをテーブルに投入するINSERT文を実行。
    }
}
