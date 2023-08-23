<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $role = Role::create([
            'name' => 'Super Admin',
            'guard_name' => 'web',
            'is_default' => '1',
            'role_for' => '0',
            'daily_post_limits' => '0',
        ]);
        $permissions = Permission::select('id')
            ->get()->pluck('id');
        $role->syncPermissions($permissions);

        $premium = Role::create([
            'name' => 'Premium',
            'guard_name' => 'web',
            'role_for' => '1',
            'daily_post_limits' => '0',
            'is_default' => '1',
        ]);
        $premiumPermissions = Permission::select('id')
            ->get()->pluck('id');
        $premium->syncPermissions($premiumPermissions);

        $free = Role::create([
            'name' => 'Free',
            'guard_name' => 'web',
            'role_for' => '1',
            'daily_post_limits' => '2',
            'is_default' => '1',
        ]);
        $freePermissions = Permission::select('id')
            ->get()->pluck('id');
        $free->syncPermissions($freePermissions);
    }
}
