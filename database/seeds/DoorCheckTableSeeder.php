<?php

use Illuminate\Database\Seeder;

class DoorCheckTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        factory(App\door_checks::class,1)->create();
    }
}
