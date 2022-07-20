<?php

use Illuminate\Database\Seeder;
use App\User;

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
        
        // 全ユーザ取得
        $users = User::all();
        // テストデータ100件登録
        foreach($users as $user){
            for($i = 1; $i <= 100; $i++){
                // 「未着手」「着手中」「完了」のうち一つをランダムで取得
                $rand_status = rand(0, $count_status-1);
                DB::table('tasks')->insert([
                    'user_id' => $user->id, 
                    'status' => $status[$rand_status],
                    'content' => 'テストデータ ' . $i
                ]);
            }
        }
    }
}
