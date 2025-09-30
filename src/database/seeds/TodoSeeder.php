<?php

use Illuminate\Database\Seeder;
// Illuminate\Database\Seeder; = 
//  アプリケーションの初期セットアップや、テスト時に必要な初期データをデータベースに投入する。

class TodoSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('todos')->truncate();
        
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
    }
}
