<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\Classification;
use App\Models\HierarchicalLevel;
use App\Models\Position;
use App\Models\PositionSkill;
use App\Models\PositionUser;
use App\Models\PositionUserBehavior;
use App\Models\PositionUserSkillResult;
use App\Models\Skill;
use App\Models\SkillBehavior;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Laravel\Sanctum\PersonalAccessToken;
use SimpleXMLElement;
use stdClass;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class EvaluationController extends Controller
{
    public function index(Request $request)
    {
        // Obtener el token desde la URL
        $token = $request->get('access_token');

        $scorm_path = null;
        $scorm_base = null;

        $case = 'blank';//Cases: blank, no-access, no-position, wrong-position, no-invited, ok
        $position_id = $request->has('position_id') ? $request->get('position_id') : null;
        $behavior_id = $request->has('behavior_id') ? $request->get('behavior_id') : null;
        $user = null;
        $position = null;
        $position_user = null;
        $new_status = 0;

        if ($token) {
            $accessToken = PersonalAccessToken::findToken($token);
            if (!$accessToken || $accessToken->expires_at && $accessToken->expires_at->isPast()) {
                $case = 'no-access';
            } else {
                $user = $accessToken->tokenable;

                if ($position_id) {
                    $position = Position::find($position_id);
                    if ($position) {
                        if ($position->status == 1 && Carbon::now()->between($position->from, $position->to)) {
                            $position_user = PositionUser::where('position_id', $position->id)->where('user_id', $user->id)->first();
                            if ($position_user) {
                                $case = 'ok';
                                if ($position_user->status <> 2) {
                                    $status = $request->has('status') ? $request->get('status') : $position_user->status;
                                    $new_status = 1;

                                    switch ($status) {
                                        case 1:
                                            $new_status = 1;
                                            if ($position_user->status === 0) {
                                                $position_user->status = 1;
                                                $position_user->save();
                                            }

                                            //Saving result if user was viewed an scorm
                                            if ($request->has('save') && $request->get('save')) {
                                                $behavior_current = Behavior::find($request->get('behavior_id'));
                                                PositionUserBehavior::insert([
                                                    'position_user_id' => $position_user->id,
                                                    'behavior_id' => $behavior_current->id,
                                                    'is_present' => $behavior_current->is_question ? $request->get('result') == 100 : true,
                                                    'created_at' => now(),
                                                    'updated_at' => now(),
                                                ]);
                                            }

                                            $intro_finished = true;
                                            $content_finished = false;
                                            $closing_finished = false;

                                            //Getting intro scorm
                                            $scorm_start = Behavior::where('type', 'intro')->where('is_active', true)->first();

                                            //Validating intro scorm was solved or exists
                                            if ($scorm_start) {
                                                $position_users = PositionUser::where('user_id', $user->id)->pluck('id');

                                                if (!PositionUserBehavior::whereIn('position_user_id', $position_users)->where('behavior_id', $scorm_start->id)->first()) {
                                                    $intro_finished = false;
                                                    $behavior_id = $scorm_start->id;
                                                    $scorm_base = $scorm_start->scorm;
                                                }
                                            }

                                            //Validating if intro scorm was viewed
                                            if ($intro_finished) {
                                                $hierarchical_level = HierarchicalLevel::find($position->hierarchical_level_id);

                                                //Validating if there is a behavior to show or if the user has finished the content
                                                //even if user has past answers
                                                $trying = true;

                                                do {

                                                    $behavior = Behavior::whereIn(
                                                        'id',
                                                        SkillBehavior::whereNotIn(
                                                            'behavior_id',
                                                            PositionUserBehavior::where('position_user_id', $position_user->id)->pluck('behavior_id')
                                                        )->whereIn(
                                                                'skill_id',
                                                                PositionSkill::where('position_id', $position_id)->pluck('skill_id')
                                                            )->pluck('behavior_id')
                                                    )
                                                        ->where('level', ($position->type == 'fit') ? $hierarchical_level->level : $hierarchical_level->level + 1)
                                                        ->where('is_active', true)
                                                        ->orderBy('id', 'asc')
                                                        ->first();
                                                    if ($behavior) {
                                                        $behavior_id = $behavior->id;
                                                        $scorm_base = $behavior->scorm;

                                                        $previous_answer = PositionUserBehavior::whereIn(
                                                            'position_user_id',
                                                            PositionUser::where('user_id', $user->id)
                                                                ->where('id', '<>', $position_user->id)
                                                                ->pluck('id')
                                                        )
                                                            ->where('behavior_id', $behavior_id)
                                                            ->whereBetween('updated_at', [Carbon::now()->subMonths(6), Carbon::now()])
                                                            ->first();
                                                        if ($previous_answer) {
                                                            PositionUserBehavior::insert([
                                                                'position_user_id' => $position_user->id,
                                                                'behavior_id' => $previous_answer->behavior_id,
                                                                'is_present' => $previous_answer->is_present,
                                                                'created_at' => null,
                                                                'updated_at' => null,
                                                            ]);
                                                        } else {
                                                            $trying = false;
                                                        }
                                                    } else {
                                                        $trying = false;
                                                        $content_finished = true;
                                                    }
                                                } while ($trying);
                                            }

                                            //Validating if scorms content were solved
                                            if ($content_finished) {
                                                //Getting closing scorm
                                                $scorm_end = Behavior::where('type', 'closing')->where('is_active', true)->first();
                                                if ($scorm_end) {
                                                    if (!PositionUserBehavior::where('position_user_id', $position_user->id)->where('behavior_id', $scorm_end->id)->first()) {
                                                        $behavior_id = $scorm_end->id;
                                                        $scorm_base = $scorm_end->scorm;
                                                    } else {
                                                        $closing_finished = true;
                                                    }
                                                } else {
                                                    $closing_finished = true;
                                                }
                                            }

                                            if ($closing_finished && $position_user->status <> 2) {

                                                //Calculating results
                                                $behavior_results_base = PositionUserBehavior::where('position_user_id', $position_user->id);

                                                $behavior_skills = SkillBehavior::whereIn('behavior_id', $behavior_results_base->pluck('behavior_id'))->pluck('skill_id', 'behavior_id');
                                                $behavior_is_question = Behavior::whereIn('id', $behavior_results_base->pluck('behavior_id'))->pluck('is_question', 'id');

                                                $skill_weights = PositionSkill::where('position_id', $position->id)->pluck('percentage', 'skill_id')->toArray();

                                                $behavior_results = $behavior_results_base->pluck('is_present', 'behavior_id');

                                                //Initializing array for skill results
                                                $skill_results = [];
                                                foreach ($skill_weights as $skill => $percentage) {
                                                    $skill_results[$skill]['sum'] = 0;
                                                    $skill_results[$skill]['count'] = 0;
                                                }

                                                //Setting summatory and counters
                                                foreach ($behavior_skills as $behavior => $skill) {
                                                    if ($behavior_is_question[$behavior] && isset($behavior_results[$behavior]) && isset($skill_results[$skill])) {
                                                        $skill_results[$skill]['sum'] += $behavior_results[$behavior];
                                                        $skill_results[$skill]['count']++;
                                                    }
                                                }

                                                //Setting final sum and iterating results and save
                                                $final_result = 0;
                                                foreach ($skill_results as $skill => $values) {
                                                    PositionUserSkillResult::insert([
                                                        'position_user_id' => $position_user->id,
                                                        'skill_id' => $skill,
                                                        'result' => $skill_results[$skill]['sum'] / $skill_results[$skill]['count'] * 100,
                                                        'status' => 1
                                                    ]);

                                                    //Using weights to calculated final weighted result
                                                    $final_result += $skill_results[$skill]['sum'] / $skill_results[$skill]['count'] * $skill_weights[$skill];
                                                }

                                                //Saving final result and status
                                                $position_user->result = $final_result;
                                                $position_user->status = 2;
                                                $position_user->save();

                                                //Generating observation logic
                                                $position_users = PositionUser::where('id', $position_user->id)->get();

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
                                                            } elseif (0 > count($position_skills_highlighted[$position_user->position_id])) {
                                                                $position_user->is_observed = true;
                                                                $position_user->observed_comments = "Reconsideración";
                                                            } else {
                                                                $position_user->is_observed = false;
                                                                $position_user->observed_comments = "Apto";
                                                            }
                                                        } else {
                                                            $position_user->is_observed = false;
                                                        }
                                                        $position_user->observed_comments = $position_user->observed_comments . (($position_user->observed_comments && $additional_message) ? '. ' : '') . $additional_message;
                                                        $position_user->save();
                                                    }
                                                }
                                            }
                                            break;
                                    }
                                }
                            } else {
                                $case = 'no-invited';
                            }
                        } else {
                            $case = 'position-finished';
                        }
                    } else {
                        $case = 'wrong-position';
                    }
                } else {
                    $case = 'no-position';
                }
            }
        }

        if ($scorm_base) {
            $xml_path =   $scorm_base .'imsmanifest.xml';
            if (Storage::disk('uploads')->exists($xml_path)) {
                $xml_content = Storage::disk('uploads')->get($xml_path);
                $scorm_manifiest = simplexml_load_string($xml_content);
                if ($scorm_manifiest) {
                    foreach ($scorm_manifiest->resources->resource as $resource) {
                        if (isset($resource['href'])) {
                            //$scorm_path = config('app.evaluation_url') . '/storage/'. $scorm_base  . (string) $resource['href'];
                            $scorm_path = Storage::disk('uploads')->url($scorm_base . (string) $resource['href']);                            
                            break;
                        }
                    }
                }
            } else {
                \Log::warning("El archivo XML no existe en el almacenamiento público: $xml_path");
                $directories = Storage::disk('public')->directories('scorms');
                \Log::info("Directorios disponibles: " . implode(', ', $directories));
            }
        }


        return view('evaluation', compact('case', 'position_id', 'position', 'user', 'token', 'position_user', 'scorm_path', 'behavior_id', 'new_status'));
    }
}
