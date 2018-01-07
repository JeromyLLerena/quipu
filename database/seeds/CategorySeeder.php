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
            ['name' => 'Regalo', 'transaction_type_id' => 1],
            ['name' => 'Alquiler', 'transaction_type_id' => 2],
            ['name' => 'Regalo', 'transaction_type_id' => 2],
            ['name' => 'Servicios', 'transaction_type_id' => 2],
            ['name' => 'Alimentos', 'transaction_type_id' => 2],
            ['name' => 'Transporte', 'transaction_type_id' => 2],
            ['name' => 'Ropa', 'transaction_type_id' => 2],
            ['name' => 'Electrónica', 'transaction_type_id' => 2],
            ['name' => 'Herramientas', 'transaction_type_id' => 2],
            ['name' => 'Insumos de limpieza', 'transaction_type_id' => 2],
            ['name' => 'Muebles', 'transaction_type_id' => 2],
        ]);
    }
}
