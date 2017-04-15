<?php

use Illuminate\Database\Seeder;

class CategorySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('categories')->insert([
            ['name' => 'Sueldo trabajo', 'transaction_type_id' => 1],
            ['name' => 'Freelance', 'transaction_type_id' => 1],
            ['name' => 'Propina', 'transaction_type_id' => 1],
            ['name' => 'Compra', 'transaction_type_id' => 2],
            ['name' => 'Alquiler', 'transaction_type_id' => 2],
            ['name' => 'Regalo', 'transaction_type_id' => 2],
            ['name' => 'Servicios', 'transaction_type_id' => 2],
        ]);
    }
}
