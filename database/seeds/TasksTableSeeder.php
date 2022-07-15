<?php

use Illuminate\Database\Seeder;

class TasksTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // statusの配列
        $status = ['未着手', '着手中', '完了'];
        $count_status = count($status);
        // テストデータ100件登録
        for($i = 1; $i <= 100; $i++){
            // 「未着手」「着手中」「完了」のうち一つをランダムで取得
            $rand_status = rand(0, $count_status-1);
            DB::table('tasks')->insert([
                'status' => $status[$rand_status],
                'content' => 'テストデータ ' . $i
            ]);
        }
    }
}
