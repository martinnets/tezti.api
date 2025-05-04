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
        User::factory()->create([
            'name' => 'Administrador Usuario',
            'email' => 'admin@tezti.pe',
            'password' => Hash::make('P455w0rd.2024'),
            'role' => 'U',
            'organization_id' => 1
        ]);
        User::factory()->create([
            'name' => 'Administrador Cliente',
            'email' => 'admin@tezti.com',
            'password' => Hash::make('P455w0rd.2024'),
            'role' => 'C',
            'organization_id' => 1
        ]);
        User::factory()->create([
            'name' => 'Super Administrador',
            'email' => 'admin@tezti.com.pe',
            'password' => Hash::make('P455w0rd.2024'),
            'role' => 'S',
            'organization_id' => 1
        ]);       
        
    }
}
