<?php

namespace Database\Seeders;

use App\Models\Setting;
use Illuminate\Database\Seeder;

class SettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // General Settings
        Setting::updateOrCreate(['name' => 'site_title', 'value' => 'Site Name']);
        Setting::updateOrCreate(['name' => 'site_description', 'value' => 'Demo Description']);
        Setting::updateOrCreate(['name' => 'site_logo', 'value' => '']);
        Setting::updateOrCreate(['name' => 'site_favicon', 'value' => '']);
        Setting::updateOrCreate(['name' => 'admin_logo', 'value' => '']);
        Setting::updateOrCreate(['name' => 'admin_header_color', 'value' => 'bg-asteroid header-text-light']);
        Setting::updateOrCreate(['name' => 'admin_sidebar_color', 'value' => 'bg-asteroid sidebar-text-light']);

    }
}
