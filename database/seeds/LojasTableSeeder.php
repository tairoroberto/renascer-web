<?php

use Illuminate\Database\Seeder;

// composer require laracasts/testdummy
use Laracasts\TestDummy\Factory as TestDummy;

class LojasTableSeeder extends Seeder
{
    public function run()
    {
        // TestDummy::times(20)->create('App\Post');
        // Uncomment the below to wipe the table clean before populating
        DB::table('lojas')->truncate();

        $lojas = array(
            array('id' => '1','name' => 'Belém','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '2','name' => 'Boi do Povo','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '3','name' => 'Brás','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '4','name' => 'Celso Garcia','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '5','name' => 'Cocaia','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '6','name' => 'Conceição','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '7','name' => 'Limão','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '8','name' => 'Maria Marcolina','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '9','name' => 'Pari','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '10','name' => 'Novo Mundo','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '11','name' => 'Santana','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '12','name' => 'Sapopemba','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '13','name' => 'Vila Maria','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00'),
            array('id' => '14','name' => 'Tatuapé','created_at' => '2015-06-05 00:00:00','updated_at' => '2015-06-05 00:00:00')
        );

        // Uncomment the below to run the seeder
        DB::table('lojas')->insert($lojas);
    }
}
