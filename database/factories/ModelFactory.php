<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'name' => $faker->unique()->name,
        'user_id' => $faker->unique()->ean8,
        'tel' => $faker->unique()->phoneNumber,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\pay_info::class,function(Faker\Generator $faker){
    $num = random_int(8,15);
   return [
       'user_id' => factory(App\User::class)->create()->user_id,
       'pay_date' => $faker->date(),
       'pay_time' => $faker->time(),
       'origin_price' => $num,
       'discounted_price' => 0.8*$num,
       'off' => 0.2*$num
   ];
});

$factory->define(App\work_check::class,function (Faker\Generator $faker){

    $start_time = $faker->time();
    $end_time = $faker->time();
    $total_time = strtotime($end_time)-strtotime($start_time);
    $total_time = $total_time/(60*60);

    return [
      'user_id' => factory(App\User::class)->create()->user_id,

      'record_date' => $faker->date(),
      'start_time' => $start_time,
      'end_time' => $end_time,
      'total_time' => $total_time,
    ];
});

$factory->define(App\door_checks::class,function(Faker\Generator $faker){

    return [
//      'user_id' => function(){
//          return factory(App\User::class)->create()->user_id;
//      },
      'user_id' => factory(App\User::class)->create()->user_id,
      'check_time' => $faker->dateTime(),
      'door_number' => random_int(1,10),
    ];
});