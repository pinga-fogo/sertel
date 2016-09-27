<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewUsers extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
         DB::statement('CREATE VIEW view_users AS
            SELECT A.id, A.name, B.lastname, A.email
            FROM users AS A
            LEFT JOIN profiles AS B ON(A.id=B.user_id);');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW view_users');
    }
}
