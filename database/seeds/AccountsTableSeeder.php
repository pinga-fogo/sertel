<?php
use App\User;
use App\Profile;
use Illuminate\Database\Seeder;

class AccountsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::statement("SET foreign_key_checks=0");
        User::truncate();
        Profile::truncate();
        DB::statement("SET foreign_key_checks=1");

        factory(App\Group::class, 5)->create(['status'=>1]);

        factory('App\User', 1)->create([
            'name' => 'Administrador',
            'email' => 'admin@sertel-info.com.br',
            'password' => bcrypt('123456'),
            'group_id' => 1,
            'role' => 'admin',
            'status' => 1]);

        factory('App\Profile', 1)->create([
                'user_id' => 1,
                'lastname' => ''
            ]);

        factory(App\User::class, 50)->create()->each(function($u) {
            $u->profile()->save(factory(App\Profile::class)->make());
        });

    }
}
