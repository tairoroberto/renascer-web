<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        // Uncomment the below to wipe the table clean before populating
        DB::table('users')->truncate();

        $users = array(
            array('id' => '1','name' => 'Admin','email' => 'admin@renascercarnes.com.br','password' => '$2y$10$QXs9HglF0ATmlf9M7JTsTOMuu3oqeiVRGGcynTMewnYWeNaikgf42','password_confirmation' => '','type' => 'Administrador','loja' => '0','remember_token' => 'qrMtsdmdDqavyvwjP8gfjS8Ww1bN7ggs5gcQOe8YZaqxV8PPez8IIt9a2Qvv','created_at' => '2015-05-26 23:07:03','updated_at' => '2015-06-05 14:00:25')
        );

        // Uncomment the below to run the seeder
        DB::table('users')->insert($users);
    }
}
