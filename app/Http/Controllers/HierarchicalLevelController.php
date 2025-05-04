<?php

namespace App\Http\Controllers;

use App\Models\HierarchicalLevel;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class HierarchicalLevelController extends Controller
{

    /**
     * Get list of hierarchical levels
     * @OA\Get (
     *     path="/api/hierarchical-levels/list/get",
     *     tags={"Hierarchical Levels"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener lista de niveles jerárquicos",
     *     description="Obtener listado de niveles jerárquicos.",
     *      @OA\Response(
     *          response=200,
     *          description="Listado de niveles jerárquicos obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *              property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Nivel jerárquico 2"),
     *                   ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Listado de niveles jerárquicos obtenido exitosamente."),
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
     * Get list of hierarchical levels
     *
     * @return JsonResponse
     */
    public function getList(): JsonResponse
    {
        return response()->json([
            'data' => HierarchicalLevel::orderBy('level')->get(),
            'message' => 'Listado de niveles jerárquicos obtenido exitosamente.'
        ], Response::HTTP_OK);
    }
}
