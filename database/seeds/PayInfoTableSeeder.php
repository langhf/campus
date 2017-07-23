<?php

use Illuminate\Database\Seeder;

class PayInfoTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\pay_info::class,10000)->create();
    }
}
