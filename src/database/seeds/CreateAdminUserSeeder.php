<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Models\Api;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class CreateAdminUserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'name' => 'Admin',
            'email' => 'admin@gmail.com',
            'password' => bcrypt('123456'),
            'email_verified_at' => now(),

        ]);
        $api = Api::create([
            'key' => 'key',
            'user' => '1',
        ]);

        $role = Role::create(['name' => 'Admin']);
        $role_editor = Role::create(['name' => 'Editor']);
        $role_expert = Role::create(['name' => 'Expert']);
        $role_user = Role::create(['name' => 'User']);

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user->assignRole([$role->id]);
    }
}
