<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ApplicationSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        \App\Models\ApplicationSetting::create([
            'item_name' => 'Simple Task',
            'item_short_name' => 'STask',
            'item_version' => '1.0',
            'company_name' => 'codeshaper',
            'company_email' => 'info@codeshaper.net',
            'company_address' => 'Dhaka, Bangladesh',
            'developed_by' => 'codeshaper',
            'developed_by_href' => 'https://codeshaper.net/',
            'developed_by_title' => 'Your hope our goal',
            'developed_by_prefix' => 'Developed by',
            'support_email' => 'info@codeshaper.net',
            'language' => 'en',
            'is_demo' => '0',
            'time_zone' => 'Asia/Dhaka',
        ]);
    }
}
