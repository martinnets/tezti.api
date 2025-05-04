<?php

namespace Database\Seeders;

use App\Models\Classification;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ClassificationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Classification::insert([
            [
                'code' => '1',
                'name' => 'Bajo',
                'from' => 0,
                'to' => 24
            ],
            [
                'code' => '2',
                'name' => 'Medio',
                'from' => 25,
                'to' => 74
            ],
            [
                'code' => '3',
                'name' => 'Alto',
                'from' => 75,
                'to' => 100
            ],
        ]);
    }
}
