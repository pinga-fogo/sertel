<?php

use Illuminate\Database\Seeder;

class UsersRolesPermissionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = factory(\App\Models\User::class)->create([
            'name' => 'André',
            'email' => 'admin@sertel-info.com.br',
            'password' => bcrypt(123456)
        ]);

        $profile = factory(\App\Models\Profile::class)->create([
            'user_id' => $user->id,
            'lastname' => ''
        ]);

        $roleAdmin = factory(\App\Models\Role::class)->create([
            'name' => 'Admin',
            'description' => 'System Administrator'
        ]);

        $user->addRole($roleAdmin);

        $user = factory(\App\Models\User::class)->create([
            'name' => 'sr.Admin',
            'email' => 'admin@admin.com',
            'password' => bcrypt(123456)
        ]);

        $profile = factory(\App\Models\Profile::class)->create([
            'user_id' => $user->id,
        ]);

        $user->addRole($roleAdmin);

        $userManager = factory(\App\Models\User::class)->create([
            'name' => 'sr.Manager',
            'email' => 'manager@admin.com',
            'password' => bcrypt(123456)
        ]);

        $profile = factory(\App\Models\Profile::class)->create([
            'user_id' => $userManager->id,
        ]);


        $roleManager = factory(\App\Models\Role::class)->create([
            'name' => 'Manager',
            'description' => 'System Manager'
        ]);

        $userManager->addRole($roleManager);

        $userSupervisor = factory(\App\Models\User::class)->create([
            'name' => 'sr.Supervisor',
            'email' => 'supervisor@admin.com',
            'password' => bcrypt(123456)
        ]);

        $profile = factory(\App\Models\Profile::class)->create([
            'user_id' => $userSupervisor->id,
        ]);

        $roleSupervisor = factory(\App\Models\Role::class)->create([
            'name' => 'Supervisor',
            'description' => 'System Supervisor'
        ]);

        $userSupervisor->addRole($roleSupervisor);


        $userList = factory(\App\Models\Permission::class)->create([
            'name'=>'user_list',
            'description' => 'Can list all users'
        ]);

        $userAdd = factory(\App\Models\Permission::class)->create([
            'name'=>'user_add',
            'description' => 'Can add users'
        ]);

        $userEdit = factory(\App\Models\Permission::class)->create([
            'name'=>'user_edit',
            'description' => 'Can edit users'
        ]);

        $userDestroy = factory(\App\Models\Permission::class)->create([
            'name'=>'user_destroy',
            'description' => 'Can destroy an user'
        ]);

        $userViewRoles = factory(\App\Models\Permission::class)->create([
            'name'=>'user_view_roles',
            'description' => 'Can view the users roles'
        ]);

        $userAddRole = factory(\App\Models\Permission::class)->create([
            'name'=>'user_add_role',
            'description' => 'Can add a new role for an user'
        ]);

        $userRevokeRole = factory(\App\Models\Permission::class)->create([
            'name'=>'user_revoke_role',
            'description' => 'Can revoke a role for an user'
        ]);

        $managePermissions = factory(\App\Models\Permission::class)->create([
            'name'=>'permission_admin',
            'description' => 'Can admin all permissions'
        ]);

        $AdminRoles = factory(\App\Models\Permission::class)->create([
            'name'=>'role_admin',
            'description' => 'Can admin all roles'
        ]);

        $roleManager->addPermission($userList);
        $roleManager->addPermission($userEdit);
        $roleManager->addPermission($userAdd);
        $roleManager->addPermission($userViewRoles);

        $roleSupervisor->addPermission($userList);
        $roleSupervisor->addPermission($userViewRoles);
    }
}
