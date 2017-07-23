<?php

use Illuminate\Database\Seeder;

class WorkCheckTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\work_check::class,10000)->create();
    }
}
