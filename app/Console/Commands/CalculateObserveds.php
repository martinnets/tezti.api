<?php

namespace App\Console\Commands;

use App\Models\Classification;
use App\Models\PositionSkill;
use App\Models\PositionUser;
use App\Models\PositionUserSkillResult;
use Illuminate\Console\Command;

class CalculateObserveds extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:calculate-observeds';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'This command calculates if results are observed for evaluateds.';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Inicio de comando - Cálculo de resultados para generar observaciones.');

        $position_users = PositionUser::whereNull('is_observed')->where('status', 2)->get();

        $total_updated = 0;

        //Obtaining list of classification
        $classification = Classification::where('code', "2")->first();
        $classification_high = Classification::where('code', "3")->first();

        $position_user_skill_results = PositionUserSkillResult::whereIn('position_user_id', $position_users->pluck('id'))->get();
        $position_users = PositionUser::whereIn('id', $position_user_skill_results->pluck('position_user_id'))->get();
        $position_skills = PositionSkill::whereIn('position_id', $position_users->pluck('position_id'))->get();

        $position_skills_formated = [];
        foreach ($position_skills as $position_skill) {
            $position_skills_formated[$position_skill->position_id][$position_skill->skill_id] = $position_skill->percentage;
        }
        $position_skills_highlighted = [];
        foreach ($position_skills_formated as $position_id => $skills_weight) {
            $min_weight = (100 / count($skills_weight)) + 1;
            foreach ($skills_weight as $skill_id => $skill_weight) {
                if ($skill_weight >= $min_weight) {
                    $position_skills_highlighted[$position_id][] = $skill_id;
                }
            }
        }

        $results_by_position_users = [];
        foreach ($position_user_skill_results as $skill_result) {
            $results_by_position_users[$skill_result->position_user_id][$skill_result->skill_id] = $skill_result->result;
        }

        foreach ($results_by_position_users as $position_user_id => $skill_results) {

            $position_user = PositionUser::with(['position'])->where('id', $position_user_id)->first();

            //Verificando si el resultado se encuentra en Alto para correr lógica de observación
            if ($position_user->result >= $classification_high->from) {
                $additional_message = "";
                if (!isset($position_skills_highlighted[$position_user->position_id])) {
                    $additional_message = "Este proceso no cuenta con habilidades destacadas, tomar en cuenta la falta de criterios para detección de brechas.";
                }

                //Si alguna de las habilidades está como "No apta"
                foreach ($skill_results as $skill_id => $result) {
                    if ($skill_results[$skill_id] < $classification->from) {
                        $position_user->is_observed = true;
                        $position_user->observed_comments = "Alerta de revisión";
                        $total_updated++;
                        break;
                    }
                }

                if (is_null($position_user->is_observed) && isset($position_skills_highlighted[$position_user->position_id])) {
                    $counter = 0;
                    foreach ($position_skills_highlighted[$position_user->position_id] as $highlighted) {
                        //Recopilando la cantida de habilidades con mayor peso
                        if ($skill_results[$highlighted] >= $classification->from && $skill_results[$highlighted] <= $classification->to) {
                            $counter++;
                        }
                    }

                    if ($counter == count($position_skills_highlighted[$position_user->position_id])) {
                        $position_user->is_observed = true;
                        $position_user->observed_comments = "Verificación";
                        $total_updated++;
                    } elseif (0 > count($position_skills_highlighted[$position_user->position_id])) {
                        $position_user->is_observed = true;
                        $position_user->observed_comments = "Reconsideración";
                        $total_updated++;
                    } else {
                        $position_user->is_observed = false;
                        $position_user->observed_comments = "Apto";
                        $total_updated++;
                    }
                } else {
                    $position_user->is_observed = false;
                    $total_updated++;
                }
                $position_user->observed_comments = $position_user->observed_comments . (($position_user->observed_comments && $additional_message) ? '. ' : '') . $additional_message;
                $position_user->save();
            }
        }

        $this->info('Fin de comando - Cálculo de resultados para generar observaciones. Se registraron ' . $total_updated . ' cálculos de observación.');

    }
}
