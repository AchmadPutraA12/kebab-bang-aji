<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\CategoryAdmin;
use App\Models\User;

class OwnerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $ownerCategory = CategoryAdmin::firstOrCreate(
            ['name' => 'owner']
        );

        User::create([
            'name' => 'Owner',
            'username' => 'owner',
            'email' => 'owner@gmail.com',
            'category_id' => $ownerCategory->id,
            'password' => Hash::make('123'),
            'is_active' => 1,
        ]);
    }
}
