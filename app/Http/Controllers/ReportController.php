<?php

namespace App\Http\Controllers;

use App\Exports\EvaluatedRankingExport;
use App\Exports\ReportBySkillsExport;
use App\Http\Requests\IndividualDownloadRequest;
use App\Models\Behavior;
use App\Models\Classification;
use App\Models\Feedback;
use App\Models\Position;
use App\Models\PositionSkill;
use App\Models\PositionUser;
use App\Models\PositionUserBehavior;
use App\Models\PositionUserSkillResult;
use App\Models\Recommendation;
use App\Models\Skill;
use App\Models\SkillBehavior;
use App\Models\User;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Laravel\Sanctum\PersonalAccessToken;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class ReportController extends Controller
{

    /**
     * Evaluated ranking
     * @OA\Get (
     *     path="/api/reports/evaluated-ranking",
     *     tags={"Reports"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener ranking de candidatos",
     *     description="Obtener ranking de candidatos.",
     *     @OA\Parameter(
     *         name="position_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *     @OA\Parameter(
     *         name="hierarchical_level_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del nivel jerárquico"
     *     ),
     *     @OA\Parameter(
     *         name="text",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Palabras clave - Nombres, apellido o email"
     *     ),
     *     @OA\Parameter(
     *         name="result_from",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="number"
     *         ),
     *         description="Resultado - Desde"
     *     ),
     *     @OA\Parameter(
     *         name="result_to",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="number"
     *         ),
     *         description="Resultado - Hasta"
     *     ),
     *     @OA\Parameter(
     *         name="is_observed",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="boolean"
     *         ),
     *         description="¿Está observado?"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Ranking de candidatos obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="order", type="number", example=2),
     *                      @OA\Property(property="position", type="string", example="Puesto 1"),
     *                      @OA\Property(property="name", type="date", example="2024-01-01"),
     *                      @OA\Property(property="quantitative_result", type="number", example=80),
     *                      @OA\Property(property="qualitative_result", type="number", example=80),
     *                      @OA\Property(property="is_observed", type="boolean", example=true)
     *              ),
     *              @OA\Property(property="message", type="string", example="Ranking de candidatos obtenido exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Credenciales inválidas."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Tu email no se encuentra verificado",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Tu email no se encuentra verificado."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar la solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="No se pudo completar la solicitud."),
     *          )
     *      )
     * )
     *
     * Getting evaluateds ranking
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function evaluatedRanking(Request $request): JsonResponse
    {
        try {
            $results = PositionUser::with(['position', 'user'])
                ->where(function ($query) use ($request) {
                    if ($request->has('position_id') && is_numeric($request->get('position_id'))) {
                        $query->where('position_id', $request->get('position_id'));
                    }
                    if ($request->has('hierarchical_level_id') && is_numeric($request->get('hierarchical_level_id'))) {
                        $query->whereHas('position', function ($subquery) use ($request) {
                            $subquery->where('hierarchical_level_id', $request->get('hierarchical_level_id'));
                        });
                    }
                    if ($request->has('text') && $request->get('text')) {
                        $query->whereHas('user', function ($subquery) use ($request) {
                            $subquery->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
                            $subquery->orWhereRaw("unaccent(lastname) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
                            $subquery->orWhereRaw("unaccent(email) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
                        });
                    }
                    if (auth('sanctum')->user()->role == 'C') {
                        $query->whereHas('position', function ($subquery) use ($request) {
                            $subquery->where('user_id', auth('sanctum')->user()->id);
                            return $subquery;
                        });
                    }
                    if ($request->has('result_from') && $request->get('result_from')) {
                        $query->where('result', '>=', $request->get('result_from'));
                    }
                    if ($request->has('result_to') && $request->get('result_to')) {
                        $query->where('result', '<=', $request->get('result_to'));
                    }
                })
                ->where('status', 2)
                ->whereNotIn('position_id', Position::withTrashed()->whereNotNull('deleted_at')->pluck('id'))
                ->orderBy('result', 'DESC')
                ->get();

            //Obtaining list of classifications
            $classifications = Classification::where('is_active', true)->get();
            $results_final = [];
            $i = 0;
            foreach ($results as $result) {
                $result_classification = "";
                $result_classification_code = "";
                foreach ($classifications as $classification) {
                    if ($classification->from <= $result->result && $classification->to >= $result->result) {
                        $result_classification = $classification->name;
                        $result_classification_code = $classification->code;
                    }
                }
                $results_final[] = [
                    'order' => ++$i,
                    'position' => $result->position->name,
                    'name' => $result->user->name . ' ' . $result->user->lastname,
                    'quantitative_result' => $result->result,
                    'qualitative_result' => $result_classification,
                    'qualitative_result_code' => $result_classification_code,
                    'is_observed' => $result->is_observed,
                    'observed_comments' => $result->observed_comments
                ];
            }
            return response()->json([
                'data' => $results_final,
                'message' => 'Ranking de candidatos obtenido exitosamente.'
            ], Response::HTTP_OK);

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Evaluated ranking export
     * @OA\Get (
     *     path="/api/reports/evaluated-ranking/export",
     *     tags={"Reports"},
     *     summary="Exportar ranking de candidatos",
     *     description="Exportar ranking de candidatos.",
     *     @OA\Parameter(
     *      name="access_token",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Access token"
     *     ),
     *     @OA\Parameter(
     *         name="position_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *     @OA\Parameter(
     *         name="hierarchical_level_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del nivel jerárquico"
     *     ),
     *     @OA\Parameter(
     *         name="text",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Palabras clave - Nombres, apellido o email"
     *     ),
     *     @OA\Parameter(
     *         name="result_from",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="number"
     *         ),
     *         description="Resultado - Desde"
     *     ),
     *     @OA\Parameter(
     *         name="result_to",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="number"
     *         ),
     *         description="Resultado - Hasta"
     *     ),
     *     @OA\Parameter(
     *         name="is_observed",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="boolean"
     *         ),
     *         description="¿Está observado?"
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Descarga realizada exitosamente.",
     *         @OA\Header(
     *             header="Content-Disposition",
     *             description="attachment; filename=ranking.xlsx",
     *             @OA\Schema(
     *                 type="string"
     *             )
     *         ),
     *         @OA\MediaType(
     *             mediaType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
     *             @OA\Schema(
     *                 type="string",
     *                 format="binary"
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Credenciales inválidas."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Tu email no se encuentra verificado",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Tu email no se encuentra verificado."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar la solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="No se pudo completar la solicitud."),
     *          )
     *      )
     * )
     *
     * Exporting found positions
     *
     * @param Request $request
     * @return BinaryFileResponse|JsonResponse
     */
    public function exportEvaluatedRanking(Request $request): BinaryFileResponse|JsonResponse
    {
        try {
            // Obtener el token desde la URL
            $token = $request->query('access_token');

            // Si no se encuentra el token, devolver un error
            if (!$token) {
                return response()->json([
                    'message' => 'No se ha enviado el token.'
                ], Response::HTTP_UNAUTHORIZED);
            } else {
                // Validar el token en la tabla `personal_access_tokens`
                $accessToken = PersonalAccessToken::findToken($token);
                if (!$accessToken) {
                    return response()->json([
                        'message' => 'Credenciales inválidas.'
                    ], Response::HTTP_UNAUTHORIZED);
                } else {
                    if (!$accessToken || $accessToken->expires_at && $accessToken->expires_at->isPast()) {
                        if (!$token) {
                            return response()->json([
                                'message' => 'El token ha expirado.'
                            ], Response::HTTP_UNAUTHORIZED);
                        }
                    }
                    return Excel::download(new EvaluatedRankingExport($request, $accessToken->tokenable), 'Ranking_Evaluados_' . Carbon::now()->format('Y-m-d') . '.xlsx');
                }
            }

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Results by skills
     * @OA\Get (
     *     path="/api/reports/by-skills",
     *     tags={"Reports"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener resultados por habilidades",
     *     description="Obtener resultados por habilidades.",
     *     @OA\Parameter(
     *         name="position_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Resultados por habilidades obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="order", type="number", example=2),
     *                      @OA\Property(property="position", type="string", example="Puesto 1"),
     *                      @OA\Property(property="name", type="date", example="2024-01-01"),
     *                      @OA\Property(property="quantitative_result", type="number", example=80),
     *                      @OA\Property(property="qualitative_result", type="number", example=80),
     *                      @OA\Property(property="is_observed", type="boolean", example=true)
     *              ),
     *              @OA\Property(property="message", type="string", example="Resultados por habilidades obtenido exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Credenciales inválidas."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Tu email no se encuentra verificado",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Tu email no se encuentra verificado."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar la solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="No se pudo completar la solicitud."),
     *          )
     *      )
     * )
     *
     * Getting results by skills
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function bySkills(Request $request): JsonResponse
    {
        try {

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
            $i = 1;
            foreach ($position_users as $position_user) {
                $by_skills = [];
                //Setting header with skill/weight
                foreach ($skill_weights as $skill) {
                    if (isset($located_position_user_results[$position_user->id][$skill->skill->id])) {
                        $by_skills[$skill->skill->name] = (float) $located_position_user_results[$position_user->id][$skill->skill->id];
                    }
                }

                $results[] = [
                    'order' => $i,
                    'name' => $position_user->user->name . ' ' . $position_user->user->lastname,
                    'results' => $by_skills,
                    'average' => $position_user->result,
                    'comments' => $position_user->observed_comments,
                ];
                $i++;
            }

            return response()->json([
                'data' => [
                    'skills' => $skills,
                    'results' => $results,
                ],
                'message' => 'Resultados por habilidades obtenido exitosamente.'
            ], Response::HTTP_OK);

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Results by skills export
     * @OA\Get (
     *     path="/api/reports/by-skills/export",
     *     tags={"Reports"},
     *     summary="Exportar resultados por habilidades",
     *     description="Exportar resultados por habilidades.",
     *     @OA\Parameter(
     *      name="access_token",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Access token"
     *     ),
     *     @OA\Parameter(
     *         name="position_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Descarga realizada exitosamente.",
     *         @OA\Header(
     *             header="Content-Disposition",
     *             description="attachment; filename=by-skills.xlsx",
     *             @OA\Schema(
     *                 type="string"
     *             )
     *         ),
     *         @OA\MediaType(
     *             mediaType="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet",
     *             @OA\Schema(
     *                 type="string",
     *                 format="binary"
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Credenciales inválidas."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Tu email no se encuentra verificado",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Tu email no se encuentra verificado."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar la solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="No se pudo completar la solicitud."),
     *          )
     *      )
     * )
     *
     * Exporting found positions
     *
     * @param Request $request
     * @return BinaryFileResponse|JsonResponse
     */
    public function exportBySkills(Request $request): BinaryFileResponse|JsonResponse
    {
        try {
            // Obtener el token desde la URL
            $token = $request->query('access_token');

            // Si no se encuentra el token, devolver un error
            if (!$token) {
                return response()->json([
                    'message' => 'No se ha enviado el token.'
                ], Response::HTTP_UNAUTHORIZED);
            } else {
                // Validar el token en la tabla `personal_access_tokens`
                $accessToken = PersonalAccessToken::findToken($token);
                if (!$accessToken) {
                    return response()->json([
                        'message' => 'Credenciales inválidas.'
                    ], Response::HTTP_UNAUTHORIZED);
                } else {
                    if (!$accessToken || $accessToken->expires_at && $accessToken->expires_at->isPast()) {
                        if (!$token) {
                            return response()->json([
                                'message' => 'El token ha expirado.'
                            ], Response::HTTP_UNAUTHORIZED);
                        }
                    }
                    return Excel::download(new ReportBySkillsExport($request, $accessToken->tokenable), 'Ranking_Evaluados_' . Carbon::now()->format('Y-m-d') . '.xlsx');
                }
            }

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Individual report
     * @OA\Get (
     *     path="/api/reports/{id}/individual",
     *     tags={"Reports"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener informe individual",
     *     description="Obtener informe individual.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del evaluado"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Informe individual obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="order", type="number", example=2),
     *                      @OA\Property(property="position", type="string", example="Puesto 1"),
     *                      @OA\Property(property="name", type="date", example="2024-01-01"),
     *                      @OA\Property(property="quantitative_result", type="number", example=80),
     *                      @OA\Property(property="qualitative_result", type="number", example=80),
     *                      @OA\Property(property="is_observed", type="boolean", example=true)
     *              ),
     *              @OA\Property(property="message", type="string", example="Informe individual obtenido exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Credenciales inválidas."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Tu email no se encuentra verificado",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Tu email no se encuentra verificado."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar la solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="No se pudo completar la solicitud."),
     *          )
     *      )
     * )
     *
     * Getting individual report
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function individualReport(Request $request, int $id): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->individualData($id),
                'message' => 'Informe individual obtenido exitosamente.'
            ], Response::HTTP_OK);
        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * PDI
     * @OA\Get (
     *     path="/api/reports/{id}/pdi",
     *     tags={"Reports"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener PDI de evaluado",
     *     description="Obtener PDI de evaluado.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del evaluado"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="PDI obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="order", type="number", example=2),
     *                      @OA\Property(property="position", type="string", example="Puesto 1"),
     *                      @OA\Property(property="name", type="date", example="2024-01-01"),
     *                      @OA\Property(property="quantitative_result", type="number", example=80),
     *                      @OA\Property(property="qualitative_result", type="number", example=80),
     *                      @OA\Property(property="is_observed", type="boolean", example=true)
     *              ),
     *              @OA\Property(property="message", type="string", example="PDI obtenido exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Credenciales inválidas."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Tu email no se encuentra verificado",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Tu email no se encuentra verificado."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar la solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="No se pudo completar la solicitud."),
     *          )
     *      )
     * )
     *
     * Getting individual report
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function pdi(Request $request, int $id): JsonResponse
    {
        try {
            return response()->json([
                'data' => $this->pdiData($id),
                'message' => 'Resultados por habilidades obtenido exitosamente.'
            ], Response::HTTP_OK);

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Individual report download
     * @OA\Post (
     *     path="/api/reports/individual/download",
     *     tags={"Reports"},
     *     summary="Descargar reporte individual",
     *     description="Descargar reporte individual.",
     *         @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="position",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="evaluated",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="access_token",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="chart",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "position":"1",
     *                     "evaluated":"2",
     *                     "access_token":"P",
     *                     "chart":"base64:data/image...",
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Descarga realizada exitosamente.",
     *         @OA\Header(
     *             header="Content-Disposition",
     *             description="attachment; filename=individual_report.pdf",
     *             @OA\Schema(
     *                 type="string"
     *             )
     *         ),
     *         @OA\MediaType(
     *             mediaType="application/pdf",
     *             @OA\Schema(
     *                 type="string",
     *                 format="binary"
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Credenciales inválidas."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Tu email no se encuentra verificado",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Tu email no se encuentra verificado."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar la solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="No se pudo completar la solicitud."),
     *          )
     *      )
     * )
     *
     * Downloading individual report
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function individualReportDownload(IndividualDownloadRequest $request): BinaryFileResponse|JsonResponse|Response
    {
        $request->validated();
        try {
            // Obtener el token desde la URL
            $token = $request->get('access_token');

            // Si no se encuentra el token, devolver un error
            if (!$token) {
                return response()->json([
                    'message' => 'No se ha enviado el token.'
                ], Response::HTTP_UNAUTHORIZED);
            } else {
                // Validar el token en la tabla `personal_access_tokens`
                $accessToken = PersonalAccessToken::findToken($token);
                if (!$accessToken) {
                    return response()->json([
                        'message' => 'Credenciales inválidas.'
                    ], Response::HTTP_UNAUTHORIZED);
                } else {
                    if (!$accessToken || $accessToken->expires_at && $accessToken->expires_at->isPast()) {
                        if (!$token) {
                            return response()->json([
                                'message' => 'El token ha expirado.'
                            ], Response::HTTP_UNAUTHORIZED);
                        }
                    }

                    $data = $this->individualData($request->get('evaluated'));
                    $data['chart'] = $request->get('chart');

                    // Renderiza la vista como PDF
                    $pdf = Pdf::loadView('reports.individual', compact('data'));

                    return response($pdf->output())
                        ->header('Content-Type', 'application/pdf')
                        ->header('Content-Disposition', 'attachment; filename="reporte_individual.pdf"');
                }
            }
        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * PDI download
     * @OA\Post (
     *     path="/api/reports/pdi/download",
     *     tags={"Reports"},
     *     summary="Descargar reporte PDI",
     *     description="Descargar reporte PDI.",
     *         @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="position",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="evaluated",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="access_token",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="chart",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "position":"1",
     *                     "evaluated":"2",
     *                     "access_token":"P",
     *                     "chart":"base64:data/image...",
     *                }
     *             )
     *         )
     *      ),
     *     @OA\Response(
     *          response=200,
     *          description="Descarga realizada exitosamente.",
     *         @OA\Header(
     *             header="Content-Disposition",
     *             description="attachment; filename=pdi.pdf",
     *             @OA\Schema(
     *                 type="string"
     *             )
     *         ),
     *         @OA\MediaType(
     *             mediaType="application/pdf",
     *             @OA\Schema(
     *                 type="string",
     *                 format="binary"
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Credenciales inválidas."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Tu email no se encuentra verificado",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Tu email no se encuentra verificado."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar la solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="No se pudo completar la solicitud."),
     *          )
     *      )
     * )
     *
     * Downloading PDI
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function pdiDownload(IndividualDownloadRequest $request): BinaryFileResponse|JsonResponse|Response
    {
        $request->validated();
        try {
            // Obtener el token desde la URL
            $token = $request->get('access_token');

            // Si no se encuentra el token, devolver un error
            if (!$token) {
                return response()->json([
                    'message' => 'No se ha enviado el token.'
                ], Response::HTTP_UNAUTHORIZED);
            } else {
                // Validar el token en la tabla `personal_access_tokens`
                $accessToken = PersonalAccessToken::findToken($token);
                if (!$accessToken) {
                    return response()->json([
                        'message' => 'Credenciales inválidas.'
                    ], Response::HTTP_UNAUTHORIZED);
                } else {
                    if (!$accessToken || $accessToken->expires_at && $accessToken->expires_at->isPast()) {
                        if (!$token) {
                            return response()->json([
                                'message' => 'El token ha expirado.'
                            ], Response::HTTP_UNAUTHORIZED);
                        }
                    }

                    $data = $this->pdiData($request->get('evaluated'));
                    $data['chart'] = $request->get('chart');

                    // Renderiza la vista como PDF
                    $pdf = Pdf::loadView('reports.pdi', compact('data'));

                    return response($pdf->output())
                        ->header('Content-Type', 'application/pdf')
                        ->header('Content-Disposition', 'attachment; filename="pdi.pdf"');
                }
            }
        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    private function individualData($id)
    {
        $position_user = PositionUser::find($id);
        $user = User::find($position_user->user_id);
        $position = Position::where('id', $position_user->position_id)->with(['organization', 'hierarchicalLevel'])->first();

        $skills = PositionUserSkillResult::with(['skill'])->where('position_user_id', $position_user->id)->get();

        $by_skills = [];
        $by_behaviors = null;

        $behavior_results_base = PositionUserBehavior::where('position_user_id', $position_user->id);
        $behavior_skills = SkillBehavior::with(['skill', 'behavior'])->whereIn('behavior_id', $behavior_results_base->pluck('behavior_id'))->get();
        $behavior_is_question = Behavior::whereIn('id', $behavior_results_base->pluck('behavior_id'))->pluck('is_question', 'id');
        $behavior_results = $behavior_results_base->pluck('is_present', 'behavior_id')->toArray();

        foreach ($behavior_skills as $data) {
            if ($behavior_is_question[$data->behavior->id]) {
                $by_behaviors[$data->skill->name][] = [
                    'text' => $data->behavior->name,
                    'is_present' => $behavior_results[$data->behavior->id]
                ];
            }
        }

        //Obtaining list of classifications
        $classifications = Classification::where('is_active', true)->get();

        //Obtaning list of feedbacks based on skills ID
        $feedbacks_list = Feedback::whereIn('skill_id', $skills->pluck('skill_id'))
            ->where('level', ($position->type == 'fit') ? $position->hierarchicalLevel->level : $position->hierarchicalLevel->level + 1)
            ->get();
        $feedbacks = [];
        foreach ($feedbacks_list as $feedback) {
            $feedbacks[$feedback->skill_id][$feedback->classification_id] = $feedback->content;
        }

        foreach ($skills as $skill) {
            $skill_classification = "";
            $skill_classification_id = 0;
            //Calculating classification by skill result
            foreach ($classifications as $classification) {
                if ($classification->from <= $skill->result && $classification->to >= $skill->result) {
                    $skill_classification = $classification->code;
                    $skill_classification_id = $classification->id;
                    break;
                }
            }

            $by_skills[$skill->skill->name] = [
                'description' => isset($feedbacks[$skill->skill->id][$skill_classification_id]) ? $feedbacks[$skill->skill->id][$skill_classification_id] : '',
                'result' => (float) $skill->result,
                'result_code' => $skill_classification
            ];
        }
        //Ordering by skill name
        ksort($by_skills, SORT_NATURAL | SORT_FLAG_CASE);

        //Calculating classification by total average result
        $average_code = "";
        $average_text = "";
        $average_classification_id = null;
        foreach ($classifications as $classification) {
            if ($classification->from <= $position_user->result && $classification->to >= $position_user->result) {
                $average_code = $classification->code;
                $average_text = $classification->name;
                $average_classification_id = $classification->id;
                break;
            }
        }
        $average_comment = Feedback::whereNull('skill_id')->where('classification_id', $average_classification_id)->first();

        return [
            'user' => $user,
            'position' => $position,
            'result' => [
                'average_code' => $average_code,
                'average_text' => $average_text,
                'average' => $position_user->result,
                'comments' => isset($average_comment->content) ? $average_comment->content : '',
                'by_skills' => $by_skills,
                'by_behaviors' => $by_behaviors,
            ],
        ];
    }

    private function pdiData($id)
    {
        $position_user = PositionUser::find($id);
        $user = User::find($position_user->user_id);
        $position = Position::where('id', $position_user->position_id)->with(['organization', 'hierarchicalLevel'])->first();

        $skills = PositionUserSkillResult::with(['skill'])->where('position_user_id', $position_user->id)->get();

        $by_skills = [];
        $skill_actions = null;

        //Obtaining list of classifications
        $classifications = Classification::where('is_active', true)->get();

        //Obtaning list of feedbacks based on skills ID and setting formatted list
        $feedbacks_list = Feedback::whereIn('skill_id', $skills->pluck('skill_id'))
            ->where('level', ($position->type == 'fit') ? $position->hierarchicalLevel->level : $position->hierarchicalLevel->level + 1)
            ->get();
        $feedbacks = [];
        foreach ($feedbacks_list as $feedback) {
            $feedbacks[$feedback->skill_id][$feedback->classification_id] = $feedback->content;
        }

        //Obtaning list of recommendations based on skills ID and setting formatted list
        $recommendations_list = Recommendation::whereIn('skill_id', $skills->pluck('skill_id'))->get();
        $recommendations = [];
        foreach ($recommendations_list as $recommendation) {
            foreach (json_decode($recommendation->list) as $list_total) {
                foreach ($list_total as $list_index => $list_item) {
                    foreach ($list_item as $list_name => $list) {
                        $recommendations[$recommendation->skill_id][$recommendation->classification_id][$list->type][$list_name] = $list->list;
                    }
                }
            }
        }

        foreach ($skills as $skill) {
            $skill_classification = "";
            $skill_classification_id = 0;
            //Calculating classification by skill result
            foreach ($classifications as $classification) {
                if ($classification->from <= $skill->result && $classification->to >= $skill->result) {
                    $skill_classification = $classification->code;
                    $skill_classification_id = $classification->id;
                    break;
                }
            }

            $by_skills[$skill->skill->name] = [
                'description' => $skill->skill->description,
                'result' => (float) $skill->result,
                'result_code' => $skill_classification
            ];

            $skill_actions[$skill->skill->name] = isset($recommendations[$skill->skill->id][$skill_classification_id]) ? $recommendations[$skill->skill->id][$skill_classification_id] : '';
        }

        //Ordering by skill name
        ksort($by_skills, SORT_NATURAL | SORT_FLAG_CASE);

        //Calculating classification by total average result
        $average_code = "";
        $average_text = "";
        $average_classification_id = null;
        foreach ($classifications as $classification) {
            if ($classification->from <= $position_user->result && $classification->to >= $position_user->result) {
                $average_code = $classification->code;
                $average_text = $classification->name;
                $average_classification_id = $classification->id;
                break;
            }
        }
        $average_comment = Feedback::whereNull('skill_id')->where('classification_id', $average_classification_id)->first();

        return [
            'user' => $user,
            'position' => $position,
            'result' => [
                'average_code' => $average_code,
                'average_text' => $average_text,
                'average' => $position_user->result,
                'comments' => isset($average_comment->content) ? $average_comment->content : '',
                'by_skills' => $by_skills,
                'skill_actions' => $skill_actions,
            ],
        ];
    }

    /**
     * Share results for PowerBI
     * @OA\Get (
     *     path="/api/reports/results",
     *     tags={"Reports"},
     *     security={{"bearerAuth":{}}},
     *     summary="Compartir resultados para PowerBI",
     *     description="Resultados en general.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="access_token"
     *         ),
     *         description="Token de acceso"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Resultados compartidos exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="results", type="array", @OA\Items(type="object")),
     *              ),
     *              @OA\Property(property="message", type="string", example="Resultados compartidos exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Credenciales inválidas."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=403,
     *          description="Tu email no se encuentra verificado",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Tu email no se encuentra verificado."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar la solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="No se pudo completar la solicitud."),
     *          )
     *      )
     * )
     *
     * Sharing results for PowerBI
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function results(Request $request): JsonResponse
    {
        try {
            // Obtener el token desde la URL
            $token = $request->get('access_token');

            // Si no se encuentra el token, devolver un error
            if (!$token) {
                return response()->json([
                    'message' => 'No se ha enviado el token.'
                ], Response::HTTP_UNAUTHORIZED);
            } else {
                // Validar el token en la tabla `personal_access_tokens`
                $accessToken = PersonalAccessToken::findToken($token);
                if (!$accessToken) {
                    return response()->json([
                        'message' => 'Credenciales inválidas.'
                    ], Response::HTTP_UNAUTHORIZED);
                } else {
                    if (!$accessToken || $accessToken->expires_at && $accessToken->expires_at->isPast()) {
                        if (!$token) {
                            return response()->json([
                                'message' => 'El token ha expirado.'
                            ], Response::HTTP_UNAUTHORIZED);
                        }
                    }

                    $results = DB::table('positions as p')
                        ->join('hierarchical_levels as hl', 'p.hierarchical_level_id', '=', 'hl.id')
                        ->join('position_users as pu', 'pu.position_id', '=', 'p.id')
                        ->join('users as u', 'pu.user_id', '=', 'u.id')
                        ->join('position_user_behaviors as pub', 'pub.position_user_id', '=', 'pu.id')
                        ->join('behaviors as b', 'pub.behavior_id', '=', 'b.id')
                        ->join('skill_behaviors as sb', 'sb.behavior_id', '=', 'b.id')
                        ->join('skills as s', 'sb.skill_id', '=', 's.id')
                        ->join('position_skills as ps', function ($join) {
                            $join->on('ps.skill_id', '=', 's.id')
                                ->on('ps.position_id', '=', 'p.id');
                        })
                        ->join('position_user_skill_results as pusr', function ($join) {
                            $join->on('pusr.position_user_id', '=', 'pu.id')
                                ->on('pusr.skill_id', '=', 's.id');
                        })
                        ->where('pu.status', 2)
                        ->where('b.level', '>', 0)
                        ->where('b.is_question', true)
                        ->select([
                            'hl.name as hierarchical_level',
                            'p.name as position',
                            DB::raw("CONCAT(u.name, ' ', u.lastname) AS person"),
                            'pu.result as general_result',
                            's.name as skill',
                            'pusr.result as skill_result',
                            'ps.percentage',
                            'b.name as behavior',
                            'pub.is_present'
                        ])
                        ->get();

                    return response()->json([
                        'data' => $results,
                        'message' => 'Resultados compartidos exitosamente.'
                    ], Response::HTTP_OK);
                }
            }

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
