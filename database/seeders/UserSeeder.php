<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $superAdmin = User::create([
            'name' => 'Admin',
            'username' => 'admin',
            'email' => 'admin@gmail.com',
            'category_id' => 1,
            'password' => Hash::make('123'),
            'is_active' => 1,
        ]);

        $kasir = User::create([
            'name' => 'Kasir1',
            'username' => 'kasir1',
            'email' => 'kasir1@gmail.com',
            'category_id' => 2,
            'branch_id' => 1,
            'password' => Hash::make('123'),
            'is_active' => 1,
        ]);

        $kasir = User::create([
            'name' => 'Kasir2',
            'username' => 'kasir2',
            'email' => 'kasir2@gmail.com',
            'category_id' => 2,
            'password' => Hash::make('123'),
            'is_active' => 1,
        ]);
    }
}
