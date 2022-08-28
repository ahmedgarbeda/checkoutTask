<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CustomerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('customers')->insert([
            'email'=>'arizk876@gmail.com',
            'first_name' => 'ahmed',
            'last_name' => 'rizk',
            'store_credit' => 100
        ]);
    }
}
