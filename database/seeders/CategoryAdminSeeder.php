<?php

namespace Database\Seeders;

use App\Models\CategoryAdmin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class CategoryAdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        CategoryAdmin::create([
            'name' => 'admin'
        ]);

        CategoryAdmin::create([
            'name' => 'kasir'
        ]);
    }
}
