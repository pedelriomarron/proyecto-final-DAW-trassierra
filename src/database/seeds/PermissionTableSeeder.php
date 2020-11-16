<?php

use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;


class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $permissions = [
            'role-list',
            'role-create',
            'role-edit',
            'role-delete',

            'user-list',
            'user-create',
            'user-edit',
            'user-delete',

            'brand-list',
            'brand-create',
            'brand-edit',
            'brand-delete',

            'segment-list',
            'segment-create',
            'segment-edit',
            'segment-delete',

            'drive-list',
            'drive-create',
            'drive-edit',
            'drive-delete',

            'bodystyle-list',
            'bodystyle-create',
            'bodystyle-edit',
            'bodystyle-delete',

            'car-list',
            'car-create',
            'car-edit',
            'car-delete',
        ];

        foreach ($permissions as $permission) {
            Permission::create(['name' => $permission]);
        }
    }
}
