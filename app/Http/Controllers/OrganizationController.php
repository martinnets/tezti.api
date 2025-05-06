<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveOrganizationRequest;
use App\Models\Organization;
use App\Models\Position;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;

class OrganizationController extends Controller
{

    /**
     * Get list of organizations
     * @OA\Get (
     *     path="/api/organizations/list/get",
     *     tags={"Organizations"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener lista de organizaciones",
     *     description="Obtener listado de organizaciones.",
     *     @OA\Parameter(
     *         name="only_used",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="boolean"
     *         ),
     *         description="Organizaciones con campaña"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Listado de organizaciones obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Organización ABC"),
     *                      @OA\Property(property="description", type="string", example="Descripción de organización."),
     *                  ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Listado de organizaciones obtenido exitosamente."),
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
     * Getting list of organizations
     *
     * @return JsonResponse
     */
    public function getList(Request $request)
    {
        $data =DB::table('organizations')->get();
        return response()->json([
            'data' => $data,
            'message' => 'Listado de organizaciones obtenido exitosamente.'
        ], 200);
        // return response()->json([
        //     'data' => Organization::orderBy('name')
        //         ->where(function ($query) use ($request) {
        //             if (auth('sanctum')->user()->role == 'C') {
        //                 $query->where('id', auth('sanctum')->user()->organization_id);
        //             }
        //             if ($request->has('only_used') && $request->get('only_used')) {
        //                 $query->whereIn('id', Position::whereNotNull('organization_id')->pluck('organization_id')->unique());
        //             }
        //         })
        //         ->get(),
        //     'message' => 'Listado de organizaciones obtenido exitosamente.'
        // ], Response::HTTP_OK);
    }

    /**
     * Create organization
     * @OA\Post (
     *     path="/api/organizations/create",
     *     tags={"Organizations"},
     *     security={{"bearerAuth":{}}},
     *     summary="Crear organización",
     *     description="Creación de organización.",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Organización de prueba"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Organización creada exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=3),
     *                      @OA\Property(property="name", type="string", example="Organización de prueba")
     *              ),
     *              @OA\Property(property="message", type="string", example="Organización creada exitosamente."),
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
     * Creating administrator user
     *
     * @param SaveOrganizationRequest $request
     * @return JsonResponse
     */
    public function create(SaveOrganizationRequest $request): JsonResponse
    {
        $organization = Organization::create($request->validated());

        if ($organization) {
            return response()->json([
                'data' => $organization,
                'message' => 'Organización creada exitosamente.'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'No se pudo completar la solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }
}
