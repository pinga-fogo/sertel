<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRamaisTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramais', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('master_id')->nullable();
            $table->integer('tec')->nullable();
            $table->integer('app')->nullable();
            $table->string('ddr')->nullable();
            $table->string('number')->nullable();
            $table->string('name')->nullable();
            $table->string('password')->nullable();
//            $table->integer('profile_ramal_id')->nullable();
            $table->integer('capture')->nullable();
            $table->integer('parking_calls')->nullable();
            $table->integer('deviation')->nullable();
            $table->integer('detour')->nullable();
            $table->integer('padlock')->nullable();
            $table->integer('notdisturb')->nullable();
            $table->integer('conference')->nullable();
            $table->integer('accountcode')->nullable();
            $table->integer('centercost')->nullable();
            $table->integer('intercomaccess')->nullable();
            $table->integer('status');
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
        Schema::drop('ramais');
    }
}
