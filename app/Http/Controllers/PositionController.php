<?php

namespace App\Http\Controllers;

use App\Enums\PositionStatus;
use App\Enums\PositionType;
use App\Exports\SearchPositionExport;
use App\Http\Requests\SavePositionRequest;
use App\Http\Requests\SearchRequest;
use App\Http\Requests\SendRemindersRequest;
use App\Http\Requests\setPositionUserRequest;
use App\Http\Requests\SetSkillsRequest;
use App\Mail\InvitedPositionTemplate;
use App\Models\Behavior;
use App\Models\Position;
use App\Models\PositionAdditional;
use App\Models\PositionSkill;
use App\Models\PositionUser;
use App\Models\PositionUserAdditional;
use App\Models\PositionUserBehavior;
use App\Models\SkillBehavior;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\DB;

use Illuminate\Support\Str;
use Laravel\Prompts\Themes\Default\SearchPromptRenderer;
use Laravel\Sanctum\PersonalAccessToken;
use Maatwebsite\Excel\Facades\Excel;
use Ramsey\Uuid\Type\Integer;
use Symfony\Component\HttpFoundation\BinaryFileResponse;
 
class PositionController extends Controller
{
    public function index(Request $request)
    {
        //$data = DB::table('positions')->get();
        $positions = DB::table('positions')        
        ->join('organizations', 'organizations.id', '=', 'positions.organization_id')
        ->join('users', 'users.id', '=', 'positions.user_id')
        ->join('hierarchical_levels', 'hierarchical_levels.id', '=', 'positions.hierarchical_level_id')
        ->select('positions.*', 'organizations.name as organization_name',
        'users.name as user_name', 'hierarchical_levels.name as hierarchical_level_name',
        DB::raw('case when positions.status = 1 then \'Activo\' when positions.status = 2 then \'Cerrado\' else \'Inactivo\' end as status_label'))
        //->where('positions.id', $positionid)
        ->get()->toArray();  
    //     $result = [];
        foreach($positions as $position){
            $result[] = [
                "id" => $position->id,
                 "hierarchical_level_id" => $position->hierarchical_level_id,
                 "name" => $position->name,
                 "from"=> $position->from,
                 "to"=> $position->to,
                 "status"=> $position->status,
                 "user_id"=> $position->user_id,
                 "organization_id"=> $position->organization_id,
                 "type"=> $position->type,
                 "progress"=> 0,
                 "type_label"=> $position->type,
                "status_label"=> $position->status_label,
                "organization"=> [
                    "id"=> $position->organization_id,
                    "name"=>  $position->organization_name,
                ],
                "hierarchical_level"=> [
                    "id"=> $position->hierarchical_level_id,
                    "name"=> $position->hierarchical_level_name,
                    "level"=> 1
                ],
                "creator"=> [
                    "id"=> $position->user_id,
                    "name"=> $position->user_name,
                    "is_active_label"=> "Activo",
                    "document_type_label"=> null,
                    "role_label"=> null
                ]
            ];
        }
        $data[]=[
            "current_page"=> 1,
            "data"=> [$result],
            "first_page_url"=> "http://localhost:8000/api/positions/search?page=1",
            "from"=> 1,
            "last_page"=> 1,
            "last_page_url"=> "http://localhost:8000/api/positions/search?page=1",
            "links"=>  ["url" => null, "label" => "&laquo; Previous", "active" => false],
            "next_page_url"=> null,
            "path"=> "http://localhost:8000/api/positions/search",
            "per_page"=> 20,
            "prev_page_url"=> null,
            "to"=> 15,
            "total"=> 15
        ];
        return response()->json([
            'data' =>  $data,
            'message' => 'Listado de puestos obtenido exitosamente.'
        ], Response::HTTP_OK);
        
        // return response()->json([
        //     'data' =>  $data,
        //     'message' => 'Listado de puestos obtenido exitosamente.'
        // ], Response::HTTP_OK);
    }
    /**
     * Get position filter - list of creators
     * @OA\Get (
     *     path="/api/positions/filters/creators/get",
     *     tags={"Positions"},
     *     security={{"bearerAuth"=>{}}},
     *     summary="Filtros - Obtener lista de creadores",
     *     description="Filtros - Obtener listado de usuarios creadores de puestos.",
     *      @OA\Response(
     *          response=200,
     *          description="Listado de creadores de puestos obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Creador Usuario 1")
     *                   ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Listado de creadores de puestos obtenido exitosamente."),
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
     * Getting position filter - list of creators
     *
     * @return JsonResponse
     */
    public function getCreators(): JsonResponse
    {
        return response()->json([
            'data' => User::whereIn('id', Position::pluck('user_id'))
                ->where(function ($query) {
                    if (auth('sanctum')->user()->role == 'C') {
                        $query->where('id', auth('sanctum')->user()->id);
                    }
                })
                ->select(['id', 'name'])
                ->get(),
            'message' => 'Listado de creadores de puestos obtenido exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Get position filter - list of status
     * @OA\Get (
     *     path="/api/positions/filters/status/get",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Filtros - Obtener lista de estados",
     *     description="Filtros - Obtener listado de estados de puesto.",
     *      @OA\Response(
     *          response=200,
     *          description="Listado de estados de puesto obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Creador Usuario 2"),
     *                   ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Listado de estados de puesto obtenido exitosamente."),
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
     * Getting position filter - list of status
     *
     * @return JsonResponse
     */
    public function getStatus(): JsonResponse
    {
        
        return response()->json([
            'data' => PositionStatus::COLLECTION,
            'message' => 'Listado de estados de puesto obtenido exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Get position filter - list of types
     * @OA\Get (
     *     path="/api/positions/filters/types/get",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Filtros - Obtener lista de tipos",
     *     description="Filtros - Obtener listado de tipos de puesto.",
     *      @OA\Response(
     *          response=200,
     *          description="Listado de tipos de puesto obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="string", example="fit"),
     *                      @OA\Property(property="name", type="string", example="Fit del puesto"),
     *                   ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Listado de tipos de puesto obtenido exitosamente."),
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
     * Getting position filter - list of status
     *
     * @return JsonResponse
     */
    public function getTypes(): JsonResponse
    {
        return response()->json([
            'data' => PositionType::COLLECTION,
            'message' => 'Listado de tipos de puesto obtenido exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Get indicators
     * @OA\Get (
     *     path="/api/positions/indicators/get",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener indicadores",
     *     description="Obtener indicadores de puestos.",
     *      @OA\Response(
     *          response=200,
     *          description="Indicadores de puestos obtenidos exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="total", type="number", example=20),
     *                      @OA\Property(property="open", type="number", example=10),
     *                      @OA\Property(property="closed", type="number", example=8),
     *                      @OA\Property(property="inactive", type="number", example=2),
     *                      @OA\Property(property="users_solved", type="number", example=150)
     *              ),
     *              @OA\Property(property="message", type="string", example="Indicadores de puestos obtenidos exitosamente."),
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
                'total' => Position::where('status', '<>', -1)->where($where)->count(),
                'open' => Position::where('status', 1)->where($where)->count(),
                'closed' => Position::where('status', 2)->where($where)->count(),
                'inactive' => Position::where('status', 0)->where($where)->count(),
                'users_solved' => PositionUser::whereNotIn('position_id', Position::where('status', -1)->pluck('id'))
                    ->whereIn('position_id', Position::where($where)->where('status', '<>', -1)->pluck('id'))
                    ->where('status', 2)->count(),
            ],
            'message' => 'Indicadores de puestos obtenidos exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Search positions
     * @OA\Get (
     *     path="/api/positions/search",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Buscar puestos",
     *     description="Búsqueda de puestos.",
     *     @OA\Parameter(
     *         name="organization_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID de organización"
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del creador"
     *     ),
     *     @OA\Parameter(
     *         name="text",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Nombre de puesto"
     *     ),
     *     @OA\Parameter(
     *         name="from",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="date"
     *         ),
     *         description="Fecha inicial - desde"
     *     ),
     *     @OA\Parameter(
     *         name="to",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="date"
     *         ),
     *         description="Fecha final - hasta"
     *     ),
     *         @OA\Parameter(
     *         name="hierarchical_level_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del nivel jerárquico"
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Estado del puesto"
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
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=20),
     *                      @OA\Property(property="hierarchical_level_id", type="number", example=1),
     *                      @OA\Property(property="name", type="string", example="Recepcionista 1"),
     *                      @OA\Property(property="from", type="date", example="2024-01-01"),
     *                      @OA\Property(property="to", type="date", example="2024-03-31"),
     *                      @OA\Property(property="status", type="number", example=1),
     *                      @OA\Property(property="status_label", type="number", example="Activo"),
     *                      @OA\Property(property="organization_id", type="number", example=1),
     *                      @OA\Property(property="progress", type="number", example=100),
     *                      @OA\Property(property="organization", type="object",
     *                          @OA\Property(property="id", type="number", example=1),
     *                          @OA\Property(property="name", type="number", example="Empresa 1"),
     *                      ),
     *                      @OA\Property(property="hierarchical_level", type="object",
     *                          @OA\Property(property="id", type="number", example=1),
     *                          @OA\Property(property="name", type="number", example="Nivel jerárquico 1"),
     *                      ),
     *                      @OA\Property(property="creator", type="object",
     *                          @OA\Property(property="id", type="number", example=1),
     *                          @OA\Property(property="name", type="number", example="Usuario 001"),
     *                      )
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
     * Searching positions
     *
     * @param SearchRequest $request
     * @return JsonResponse
     */
    public function search(Request $request): JsonResponse
    {
        ////$request->validated();
        // return $request
        // $where = function ($query) use ($request) {
        //     if ($request->has('organization_id')) {
        //         $query->where('organization_id', $request->input('organization_id'));
        //     }
        //     if ($request->has('user_id')) {
        //         $query->where('user_id', $request->input('user_id'));
        //     }
        //     if (auth('sanctum')->user()->role == 'C') {
        //         $query->where('user_id', auth('sanctum')->user()->id);
        //     }
        //     if ($request->has('text')) {
        //         $query->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);

        //     }
        //     if ($request->has('from') && $request->has('from')) {
        //         $from = Carbon::parse($request->input('from'))->format('Y-m-d');
        //         $to = Carbon::parse($request->input('to'))->format('Y-m-d');

        //         $query->whereBetween('from', [$from, $to]);
        //         $query->orwhereBetween('to', [$from, $to]);
        //     } else {
        //         if ($request->has('from')) {
        //             $from = Carbon::parse($request->input('from'))->format('Y-m-d');
        //             $query->where(function ($subquery) use ($from) {
        //                 $subquery->where('from', '>=', $from);
        //                 $subquery->orWhere('to', '>=', $from);
        //                 return $subquery;
        //             });
        //         }
        //         if ($request->has('to')) {
        //             $to = Carbon::parse($request->input('to'))->addDay()->format('Y-m-d');
        //             $query->where(function ($subquery) use ($to) {
        //                 $subquery->where('from', '<', $to);
        //                 $subquery->orWhere('to', '<', $to);
        //                 return $subquery;
        //             });
        //         }
        //     }
        //     if ($request->has('hierarchical_level_id')) {
        //         $query->where('hierarchical_level_id', $request->input('hierarchical_level_id'));
        //     }
        //     $query->where('status', '<>', -1);
        //     if ($request->has('status')) {
        //         $query->where('status', $request->input('status'));
        //     }
        //     return $query;
        // };

        // //Consulta con paginación y ordenamiento
        // $positions = Position::with(['organization', 'hierarchicalLevel', 'creator'])
        //     ->selectRaw("*, 0 AS progress")
        //     ->where($where)
        //     ->orderBy($request->input('sort_by', 'id'), $request->input('order', 'asc'))
        //    ->paginate($request->input('per_page', 50), null, 'page', $request->input('page', 1));
        $positions = DB::table('positions')        
        ->join('organizations', 'organizations.id', '=', 'positions.organization_id')
        ->join('users', 'users.id', '=', 'positions.user_id')
        ->join('hierarchical_levels', 'hierarchical_levels.id', '=', 'positions.hierarchical_level_id')
        ->select('positions.*', 'organizations.name as organization_name',
        'users.name as user_name', 'hierarchical_levels.name as hierarchical_level_name',
        DB::raw('case when positions.status = 1 then \'Activo\' when positions.status = 2 then \'Cerrado\' else \'Inactivo\' end as status_label'))
        //->where('positions.id', $positionid)
        ->get()->toArray();  
    //     $result = [];
        foreach($positions as $position){
            $result[] = [
                "id" => $position->id,
                 "hierarchical_level_id" => $position->hierarchical_level_id,
                 "name" => $position->name,
                 "from"=> $position->from,
                 "to"=> $position->to,
                 "status"=> $position->status,
                 "user_id"=> $position->user_id,
                 "organization_id"=> $position->organization_id,
                 "type"=> $position->type,
                 "progress"=> 0,
                 "type_label"=> $position->type,
                "status_label"=> $position->status_label,
                "organization"=> [
                    "id"=> $position->organization_id,
                    "name"=>  $position->organization_name,
                ],
                "hierarchical_level"=> [
                    "id"=> $position->hierarchical_level_id,
                    "name"=> $position->hierarchical_level_name,
                    "level"=> 1
                ],
                "creator"=> [
                    "id"=> $position->user_id,
                    "name"=> $position->user_name,
                    "is_active_label"=> "Activo",
                    "document_type_label"=> null,
                    "role_label"=> null
                ]
            ];
        }
        $data[]=[
            "current_page"=> 1,
            "data"=> [$result],
            "first_page_url"=> "http://localhost:8000/api/positions/search?page=1",
            "from"=> 1,
            "last_page"=> 1,
            "last_page_url"=> "http://localhost:8000/api/positions/search?page=1",
            "links"=>  ["url" => null, "label" => "&laquo; Previous", "active" => false],
            "next_page_url"=> null,
            "path"=> "http://localhost:8000/api/positions/search",
            "per_page"=> 20,
            "prev_page_url"=> null,
            "to"=> 15,
            "total"=> 15
        ];
        return response()->json([
            'data' => $data,
            'message' => 'Búsqueda de puestos realizada exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Export found positions
     * @OA\Get (
     *     path="/api/positions/search/export",
     *     tags={"Positions"},
     *     summary="Exportar puestos encontrados",
     *     description="Exportación de puestos encontrados.",
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
     *         name="organization_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID de organización"
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del creador"
     *     ),
     *     @OA\Parameter(
     *         name="text",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Nombre de proceso"
     *     ),
     *     @OA\Parameter(
     *         name="from",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="date"
     *         ),
     *         description="Fecha inicial - desde"
     *     ),
     *     @OA\Parameter(
     *         name="to",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="date"
     *         ),
     *         description="Fecha final - hasta"
     *     ),
     *         @OA\Parameter(
     *         name="hierarchical_level_id",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del nivel jerárquico"
     *     ),
     *     @OA\Parameter(
     *         name="status",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="Estado del puesto"
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Descarga realizada exitosamente.",
     *         @OA\Header(
     *             header="Content-Disposition",
     *             description="attachment; filename=positions.xlsx",
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
                    return Excel::download(new SearchPositionExport($request, $accessToken->tokenable), 'Procesos_' . Carbon::now()->format('Y-m-d') . '.xlsx');
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
     * Create position
     * @OA\Post (
     *     path="/api/positions/create",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Crear puesto",
     *     description="Creación de puesto.",
     *         @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="hierarchical_level_id",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="type",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="from",
     *                          type="date"
     *                      ),
     *                      @OA\Property(
     *                          property="to",
     *                          type="date"
     *                      ),
     *                      @OA\Property(
     *                          property="status",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="additionals",
     *                          type="array",
     *                          description="IDs de campos adicionales",
     *                          @OA\Items(
     *                              type="number",
     *                          )
     *                      ),
     *                 ),
     *                 example={
     *                     "hierarchical_level_id":"1",
     *                     "name":"Recepcionista",
     *                     "type":"fit",
     *                     "from":"2024-01-01",
     *                     "to":"2024-03-31",
     *                     "status":"1",
     *                     "additionals":  {1,2,3}
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Puesto creado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Puesto 1"),
     *                      @OA\Property(property="type", type="string", example="fit|potential"),
     *                      @OA\Property(property="from", type="date", example="2024-01-01"),
     *                      @OA\Property(property="to", type="date", example="2024-03-31"),
     *                      @OA\Property(property="status", type="number", example=1),
     *                      @OA\Property(property="hierarchical_level_id", type="number", example=1),
     *                      @OA\Property(property="hierarchical_level", type="object",
     *                          @OA\Property(property="id", type="number", example=1),
     *                          @OA\Property(property="name", type="string", example="Nivel jerárquico 1"),
     *                      ),
     *                      @OA\Property(property="organization_id", type="number", example=3),
     *                      @OA\Property(property="organization", type="object",
     *                          @OA\Property(property="id", type="number", example=5),
     *                          @OA\Property(property="name", type="string", example="Empresa 13"),
     *                      ),
     *                      @OA\Property(
     *                          property="additionals",
     *                          type="array",
     *                          @OA\Items(
     *                              type="number",
     *                              example=123
     *                          ),
     *                      ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Puesto creado exitosamente."),
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
     * Creating position
     *
     * @param SavePositionRequest $request
     * @return JsonResponse
     */
    public function create(SavePositionRequest $request): JsonResponse
    {
        //$request->validated();
        //Creando el puesto y obteniendo la data
        $request->merge([
            'user_id' => auth('sanctum')->user()->id,
            'organization_id' => auth('sanctum')->user()->organization_id,
        ]);
        $position = Position::create($request->all())->id;

        if ($request->has('additionals')) {
            if (is_array($request->get('additionals'))) {
                foreach ($request->get('additionals') as $key => $value) {
                    PositionAdditional::insert(['position_id' => $position, 'additional_id' => $value, 'created_at' => now()]);
                }
            }
        }

        $position = Position::with(['hierarchicalLevel', 'organization', 'additionals'])->where('id', $position)->first();

        if ($position) {
            return response()->json([
                'data' => [
                    'id' => $position->id,
                    'name' => $position->name,
                    'type' => $position->type,
                    'from' => $position->from,
                    'to' => $position->to,
                    'status' => $position->status,
                    'hierarchical_level_id' => $position->hierarchical_level_id,
                    'hierarchical_level' => $position->hierarchicalLevel ? ['id' => $position->hierarchicalLevel->id, 'name' => $position->hierarchicalLevel->name] : null,
                    'organization_id' => $position->organization_id,
                    'organization' => $position->organization ? ['id' => $position->organization->id, 'name' => $position->organization->name] : null,
                    'additionals' => $position->additionals ? $position->additionals->pluck('additional_id') : [],
                ],
                'message' => 'Puesto creado exitosamente.'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'No se pudo completar la solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get position
     * @OA\Get (
     *     path="/api/positions/{id}/get",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener puesto",
     *     description="Obtener datos de puesto.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Datos de puesto obtenidos exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Puesto 1"),
     *                      @OA\Property(property="type", type="string", example="fit"),
     *                      @OA\Property(property="from", type="date", example="2024-01-01"),
     *                      @OA\Property(property="to", type="date", example="2024-03-31"),
     *                      @OA\Property(property="status", type="number", example=1),
     *                      @OA\Property(property="hierarchical_level_id", type="number", example=1),
     *                      @OA\Property(property="hierarchical_level", type="object",
     *                          @OA\Property(property="id", type="number", example=1),
     *                          @OA\Property(property="name", type="string", example="Nivel jerárquico 1"),
     *                      ),
     *                      @OA\Property(property="organization_id", type="number", example=3),
     *                      @OA\Property(property="organization", type="object",
     *                          @OA\Property(property="id", type="number", example=5),
     *                          @OA\Property(property="name", type="string", example="Empresa 13"),
     *                      ),
     *                      @OA\Property(
     *                          property="additionals",
     *                          type="array",
     *                          @OA\Items(
     *                              type="number",
     *                              example=123
     *                          ),
     *                      ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Datos de puesto obtenidos exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El puesto no existe",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El puesto no existe."),
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
     *          description="Tu email no se encuentra verificado ó No tienes permiso para ver este puesto",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Tu email no se encuentra verificado. ó No tienes permiso para ver este puesto."),
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
     * Getting position data
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function get(Request $request, int $id): JsonResponse
    {
        try {
            $position = Position::with(['hierarchicalLevel', 'organization', 'additionals'])->where('id', $id)->first();

            if (auth('sanctum')->user()->role == 'C' && $position->user_id != auth('sanctum')->user()->id) {
                return response()->json([
                    'message' => 'No tienes permiso para ver este puesto.'
                ], Response::HTTP_FORBIDDEN);
            }

            if ($position) {
                return response()->json([
                    'data' => [
                        'id' => $position->id,
                        'name' => $position->name,
                        'type' => $position->type,
                        'type_label' => $position->type_label,
                        'from' => $position->from,
                        'to' => $position->to,
                        'status' => $position->status,
                        'hierarchical_level_id' => $position->hierarchical_level_id,
                        'hierarchical_level' => $position->hierarchicalLevel ? ['id' => $position->hierarchicalLevel->id, 'name' => $position->hierarchicalLevel->name] : null,
                        'organization_id' => $position->organization_id,
                        'organization' => $position->organization ? ['id' => $position->organization->id, 'name' => $position->organization->name] : null,
                        'additionals' => $position->additionals ? $position->additionals->pluck('additional_id') : null,
                    ],
                    'message' => 'Datos de puesto obtenidos exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'El puesto no existe.'
                ], Response::HTTP_BAD_REQUEST);
            }

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update position
     * @OA\Put (
     *     path="/api/positions/{id}/update",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Actualizar puesto",
     *     description="Actualización de puesto.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="hierarchical_level_id",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="type",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="from",
     *                          type="date"
     *                      ),
     *                      @OA\Property(
     *                          property="to",
     *                          type="date"
     *                      ),
     *                      @OA\Property(
     *                          property="status",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="additionals",
     *                          type="array",
     *                          description="IDs de campos adicionales",
     *                          @OA\Items(
     *                              type="number",
     *                          )
     *                      ),
     *                 ),
     *                 example={
     *                     "hierarchical_level_id": 1,
     *                     "name":"Recepcionista",
     *                     "type":"fit",
     *                     "from":"2024-01-01",
     *                     "to":"2024-03-31",
     *                     "status": 1,
     *                     "additionals":  {1,2,3}
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Puesto actualizado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Puesto 1"),
     *                      @OA\Property(property="type", type="string", example="fit|potential"),
     *                      @OA\Property(property="from", type="date", example="2024-01-01"),
     *                      @OA\Property(property="to", type="date", example="2024-03-31"),
     *                      @OA\Property(property="status", type="number", example=1),
     *                      @OA\Property(property="hierarchical_level_id", type="number", example=1),
     *                      @OA\Property(property="hierarchical_level", type="object",
     *                          @OA\Property(property="id", type="number", example=1),
     *                          @OA\Property(property="name", type="string", example="Nivel jerárquico 1"),
     *                      ),
     *                      @OA\Property(property="organization_id", type="number", example=3),
     *                      @OA\Property(property="organization", type="object",
     *                          @OA\Property(property="id", type="number", example=5),
     *                          @OA\Property(property="name", type="string", example="Empresa 13"),
     *                      ),
     *                      @OA\Property(
     *                          property="additionals",
     *                          type="array",
     *                          @OA\Items(
     *                              type="number",
     *                              example=123
     *                          ),
     *                      ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Puesto actualizado exitosamente."),
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
     * Updating position
     *
     * @param SavePositionRequest $request
     * @param Integer $id
     * @return JsonResponse
     */
    public function update(SavePositionRequest $request, int $id): JsonResponse
    {
        $position = Position::where('id', $id)->first();
        $position->update($request->validated());

        //Borrando campos adicionales de posición
        PositionAdditional::where('position_id', $id)->delete();

        if ($request->has('additionals')) {
            if (is_array($request->get('additionals'))) {
                foreach ($request->get('additionals') as $key => $value) {
                    PositionAdditional::insert(['position_id' => $id, 'additional_id' => $value, 'created_at' => now(), 'updated_at' => now()]);
                }
            }
        }

        $position = Position::with(['hierarchicalLevel', 'organization', 'additionals'])->where('id', $id)->first();

        if ($position) {
            return response()->json([
                'data' => [
                    'id' => $position->id,
                    'name' => $position->name,
                    'type' => $position->type,
                    'from' => $position->from,
                    'to' => $position->to,
                    'status' => $position->status,
                    'hierarchical_level_id' => $position->hierarchical_level_id,
                    'hierarchical_level' => $position->hierarchicalLevel ? ['id' => $position->hierarchicalLevel->id, 'name' => $position->hierarchicalLevel->name] : null,
                    'organization_id' => $position->organization_id,
                    'organization' => $position->organization ? ['id' => $position->organization->id, 'name' => $position->organization->name] : null,
                    'additionals' => $position->additionals ? $position->additionals->pluck('additional_id') : null,
                ],
                'message' => 'Puesto actualizado exitosamente.'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'No se pudo completar la solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete position
     * @OA\Delete (
     *     path="/api/positions/{id}/delete",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Eliminar puesto",
     *     description="Eliminación de puesto.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Puesto eliminado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Puesto eliminado exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El puesto no existe",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El puesto no existe."),
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
     * Deleting position
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function delete(Request $request, int $id): JsonResponse
    {
        try {
            $position = Position::find($id);

            if ($position) {
                $position->delete();
                return response()->json([
                    'message' => 'Puesto eliminado exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'El puesto no existe.'
                ], Response::HTTP_BAD_REQUEST);
            }
        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Set skills by position
     * @OA\Post (
     *     path="/api/positions/{id}/skills/set",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Definición de habilidades por puesto",
     *     description="Definición de habilidades por puesto.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                     property="skills",
     *                     type="array",
     *                     description="IDs de campos adicionales",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="number", example=1),
     *                         @OA\Property(property="percentage", type="number", example=100),
     *                     )
     *                 ),
     *                 example={
     *                     "skills":  {
     *                          {"id": 1, "percentage":40},
     *                          {"id": 2, "percentage":60},
     *                     }
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Habilidades para puesto definidas exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(
     *                     property="skills",
     *                     type="array",
     *                     description="IDs de skills y su porcentaje",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="number", example=1),
     *                         @OA\Property(property="percentage", type="number", example=100),
     *                     )
     *                 ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Habilidades para puesto definidas exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El puesto o los skills no existen ó Los pesos no suman 100%",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El puesto o los skills no existen. ó Los pesos no suman 100%."),
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
     * Setting skills by position
     *
     * @param SetSkillsRequest $request
     * @param Integer $id
     * @return JsonResponse
     */
    public function setSkills(SetSkillsRequest $request, int $id): JsonResponse
    {
        try {
            $position = Position::where('id', $id)->first();

            //$data = $request->validated();

            if ($position) {

                //Borrando y creando nuevos registros de habilidades por puesto
                PositionSkill::where('position_id', $id)->delete();
                $position_skills = [];
                $sumatoria = 0;
                foreach ($data['skills'] as $key => $value) {
                    $position_skills[] = [
                        'position_id' => $id,
                        'skill_id' => $value['id'],
                        'percentage' => $value['percentage']
                    ];
                    $sumatoria += $value['percentage'];
                }

                if ($sumatoria === 100) {
                    PositionSkill::insert($position_skills);
                    $position = Position::with(['skills'])->where('id', $id)->first();
                    return response()->json([
                        'data' => $position->skills->toArray(),
                        'message' => 'Habilidades para puesto definidas exitosamente.'
                    ], Response::HTTP_OK);
                } else {
                    return response()->json([
                        'message' => 'Los pesos no suman 100%.'
                    ], Response::HTTP_BAD_REQUEST);
                }
            } else {
                return response()->json([
                    'message' => 'El puesto no existe.'
                ], Response::HTTP_BAD_REQUEST);
            }

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get skills by position
     * @OA\Get (
     *     path="/api/positions/{id}/skills/get",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener habilidades por puesto",
     *     description="Obtener habilidades por puesto.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Habilidades para puesto obtenidas exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(
     *                     property="skills",
     *                     type="array",
     *                     description="IDs de campos adicionales",
     *                     @OA\Items(
     *                         type="object",
     *                         @OA\Property(property="id", type="number", example=1),
     *                         @OA\Property(property="percentage", type="number", example=100),
     *                     )
     *                 ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Habilidades para puesto obtenidas exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El puesto o los skills no existen ó Los pesos no suman 100%",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El puesto no existe."),
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
     * Getting skills by position
     *
     * @param Request $request
     * @param Integer $id
     * @return JsonResponse
     */
    public function getSkills(Request $request, int $id): JsonResponse
    {
        try {
            $position = Position::with(['skills'])->where('id', $id)->first();

            $skills = [];
            if ($position->skills) {
                foreach ($position->skills as $key => $value) {
                    $skills[] = ['id' => $value->skill_id, 'percentage' => $value->percentage];
                }
            }

            if ($position) {
                return response()->json([
                    'data' => $skills,
                    'message' => 'Habilidades para puesto obtenidas exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'El puesto no existe.'
                ], Response::HTTP_BAD_REQUEST);
            }

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get user of position
     * @OA\Get (
     *     path="/api/positions/{id}/users/search",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtención de datos de usuario en posición",
     *     description="Obtención de datos de usuario asignado en posición",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto-usuario"
     *     ),
     *     @OA\Parameter(
     *         name="text",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Nombre, apellido o email"
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
     *          description="Búsqueda de usuarios asignados a puesto realizada exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=20),
     *                      @OA\Property(property="name", type="string", example="User"),
     *                      @OA\Property(property="lastname", type="string", example="Test"),
     *                      @OA\Property(property="email", type="string", example="user@test.com"),
     *                      @OA\Property(property="current", type="number", example=1),
     *                      @OA\Property(property="total", type="number", example=5)
     *              ),
     *              @OA\Property(property="message", type="string", example="Búsqueda de usuarios asignados a puesto realizada exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El puesto no existe.",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El puesto no existe."),
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
     * @param SearchRequest $request
     * @param Integer $id
     * @return JsonResponse
     */
    public function searchUsers(Request $request, int $id)
    {
        try {
           
            // //$request->validated();
            //$position = Position::where('id', $id)->first();
            $position = DB::table('positions')->find($id);
            if ($position) {
                $users=DB::table('position_users')
                //->select('name','email','result','process','deadline_at','status')
                ->join('users', 'users.id', '=', 'position_users.user_id')
                ->where('position_users.position_id', $id)
                ->get(); 
                $data=[];
                foreach ($users as $user) {
                    $data[]=[
                        'id'=>$user->id,
                        'name'=>$user->name,
                        'email'=>$user->email,
                        'lastname'=>$user->lastname,
                        'document_type'=>$user->document_type,
                        'document_number'=>$user->document_number,
                        'result'=>$user->result,
                        'process'=>$position->name,
                        'deadline_at'=>'',
                        'status'=>$user->status ,
                        'progress'=>0,
                        "deadline_color"=>"000334"
                    ];  
                }
                //return $data;
                // Consulta con paginación y ordenamiento
                //$users = DB::table('position_users');
                //$users = PositionUser::with(['user', 'position', 'position.skills']);
                    //->selectRaw("*, 0 AS current, 0 AS total")
                    // ->where('position_id', $id)
                    // ->whereHas('user', function ($query) use ($request) {
                    //     if ($request->has('text')) {
                    //         $query->where('name', 'LIKE', '%' . $request->input('text') . '%');
                    //         $query->orWhere('lastname', 'LIKE', '%' . $request->input('text') . '%');
                    //         $query->orWhere('email', 'LIKE', '%' . $request->input('text') . '%');
                    //     }
                    // });
                    // ->orderBy($request->input('sort_by', 'id'), $request->input('order', 'asc'))
                    // ->paginate($request->input('per_page', 50), null, 'page', $request->input('page', 1));
                // $result =[
                //     'id' => $user[0]->id,
                //     'name'=>$user[0]->name,
                //     'email'=>$user[0]->email,
                //     'lastname' => $user[0]->lastname,
                //     'document_type' => $user[0]->document_type,
                //     'document_number' => $user[0]->document_number,
                //     'result'=>$user[0]->result,
                //     'process'=>$position->name,
                //     'deadline_at'=>'',
                //     'status'=>$user[0]->status ,
                //     'progress'=>0,
                //     "deadline_color"=>"000334"
                // ];
                return response()->json([
                    'data' => $data,
                    'message' => 'Búsqueda de usuarios asignados a puesto realizada exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'El puesto no existe.'
                ], Response::HTTP_BAD_REQUEST);
            }

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Create or update user and add to position
     * @OA\Post (
     *     path="/api/positions/{id}/users/set-add",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Creación o actualización de usuario y agregado a puesto",
     *     description="Creación o actualización de usuario y agregado a evaluaciones del puesto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
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
     *                              type="number"
     *                          )
     *                      ),
     *                 ),
     *                 example={
     *                     "email":"user@test.com",
     *                     "name":"User",
     *                     "lastname":"Test",
     *                     "document_type":"DNI",
     *                     "document_number":"44552233",
     *                     "additionals": {
     *                          {"id": 1, "value": "E00001"},
     *                          {"id": 2, "value": "F44553322"}
     *                     }
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Creación o actualización de usuario y agregado a evaluaciones realizado exitosamente",
     *          @OA\JsonContent(
     *                  @OA\Property(
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
     *                                      property="value",
     *                                      type="string",
     *                                      example="P0001"
     *                                  ),
     *                          )
     *                      ),
     *                 ),
     *              @OA\Property(property="message", type="string", example="Creación o actualización de usuario y agregado a evaluaciones realizado exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El puesto no existe",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El puesto no existe. ó El usuario no se encuentra activo."),
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
     * @param setPositionUserRequest $request
     * @param Integer $id
     * @return JsonResponse
     */
    public function setAddUser(Request $request, int $id): JsonResponse
    {
        try {
            $position = Position::with('skills')->where('id', $id)->first();

            //$data = $request->validated();

            if ($position) {
                $user = User::where('email', $data['email'])->first();
                
                if ($user) {
                    if (!$user->is_active) {
                        return response()->json([
                            'message' => 'El usuario se encuentra inactivo.'
                        ], Response::HTTP_BAD_REQUEST);
                    }
                } else {
                    $user = new User();
                    $user->email_verified_at = Carbon::now();
                    $user->role = 'U';
                    $user->email = $request->input('email');
                    $user->name = $request->input('name');
                    $user->lastname = $request->input('lastname');
                    $user->document_type = $request->input('document_type');
                    $user->document_number = $request->input('document_number');
                    $user->password = Hash::make(Str::random(8));
                    $user->save();
                }

                $position_user_id = null;
                $position_user = PositionUser::where('position_id', $position->id)
                    ->where('user_id', $user->id)
                    ->first();
                if ($position_user) {
                    $position_user_id = $position_user->id;
                    if ($position_user->status == -1) {
                        $position_user->status = 0;
                        $position_user->created_at = now();
                        $position_user->save();
                    }
                } else {
                    $position_user_id = PositionUser::insertGetId([
                        'position_id' => $position->id,
                        'user_id' => $user->id,
                        'created_at' => now()
                    ]);
                }

                PositionUserAdditional::where('position_user_id', $position_user_id)->delete();
                $additionals = [];
                foreach ($data['additionals'] as $key => $value) {
                    PositionUserAdditional::insert([
                        'position_user_id' => $position_user_id,
                        'additional_id' => $value['id'],
                        'value' => $value['value']
                    ]);
                    $additionals[] = [
                        'id' => $value['id'],
                        'value' => $value['value']
                    ];
                }

                //Validating if user has similar answers from previous positions
                $position_user_behaviors_prev = PositionUserBehavior::with(['position_user'])
                    ->whereIn(
                        'behavior_id',
                        SkillBehavior::with(['behavior'])
                            ->whereHas('behavior', function ($query) use ($position) {
                                $query->where('level', ($position->type == 'fit') ? $position->hierarchicalLevel->level : $position->hierarchicalLevel->level + 1);
                            })
                            ->whereIn('skill_id', $position->skills->pluck('skill_id'))
                            ->pluck('id')
                    )
                    ->where('updated_at', '>=', Carbon::now()->subMonths(6))
                    ->whereIn('position_user_id', PositionUser::where('user_id', $user->id)->pluck('id'))
                    ->pluck('is_present', 'behavior_id');

                if ($position_user_behaviors_prev) {
                    //Fetching previous behaviors and adding to new position as answers
                    foreach ($position_user_behaviors_prev as $behavior_id => $is_present) {
                        PositionUserBehavior::create([
                            'position_user_id' => $position_user->id,
                            'behavior_id' => $behavior_id,
                            'is_present' => $is_present,
                            'created_at' => now(),
                            'updated_at' => null
                        ]);
                    }
                }

                //Enviando correo de invitación a usuario
                Mail::to($user->email)->send(new InvitedPositionTemplate($user, $position));

                return response()->json([
                    'data' => [
                        'email' => $user->email,
                        'name' => $user->name,
                        'lastname' => $user->lastname,
                        'document_type' => $user->document_type,
                        'document_number' => $user->document_number,
                        'additionals' => $additionals
                    ],
                    'message' => 'Creación o actualización de usuario y agregado a evaluaciones realizado exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'El puesto no existe.'
                ], Response::HTTP_BAD_REQUEST);
            }

        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Send email to user to reminder his pending evaluation
     * @OA\Post (
     *     path="/api/positions/{id}/users/send-reminders",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Enviar recordatorios a usuario",
     *     description="Enviar recordatorios a usuario",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                  @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="position_user_id",
     *                          type="array",
     *                          description="IDs de evaluados",
     *                          @OA\Items(
     *                              type="number"
     *                          )
     *                      ),
     *                 ),
     *                 example={
     *                     "position_user_id": {1,2,3}
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Recordatorio enviado exitosamente.",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Recordatorio enviado exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El puesto no existe",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El puesto no existe. ó El usuario no se encuentra activo."),
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
     * Sending reminders to user
     *
     * @param SendRemindersRequest $request
     * @param Integer $id
     * @return JsonResponse
     */
    public function sendReminders(Request $request, int $id)
    {
        try { 
            // return '0';
            $position = Position::find($id);

            //$data = //$request->validated();
            //print_r($position);
            if ($position) {
                $position_users = PositionUser::with(['user'])
                    //->whereIn('id', $data['position_user_id'])
                    ->whereIn('id', 2)
                    ->get();
                //print_r($position_users);
                foreach ($position_users as $position_user) {
                    //Enviando correo de invitación a usuario
                    Mail::to($position_user->user->email)->send(new InvitedPositionTemplate($position_user->user, $position, 'Recordatorio: Has sido invitado a un proceso'));
                }

                return response()->json([
                    'message' => 'Recordatorio enviado exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'El puesto no existe.'
                ], Response::HTTP_BAD_REQUEST);
            }

        } catch (Exception $ex) {
            // return response()->json([
            //     'data' => $ex->getMessage(),
            //     'message' => 'No se pudo completar su solicitud.'
            // ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get user of position
     * @OA\Get (
     *     path="/api/positions/users/{id}/get",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtención de datos de usuario en puesto",
     *     description="Obtención de datos de usuario asignado en puesto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto-usuario"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Obtención de datos de puesto-usuario realizado exitosamente",
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
     *                                      property="value",
     *                                      type="string",
     *                                      example="P0001"
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
    public function getUser(Request $request, int $id): JsonResponse
    {
        try {

            $position_user = PositionUser::with(['user', 'additionals'])
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
                        'value' => $value['value']
                    ];
                }

                return response()->json([
                    'data' => [
                        'email' => $position_user->user->email,
                        'name' => $position_user->user->name,
                        'lastname' => $position_user->user->lastname,
                        'document_type' => $position_user->user->document_type,
                        'document_number' => $position_user->user->document_number,
                        'additionals' => $additionals
                    ],
                    'message' => 'Obtención de datos de puesto-usuario realizado exitosamente.'
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

    /**
     * Remove user of position
     * @OA\Delete (
     *     path="/api/positions/users/{id}/remove",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Eliminación de usuario en posición",
     *     description="Eliminación de usuario asignado en posición",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto-usuario"
     *     ),
     *     @OA\Response(
     *          response=200,
     *          description="Eliminación de puesto-usuario realizado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Eliminación de puesto-usuario realizado exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El puesto-usuario no existe.",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El puesto-usuario no existe."),
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
     * Removing position-user
     *
     * @param Request $request
     * @param Integer $id
     * @return JsonResponse
     */
    public function removeUser(Request $request, int $id): JsonResponse
    {
        try {

            $position_user = PositionUser::where('id', $id)->first();

            if ($position_user) {
                PositionUserBehavior::where('position_user_id', $position_user->id)->delete();
                PositionUserAdditional::where('position_user_id', $position_user->id)->delete();
                $position_user->delete();

                return response()->json([
                    'message' => 'Eliminación de puesto-usuario realizado exitosamente.'
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

    /**
     * Check if user exists in position
     * @OA\Get (
     *     path="/api/positions/{id}/users/{user_id}/check",
     *     tags={"Positions"},
     *     security={{"bearerAuth":{}}},
     *     summary="Validación de usuario añadido en puesto",
     *     description="Validación de usuario añadido en puesto",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del puesto"
     *     ),
     *     @OA\Parameter(
     *         name="user_id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del usuario"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Validación de usuario añadido en puesto realizado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="is_added", type="boolean", example=true),
     *              @OA\Property(property="message", type="string", example="Validación de usuario añadido en puesto realizado exitosamente."),
     *          ),
     *      ),
     *           @OA\Response(
     *          response=400,
     *          description="El usuario no existe. ó El usuario no se encuentra activo",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El usuario no existe. ó El usuario no se encuentra activo."),
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
     * @param int $user_id
     * @return JsonResponse
     */
    public function checkUser(Request $request, int $id, int $user_id): JsonResponse
    {
        try {

            $user = User::find($user_id);

            if ($user) {
                $position_user = PositionUser::where('position_id', $id)->where('user_id', $user_id)->first();

                return response()->json([
                    'is_added' => isset($position_user->id),
                    'message' => 'Validación de usuario añadido en puesto realizado exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'El usuario no existe.'
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
