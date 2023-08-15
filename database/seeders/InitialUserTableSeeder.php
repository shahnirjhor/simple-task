<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\User;
use Spatie\Permission\Models\Role;

class InitialUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Super Admin',
            'email' => 'rakibhossaincse@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '01670984145',
            'address' => 'Dhaka, BD',
            'status' => '1',
        ]);
        $superAdminRole = Role::where('name', 'Super Admin')->first();
        $superAdmin->assignRole([$superAdminRole->id]);

        $premium = User::create([
            'name' => 'Premium User',
            'email' => 'premium@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '01676643764',
            'address' => 'Dhaka, BD',
            'status' => '1',
        ]);
        $premiumRole = Role::where('name', 'Premium')->first();
        $premium->assignRole([$premiumRole->id]);

        $free = User::create([
            'name' => 'Free User',
            'email' => 'free@gmail.com',
            'password' => bcrypt('12345678'),
            'phone' => '01718185179',
            'address' => 'Dhaka, BD',
            'status' => '1',
        ]);
        $freeRole = Role::where('name', 'Free')->first();
        $free->assignRole([$freeRole->id]);
    }
}
