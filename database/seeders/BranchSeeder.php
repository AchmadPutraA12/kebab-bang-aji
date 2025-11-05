<?php

namespace Database\Seeders;

use App\Models\Branch;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BranchSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Branch::create([
            'name' => 'Semolowaru',
            'address' => 'Semolowaru, Kec. Kepulauan Tanimbar, Kabupat',
        ]);

        Branch::create([
            'name' => 'Nginden',
            'address' => 'Nginden, Kec. Kepulauan Tanimbar, Kabupat',
        ]);
    }
}
