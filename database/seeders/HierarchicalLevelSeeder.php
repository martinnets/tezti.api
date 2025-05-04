<?php

namespace Database\Seeders;

use App\Models\HierarchicalLevel;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class HierarchicalLevelSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        HierarchicalLevel::insert([
            [
                'name' => 'Operativo - Atención al Cliente',
                'level' => 1,
            ],
            [
                'name' => 'Operativo - Administrativo',
                'level' => 2,
            ],
            [
                'name' => 'Táctico',
                'level' => 3,
            ],
            [
                'name' => 'Estratégico',
                'level' => 4,
            ],
        ]);
    }
}
