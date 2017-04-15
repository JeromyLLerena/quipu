<?php

use Illuminate\Database\Seeder;

class TransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('transaction_types')->insert([
            ['id' => 1, 'name' => 'Ingreso'],
            ['id' => 2, 'name' => 'Egreso'],
        ]);
    }
}
