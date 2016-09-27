<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRamalSettings extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ramal_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->unsigned();
            $table->string('name');
            $table->string('class');
            $table->integer('sequence');
            $table->string('form_key');
            $table->integer('status');
            $table->timestamps();
        });

        Schema::table('ramal_settings', function($table){
            $table->foreign('parent_id')->references('id')->on('ramal_settings');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP TABLE ramal_settings');
    }
}
