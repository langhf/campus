<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //$this->call(UsersTableSeeder::class);
        //$this->call(PayInfoTableSeeder::class);
//        $this->call(WorkCheckTableSeeder::class);
        $this->call(DoorCheckTableSeeder::class);
    }
}
