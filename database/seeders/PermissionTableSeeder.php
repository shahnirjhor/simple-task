<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Permission::firstOrCreate([
            'name' => 'role-read',
            'display_name' => 'Role',
        ]);
        Permission::firstOrCreate([
            'name' => 'role-create',
            'display_name' => 'Role',
        ]);
        Permission::firstOrCreate([
            'name' => 'role-update',
            'display_name' => 'Role',
        ]);
        Permission::firstOrCreate([
            'name' => 'role-delete',
            'display_name' => 'Role',
        ]);

        Permission::firstOrCreate([
            'name' => 'user-read',
            'display_name' => 'User',
        ]);
        Permission::firstOrCreate([
            'name' => 'user-create',
            'display_name' => 'User',
        ]);
        Permission::firstOrCreate([
            'name' => 'user-update',
            'display_name' => 'User',
        ]);
        Permission::firstOrCreate([
            'name' => 'user-delete',
            'display_name' => 'User',
        ]);

        Permission::firstOrCreate([
            'name' => 'post-read',
            'display_name' => 'Post',
        ]);
        Permission::firstOrCreate([
            'name' => 'post-create',
            'display_name' => 'Post',
        ]);
        Permission::firstOrCreate([
            'name' => 'post-update',
            'display_name' => 'Post',
        ]);
        Permission::firstOrCreate([
            'name' => 'post-delete',
            'display_name' => 'Post',
        ]);
    }
}
