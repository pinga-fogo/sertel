<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRamalProfile extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
//        DB::statement('CREATE VIEW view_profile_ramal AS
//            SELECT A.*,
//                (SELECT GROUP_CONCAT(B.name SEPARATOR \' -> \' ) FROM ramal_settings AS B WHERE B.id IN(A.`master_id`, A.`type`, A.`subtype`)) AS settings
//                FROM profiles_ramais AS A;');
        DB::statement('CREATE VIEW view_profile_ramal AS
            SELECT A.*
                FROM profiles_ramais AS A;');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        DB::statement('DROP VIEW view_profile_ramal');
    }
}
