<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        for ($i = 0; $i < 20; $i++) {
            User::factory()->create([
                'lastname' => 'Fake',
                'password' => Hash::make('P455w0rd.2024'),
                'role' => 'U',
                'document_type' => 'DNI',
                'document_number' => rand(11111111, 99999999),
                'phone' => rand(11111111, 99999999),
                'remember_token' => '-'
            ]);
        }
    }
}
