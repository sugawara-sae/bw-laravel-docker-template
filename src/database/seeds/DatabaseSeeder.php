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
        // appコンテナ内で
        // php artisan db:seed
        // を実行して、DatabaseSeeder.phpのcallメソッドを実行。
        (
            [
            TodoSeeder::class,
            ]
        );
    }
}
