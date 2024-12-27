<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\RoleAndPermissionSeeder; // Pastikan ini sudah diimpor dengan benar
use Database\Seeders\CategorySeeder;
use Database\Seeders\TaskSeeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            CategorySeeder::class,
            TaskSeeder::class,
            RoleAndPermissionSeeder::class, // Pastikan ini dipanggil
        ]);
    }
}
