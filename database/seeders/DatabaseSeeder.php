<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {

        $this->call([
            OrganizationSeeder::class,
            UserSeeder::class,
            AdditionalSeeder::class,
            HierarchicalLevelSeeder::class,
            PositionSeeder::class,
            SkillSeeder::class,
            BehaviorSeeder::class,
            ClassificationSeeder::class,
            FeedbackSeeder::class,
            RecommendationSeeder::class,
            ComplementaryBehaviorSeeder::class
        ]);
    }
}
