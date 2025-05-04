<?php

namespace Database\Seeders;

use App\Models\HierarchicalLevel;
use App\Models\Position;
use App\Models\PositionSkill;
use App\Models\PositionUser;
use App\Models\PositionUserBehavior;
use App\Models\PositionUserSkillResult;
use App\Models\Skill;
use App\Models\SkillBehavior;
use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class CompleteEvaluationFakeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = ['fit', 'potential'];
        $type = $types[rand(0, 1)];
        //Creating fake position
        $position = Position::create([
            'name' => 'Posición Fake ' . now()->format('d/m/Y') . ' ' . Str::random(5),
            'type' => $type,
            'from' => now(),
            'to' => now()->addMonth(),
            'status' => 1,
            'hierarchical_level_id' => ($type == 'fit' ? rand(1, 2) : 1),
            'created_at' => now(),
            'updated_at' => now()
        ]);

        //Generating random skill weights for the position
        $weights = [
            [100],
            [50, 50],
            [40, 60],
            [30, 70],
            [20, 80],
            [10, 90],
            [20, 30, 50],
            [10, 40, 50],
            [30, 30, 40],
            [33, 33, 34],
            [25, 25, 25, 25],
            [20, 20, 30, 30],
            [10, 10, 40, 40],
            [10, 10, 30, 50],
            [20, 20, 20, 20, 20],
            [10, 10, 20, 20, 40],
            [10, 10, 10, 30, 40],
            [10, 10, 10, 20, 50],
            [10, 10, 10, 10, 60]
        ];

        //Selecting a random case
        $case = rand(0, count($weights) - 1);

        //Getting random skills based on the case selected
        $skills = Skill::inRandomOrder()->limit(count($weights[$case]))->get();

        //Creating position skills with weights
        foreach ($skills as $key => $skill) {
            PositionSkill::create([
                'position_id' => $position->id,
                'skill_id' => $skill->id,
                'percentage' => $weights[$case][$key]
            ]);
        }

        $skill_weights = PositionSkill::where('position_id', $position->id)->pluck('percentage', 'skill_id');

        //Generating 20 fake users
        $users = User::factory()->count(30)->create([
            'lastname' => 'Fake',
            'password' => Hash::make('P455w0rd.2024'),
            'role' => 'U',
            'document_type' => 'DNI',
            'document_number' => rand(11111111, 99999999),
            'phone' => rand(11111111, 99999999),
            'remember_token' => '-'
        ]);

        //Getting hierarchical level
        $hierarchical_level = HierarchicalLevel::find($position->hierarchical_level_id);

        //Getting behaviors for the skills
        $behaviors = SkillBehavior::with(['behavior'])
            ->whereHas('behavior', function ($query) use ($position, $hierarchical_level) {
                $query->where('level', ($position->type == 'fit') ? $hierarchical_level->level : $hierarchical_level->level + 1);
            })
            ->whereIn('skill_id', $skills->pluck('id'))->pluck('skill_id', 'behavior_id');


        foreach ($users as $user) {
            $position_user = PositionUser::create([
                'position_id' => $position->id,
                'user_id' => $user->id,
                'status' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ]);
            $results_by_skill = [];
            foreach ($skill_weights as $skill_id => $weight) {
                $results_by_skill[$skill_id]['count'] = 0;
                $results_by_skill[$skill_id]['total'] = 0;
            }
            foreach ($behaviors as $behavior_id => $skill_id) {
                $value = rand(0, 1);
                $results_by_skill[$skill_id]['count'] += $value;
                $results_by_skill[$skill_id]['total']++;
                PositionUserBehavior::create([
                    'position_user_id' => $position_user->id,
                    'behavior_id' => $behavior_id,
                    'is_present' => $value
                ]);
            }
            $final_result = 0;
            foreach ($skill_weights as $skill_id => $weight) {
                $skill_result = ($results_by_skill[$skill_id]['count'] / $results_by_skill[$skill_id]['total']);
                PositionUserSkillResult::create([
                    'position_user_id' => $position_user->id,
                    'skill_id' => $skill_id,
                    'result' => $skill_result * 100,
                    'status' => 1
                ]);
                $final_result += $skill_result * $weight;
            }
            $position_user->result = $final_result;
            $position_user->status = 2;
            $position_user->save();
        }

    }
}
