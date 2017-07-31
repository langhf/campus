<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePayInfosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pay_infos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('user_id');
            $table->date('pay_date');
            $table->time('pay_time');
            $table->float('origin_price');
            $table->float('discounted_price');
            $table->float('off');
            $table->string('shop');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pay_infos');
    }
}
