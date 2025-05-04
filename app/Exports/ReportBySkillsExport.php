<?php

namespace App\Exports;

use App\Models\Classification;
use App\Models\Position;
use App\Models\PositionSkill;
use App\Models\PositionUser;
use App\Models\PositionUserSkillResult;
use Illuminate\Support\Collection;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class ReportBySkillsExport implements FromCollection, WithHeadings
{
    protected $headings;
    protected $filters;
    protected $user;


    /**
     * Summary of __construct
     * @param mixed $headings
     * @param mixed $filters
     * @param mixed $user
     */
    public function __construct($filters, $user)
    {
        $this->filters = $filters;
        $this->user = $user;

        $skills_headings = [];

        if (isset($filters['position_id'])) {
            $position = Position::find($filters['position_id']);
            $skill_weights = PositionSkill::with(['skill'])->where('position_id', $position->id)->get();

            foreach ($skill_weights as $skill) {
                $skill_label = $skill->skill->name . ' (' . (float) $skill->percentage . '%)';
                $skills_headings[] = $skill_label;
            }
        }

        $this->headings = $skills_headings;
    }


    /**
     * Summary of headings
     * @return array
     */
    public function headings(): array
    {
        $headings[] = 'Nombres y apellidos';
        if (is_array($this->headings) && count($this->headings) > 0) {
            foreach ($this->headings as $heading) {
                $headings[] = $heading;
            }
        }
        $headings[] = 'Resultado cuantitativo';
        $headings[] = 'Tipo de casuística';
        return $headings;
    }


    /**
     * @return \Illuminate\Support\Collection
     */
    public function collection(): Collection
    {
        $items = [];
        $request = $this->filters;

        $position = Position::find($request->get('position_id'));
        $position_users_base = PositionUser::with(['user'])
            ->where('position_id', $position->id)
            ->where('status', 2)
            ->orderBy('result', 'DESC');

        $position_users = $position_users_base->get();

        //Setting results by evaluated/skill
        $position_user_results = PositionUserSkillResult::whereIn('position_user_id', $position_users_base->pluck('id'))->get();
        $located_position_user_results = [];
        foreach ($position_user_results as $position_user_result) {
            $located_position_user_results[$position_user_result->position_user_id][$position_user_result->skill_id] = $position_user_result->result;
        }

        $skill_weights = PositionSkill::with(['skill'])->where('position_id', $position->id)->get();

        $skills = [];
        $results = [];

        //Setting header with skill/weight
        foreach ($skill_weights as $skill) {
            $skills[$skill->skill->name] = (float) $skill->percentage;
        }

        //Setting body with user/skill/weight
        foreach ($position_users as $position_user) {
            $by_skills = [];
            //Setting header with skill/weight
            foreach ($skill_weights as $skill) {
                if (isset($located_position_user_results[$position_user->id][$skill->skill->id])) {
                    $by_skills[$skill->skill->name] = (float) $located_position_user_results[$position_user->id][$skill->skill->id];
                }
            }

            $data['name'] = $position_user->user->name . ' ' . $position_user->user->lastname;
            $data['average'] = $position_user->result;
            foreach ($skills as $skill_name => $skill_weight) {
                $data[$skill_name . '(' . $skill_weight . '%)'] = isset($by_skills[$skill_name]) ? $by_skills[$skill_name] : 0;
                $skills_headings[] = $skill_name . ' (' . $skill_weight . '%)';
            }
            $data['comments'] = $position_user->observed_comments;

            $results[] = $data;
        }

        return collect($results);
    }
}
