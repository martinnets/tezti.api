<?php

namespace App\Http\Controllers;

use App\Models\Behavior;
use App\Models\Position;
use App\Models\PositionUser;
use App\Models\PositionUserBehavior;
use App\Models\Skill;
use App\Models\SkillBehavior;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class SkillController extends Controller
{
    /**
     * Get list of skills
     * @OA\Get (
     *     path="/api/skills/list/get",
     *     tags={"Skills"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener lista de habilidades",
     *     description="Obtener listado de habilidades.",
     *     @OA\Parameter(
     *         name="positionId",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="number"
     *         ),
     *         description="ID de posición"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Listado de habilidades obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Habilidad 1"),
     *                      @OA\Property(property="description", type="string", example="Descripción Habilidad 1"),
     *                   ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Listado de habilidades obtenido exitosamente."),
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
     * Getting list of skills
     *
     * @return JsonResponse
     */
    public function getList(Request $request): JsonResponse
    {
        $data = Skill::where('is_active', true)
            ->where(function ($query) use ($request) {
                if ($request->has('positionId') && $request->get('positionId')) {
                    $position = Position::with(['hierarchicalLevel'])->find($request->get('positionId'));
                    $level = ($position->type == 'fit') ? $position->hierarchicalLevel->level : $position->hierarchicalLevel->level + 1;
                    $skill_ids = SkillBehavior::whereIn('behavior_id', Behavior::where('level', $level)->pluck('id'))->pluck('skill_id');
                    $query->whereIn('id', $skill_ids);
                }
            })
            ->orderBy('name')
            ->get()
            ->makeHidden(['is_active']);

        if ($data && $request->has('positionId') && $request->get('positionId')) {

            if (PositionUserBehavior::whereIn('position_user_id', PositionUser::where('position_id', $request->get('positionId'))->pluck('id'))->count() > 0) {
                $data->map(function ($skill) use ($request) {
                    $skill->disabled = true;
                    return $skill;
                });
            }
        }
        return response()->json([
            'data' => $data,
            'message' => 'Listado de habilidades obtenido exitosamente.'
        ], Response::HTTP_OK);
    }
}
