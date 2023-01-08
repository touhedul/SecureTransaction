<?php

use App\Models\Notification;
use App\Models\User;
use Database\Seeders\SettingSeeder;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(AdminSeeder::class);
        // $this->call(UserSeeder::class);
        // $this->call(RolePermissionSeeder::class);
        $this->call(SettingSeeder::class);

        // User::factory()->count(20)->create();
        // Notification::factory()->count(20)->create();

    }
}
