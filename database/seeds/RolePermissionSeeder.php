<?php
use App\User;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolePermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::create(['name'=>'list']);
        Permission::create(['name'=>'view detail']);
        Permission::create(['name'=>'modify']);
        Permission::create(['name'=>'delete']);
        Permission::create(['name'=>'add']);

        //create role and assigned permssion
        $role_admin = Role::create(['name'=>'administrator'])->givePermissionTo([
            'list',
            'view detail',
            'modify',
            'delete',
            'add'
        ]);

        $role_user = Role::create(['name'=>'regular user'])->givePermissionTo([
            'list',
            'add',
            'view detail',
        ]);

        // buat user dan assigne role
        $admin = User::create([
            'name'=>'Admin',
            'email'=>'admin@aic.com',
            'password'=>bcrypt('12345678')
        ]);
        $admin->assignRole($role_admin);

        $user = User::create([
            'name'=>'User',
            'email'=>'user@aic.com',
            'password'=>bcrypt('12345678')
        ]);
        $user->assignRole($role_user);
    }
}
