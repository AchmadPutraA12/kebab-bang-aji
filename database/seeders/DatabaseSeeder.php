<?php

namespace Database\Seeders;

use App\Models\Branch;
use App\Models\CategoryAdmin;
use App\Models\User;
// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            CategoryAdminSeeder::class,
            BranchSeeder::class,
            UserSeeder::class,
        ]);
    }
}
