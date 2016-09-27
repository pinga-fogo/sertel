<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfileRamalTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles_ramais', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('receives_ddr')->nullable();
            $table->string('mcdu_send')->nullable();
            $table->string('collect_call')->nullable();
            $table->string('group_capture')->nullable();
            $table->string('capture_groups')->nullable();
            $table->string('internal_access')->nullable();
            $table->string('local_access')->nullable();
            $table->string('fixed_access_ddd')->nullable();
            $table->string('access_mobile_local')->nullable();
            $table->string('ddd_mobile_access')->nullable();
            $table->string('special_access')->nullable();
            $table->string('access_number_services')->nullable();
            $table->string('especial_access_rota')->nullable();
            $table->string('agenda')->nullable();
            $table->string('padlock')->nullable();
            $table->string('conference')->nullable();
            $table->string('query_sale')->nullable();
            $table->string('disable_follow_me')->nullable();
            $table->string('enable_follow_me')->nullable();
            $table->string('do_not_disturb')->nullable();
            $table->string('last_call_external')->nullable();
            $table->string('last_internal_call')->nullable();
            $table->string('last_external_number_received')->nullable();
            $table->string('last_received_number_internal')->nullable();
            $table->string('access_to_voice_mail')->nullable();
            $table->string('ramal_talks')->nullable();
            $table->string('server_information')->nullable();
            $table->string('intercalation')->nullable();
            $table->string('monitoring_spy')->nullable();
            $table->string('login_queue')->nullable();
            $table->string('logout_queue')->nullable();
            $table->string('pause_queue')->nullable();
            $table->string('exit_pause_queue')->nullable();
            $table->string('default')->nullable();
            $table->integer('status')->nullable();
            $table->timestamps();

        });

        Schema::table('ramais', function($table){
            $table->integer('profile_ramal_id')->unsigned()->nullable();
            $table->foreign('profile_ramal_id')->references('id')->on('profiles_ramais');
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement("SET foreign_key_checks=0");
        Schema::drop('profiles_ramais');
        DB::statement("SET foreign_key_checks=1");
    }
}
