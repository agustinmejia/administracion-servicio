<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{

    /**
     * Auto generated seed file
     *
     * @return void
     */
    public function run()
    {
        

        \DB::table('users')->delete();
        
        \DB::table('users')->insert(array (
            0 => 
            array (
                'id' => 1,
                'role_id' => 1,
                'name' => 'Admin',
                'email' => 'admin@admin.com',
                'avatar' => 'users/default.png',
                'email_verified_at' => NULL,
                'password' => '$2y$10$/e/dkemOgWmqeTL6/wPl4uLt7tSVo06b3U1D0Fu84vLMnQZt.MZOO',
                'remember_token' => NULL,
                'settings' => NULL,
                'created_at' => '2021-04-14 11:22:58',
                'updated_at' => '2021-04-14 11:22:58',
            ),
        ));
        
        
    }
}