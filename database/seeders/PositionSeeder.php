<?php

namespace Database\Seeders;

use App\Models\Position;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class PositionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Position::insert([
            [
                'hierarchical_level_id' => 1,
                'name' => 'Repartidor - Nivel 1',
                'from' => '2024-01-01',
                'to' => '2024-02-01',
                'status' => 1,
                'user_id' => 1,
                'organization_id' => null,
            ],
            [
                'hierarchical_level_id' => 2,
                'name' => 'Secretaria - Nivel 2',
                'from' => '2024-02-15',
                'to' => '2024-03-15',
                'status' => 0,
                'user_id' => 1,
                'organization_id' => null,
            ],
            [
                'hierarchical_level_id' => 1,
                'name' => 'Analista de costos - Nivel 3',
                'from' => '2024-03-01',
                'to' => '2024-04-01',
                'status' => -1,
                'user_id' => 2,
                'organization_id' => 1,
            ],
            [
                'hierarchical_level_id' => 1,
                'name' => 'Gerente de planta - Nivel 4',
                'from' => '2024-04-10',
                'to' => '2024-05-10',
                'status' => 1,
                'user_id' => 2,
                'organization_id' => 1,
            ],
        ]);
    }
}
