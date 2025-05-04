<?php

namespace App\Http\Controllers;

use App\Enums\PositionUserStatus;
use App\Exports\SearchEvaluatedExport;
use App\Http\Requests\SearchRequest;
use App\Models\Position;
use App\Models\PositionSkill;
use App\Models\PositionUser;
use App\Models\PositionUserSkillResult;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Laravel\Sanctum\PersonalAccessToken;
use Maatwebsite\Excel\Facades\Excel;
use Symfony\Component\HttpFoundation\BinaryFileResponse;

class EvaluatedController extends Controller
{
    /**
     * Get evaluated filter - search for positions
     * @OA\Get (
     *     path="/api/evaluateds/filters/positions/search",
     *     tags={"Evaluateds"},
     *     security={{"bearerAuth":{}}},
     *     summary="Filtros - Buscar puestos",
     *     description="Filtros - Buscar en listado de puestos.",
     *     @OA\Parameter(
     *         name="text",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Nombre de puesto o de la organización"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Búsqueda de puestos realizada exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Puesto 002")
     *                   ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Búsqueda de puestos realizada exitosamente."),
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
     *      )
     * )
     *
     * Getting evaluated filter - search for positions
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function searchPositions(Request $request): JsonResponse
    {
        $positions = Position::with(['organization'])
            ->where(function ($query) use ($request) {
                if (auth('sanctum')->user()->organization_id) {
                    $query->where('organization_id', auth('sanctum')->user()->organization_id);
                }
                if (auth('sanctum')->user()->role == 'C') {
                    $query->where('user_id', auth('sanctum')->user()->id);
                }
                if ($request->has('text')) {
                    $query->where('name', 'LIKE', '%' . $request->get('text') . '%');
                    $query->orWhereHas('organization', function ($subquery) use ($request) {
                        $subquery->where('name', 'LIKE', '%' . $request->get('text') . '%');
                        return $subquery;
                    });
                }
                return $query;
            })
            ->select(['id', 'name', 'organization_id'])
            ->orderBy('name', 'ASC')
            ->get()
            ->makeHidden(['status_label', 'organization_id']);

        return response()->json([
            'data' => $positions,
            'message' => 'Búsqueda de puestos realizada exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Get evaluated filter - list of status
     * @OA\Get (
     *     path="/api/evaluateds/filters/status/get",
     *     tags={"Evaluateds"},
     *     security={{"bearerAuth":{}}},
     *     summary="Filtros - Lista de estados de evaluado",
     *     description="Filtros - Listado de estados de evaluado.",
     *      @OA\Response(
     *          response=200,
     *          description="Lista de estados de evaluado obtenida exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="number", example=1),
     *                      @OA\Property(property="name", type="string", example="Finalizado")
     *                   ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Lista de estados de evaluado obtenida."),
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
     *      )
     * )
     *
     * Getting evaluated filter - list of status
     *
     * @return JsonResponse
     */
    public function getStatus(): JsonResponse
    {
        return response()->json([
            'data' => PositionUserStatus::COLLECTION,
            'message' => 'Listado de estados de usuario obtenido exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Get indicators
     * @OA\Get (
     *     path="/api/evaluateds/indicators/get",
     *     tags={"Evaluateds"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener indicadores",
     *     description="Obtener indicadores de evaluados.",
     *      @OA\Response(
     *          response=200,
     *          description="Indicadores de evaluados obtenidos exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="total", type="number", example=20),
     *                      @OA\Property(property="sent", type="number", example=10),
     *                      @OA\Property(property="in-process", type="number", example=8),
     *                      @OA\Property(property="finished", type="number", example=2),
     *              ),
     *              @OA\Property(property="message", type="string", example="Indicadores de evaluados obtenidos exitosamente."),
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
     *      )
     * )
     *
     * Getting indicators
     *
     * @return JsonResponse
     */
    public function getIndicators(): JsonResponse
    {
        //Condicional por si el usuario tiene asignado una organización
        $where = function ($query) {
            if (auth('sanctum')->user()->role == 'C') {
                $query->where('user_id', auth('sanctum')->user()->id);
            }
        };

        return response()->json([
            'data' => [
                'total' => PositionUser::whereNotIn('position_id', Position::where('status', -1)->pluck('id'))
                    ->whereIn('position_id', Position::where($where)->where('status', '<>', -1)->pluck('id'))
                    ->where('status', '<>', -1)->count(),
                'sent' => PositionUser::whereNotIn('position_id', Position::where('status', -1)->pluck('id'))
                    ->whereIn('position_id', Position::where($where)->where('status', '<>', -1)->pluck('id'))
                    ->where('status', 0)->count(),
                'in-process' => PositionUser::whereNotIn('position_id', Position::where('status', -1)->pluck('id'))
                    ->whereIn('position_id', Position::where($where)->where('status', '<>', -1)->pluck('id'))
                    ->where('status', 1)->count(),
                'finished' => PositionUser::whereNotIn('position_id', Position::where('status', -1)->pluck('id'))
                    ->whereIn('position_id', Position::where($where)->where('status', '<>', -1)->pluck('id'))
                    ->where('status', 2)->count()
            ],
            'message' => 'Indicadores de puestos obtenidos exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Search evaluateds
     * @OA\Get (
     *     path="/api/evaluateds/search",
     *     tags={"Evaluateds"},
     *     security={{"bearerAuth":{}}},
     *     summary="Buscar evaluados",
     *     description="Búsqueda de usuarios evaluados.",
     *     @OA\Parameter(
     *         name="position_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID de organización"
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
     *         description="Nombre o apellido de usuario"
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Estado del evaluado"
     *     ),
     *     @OA\Parameter(
     *         name="page",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Número de paginado"
     *     ),
     *     @OA\Parameter(
     *         name="per_page",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Registros a mostrar"
     *     ),
     *     @OA\Parameter(
     *         name="sort_by",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Campo de ordenamiento"
     *     ),
     *     @OA\Parameter(
     *         name="order",
     *         in="query",
     *         required=true,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Ascendente (asc) / Descendente (desc)"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Búsqueda de puestos realizada exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Puesto 002")
     *                   ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Búsqueda de puestos realizada exitosamente."),
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
     *      )
     * )
     *
     * Searching evaluateds
     *
     * @param SearchRequest $request
     * @return JsonResponse
     */
    public function search(SearchRequest $request): JsonResponse
    {
        $sort_by = $request->input('sort_by', 'id');
        $order = $request->input('order', 'asc');

        $evaluateds = PositionUser::with(['position', 'position.hierarchicalLevel', 'user'])
            // ->where(function ($query) use ($request) {
            //     if (auth('sanctum')->user()->organization_id) {
            //         $query->whereHas('position', function ($subquery) use ($request) {
            //             $subquery->where('organization_id', auth('sanctum')->user()->organization_id);
            //             if ($request->get('hierarchical_level_id')) {
            //                 $subquery->where('hierarchical_level_id', $request->get('hierarchical_level_id'));
            //             }
            //         });
            //     }
            //     if ($request->get('position_id')) {
            //         $query->where('position_id', $request->get('position_id'));
            //     }
            //     if ($request->get('text')) {
            //         $query->whereHas('user', function ($subquery) use ($request) {
            //             $subquery->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
            //             $subquery->orWhereRaw("unaccent(lastname) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
            //         });
            //     }
            //     if (auth('sanctum')->user()->role == 'C') {
            //         $query->whereHas('position', function ($subquery) use ($request) {
            //             $subquery->where('user_id', auth('sanctum')->user()->id);
            //         });
            //     }
            //     if ($request->get('status')) {
            //         $query->where('status', $request->get('status'));
            //     }
            // })
            ->whereNotIn('position_id', Position::where('status', 0)->pluck('id'));

        // Verificar si el campo de ordenamiento es de la relación `user`
        if (in_array($sort_by, ['name', 'lastname', 'email'])) {
            $evaluateds->orderByRaw("unaccent((SELECT users.{$sort_by} FROM users WHERE users.id = position_users.user_id)) $order");
        } elseif (in_array($sort_by, ['position'])) {
            $evaluateds->orderByRaw("unaccent((SELECT positions.name FROM positions WHERE positions.id = position_users.position_id)) $order");
        } elseif (in_array($sort_by, ['hierachical_level'])) {
            $evaluateds->orderByRaw("(SELECT positions.hierarchical_level_id FROM positions WHERE positions.id = position_users.position_id) $order");
        } else {
            $evaluateds->orderBy("position_users.$sort_by", $order);
        }

        // Paginación
        $evaluateds = $evaluateds->paginate($request->input('per_page', 50), ['*'], 'page', $request->input('page', 1));
        /*->orderBy($request->input('sort_by', 'id'), $request->input('order', 'asc'))
        ->paginate($request->input('per_page', 50), null, 'page', $request->input('page', 1));*/

        return response()->json([
            'data' => $evaluateds,
            'message' => 'Búsqueda de evaluados realizada exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Export found evaluateds
     * @OA\Get (
     *     path="/api/evaluateds/search/export",
     *     tags={"Evaluateds"},
     *     summary="Exportar evaluados encontrados",
     *     description="Exportación de evaluados encontrados.",
     *     @OA\Parameter(
     *         name="access_token",
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
     *         description="ID de organización"
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
     *         description="Nombre o apellido de usuario"
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Estado del evaluado"
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Descarga realizada exitosamente.",
     *         @OA\Header(
     *             header="Content-Disposition",
     *             description="attachment; filename=evaluateds.xlsx",
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
    public function exportSearch(Request $request): BinaryFileResponse|JsonResponse
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
                    return Excel::download(new SearchEvaluatedExport($request, $accessToken->tokenable), 'Evaluados_' . Carbon::now()->format('Y-m-d') . '.xlsx');
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
     * Get evaluated
     * @OA\Get (
     *     path="/api/evaluateds/{id}/get",
     *     tags={"Evaluateds"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtención de datos de evaluado",
     *     description="Obtención de datos de evaluado en puesto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID de evaluado"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Obtención de datos de evaluado realizado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                      property="data",
     *                      type="object",
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="lastname",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="document_type",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="document_number",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="additionals",
     *                          type="array",
     *                          description="IDs de campos adicionales",
     *                          @OA\Items(
     *                                  @OA\Property(
     *                                      property="id",
     *                                      type="number",
     *                                      example=1
     *                                  ),
     *                                  @OA\Property(
     *                                      property="name",
     *                                      type="string",
     *                                      example="Campo adicional 01"
     *                                  ),
     *                                  @OA\Property(
     *                                      property="value",
     *                                      type="string",
     *                                      example="P0001"
     *                                  ),
     *                          )
     *                      ),
     *                      @OA\Property(
     *                          property="evaluations",
     *                          type="array",
     *                          description="Estado de evaluaciones",
     *                          @OA\Items(
     *                                  @OA\Property(
     *                                      property="skill",
     *                                      type="string",
     *                                      example="Habilidad 1"
     *                                  ),
     *                                  @OA\Property(
     *                                      property="percentage",
     *                                      type="number",
     *                                      example=60
     *                                  ),
     *                                  @OA\Property(
     *                                      property="result",
     *                                      type="number",
     *                                      example=60
     *                                  ),
     *                                  @OA\Property(
     *                                      property="status",
     *                                      type="integer",
     *                                      example=1
     *                                  ),
     *                          )
     *                      ),
     *                 ),
     *              @OA\Property(property="message", type="string", example="Obtención de datos de puesto-usuario realizado exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El puesto-usuario no existe. ó El usuario no se encuentra activo",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El puesto-usuario no existe. ó El usuario no se encuentra activo."),
     *          )
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
     * Creating or updating user and adding to position
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function get(Request $request, int $id): JsonResponse
    {
        try {

            $position_user = PositionUser::with(['user', 'additionals', 'additionals.additional'])
                ->where('id', $id)->first();

            if ($position_user) {
                if (!$position_user->user->is_active) {
                    return response()->json([
                        'message' => 'El usuario se encuentra inactivo.'
                    ], Response::HTTP_BAD_REQUEST);
                }

                $additionals = [];
                foreach ($position_user->additionals as $key => $value) {
                    $additionals[] = [
                        'id' => $value['additional_id'],
                        'name' => $value->additional->name,
                        'value' => $value['value']
                    ];
                }

                $skills_all = PositionSkill::with(['skill'])->where('position_id', $position_user->position_id)->get();

                $skills_solved = PositionUserSkillResult::where('position_user_id', $position_user->id)
                    ->with(['skill'])
                    ->get()
                    ->pluck('result', 'skill.name')
                    ->toArray();

                $skills = [];
                foreach ($skills_all as $skill) {
                    $skills[] = [
                        'skill' => $skill->skill->name,
                        'percentage' => $skill->percentage,
                        'result' => isset($skills_solved[$skill->skill->name]) ? $skills_solved[$skill->skill->name] : 0,
                        'status' => isset($skills_solved[$skill->skill->name]) ? 1 : 0
                    ];
                }

                return response()->json([
                    'data' => [
                        'email' => $position_user->user->email,
                        'name' => $position_user->user->name,
                        'lastname' => $position_user->user->lastname,
                        'document_type' => $position_user->user->document_type,
                        'document_number' => $position_user->user->document_number,
                        'additionals' => $additionals,
                        'evaluations' => $skills,
                        'history' => []
                    ],
                    'message' => 'Obtención de datos de evaluado realizado exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'El puesto-usuario no existe.'
                ], Response::HTTP_BAD_REQUEST);
            }

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
