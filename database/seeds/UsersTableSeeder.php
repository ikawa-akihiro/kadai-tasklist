<?php

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // テストデータ3件登録
        $data_heroku = [
            ['name' => 'Akihiro Ikawa', 'email' => 'ikawa12345@gmail.com', 'password' => 'pauelu123'], 
            ['name' => 'テストユーザ', 'email' => 'testuser@gmail.com', 'password' => 'testuser123'], 
            ['name' => '井川尭洋', 'email' => 'aabbcc@gmail.com', 'password' => 'faewgoawe234'], 
        ];
        
        $data = [
            ['name' => 'テスト1', 'email' => 'test1@gmail.com', 'password' => 'test11111'], 
            ['name' => 'テスト2', 'email' => 'test2@gmail.com', 'password' => 'test22222'], 
            ['name' => 'テスト3', 'email' => 'test3@gmail.com', 'password' => 'test33333'], 
        ];
        
        foreach($data_heroku as $user){
            DB::table('users')->insert([
                    'name' => $user['name'], 
                    'email' => $user['email'],
                    'password' => $user['password']
            ]);
        }
    }
}
