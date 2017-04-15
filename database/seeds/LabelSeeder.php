<?php

use Illuminate\Database\Seeder;

class LabelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('labels')->insert([
            ['name' => 'habitación'],
            ['name' => 'limpieza'],
            ['name' => 'pasaje'],
            ['name' => 'limpieza'],
            ['name' => 'comida'],
            ['name' => 'ropa'],
            ['name' => 'útiles'],
            ['name' => 'bebé'],
        ]);
    }
}
