<?php

namespace App\Http\Controllers;

use App\Http\Requests\SaveAdditionalRequest;
use App\Http\Requests\SearchRequest;
use App\Models\Additional;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Matrix\Operators\Addition;
use Ramsey\Uuid\Type\Integer;

class AdditionalController extends Controller
{
    /**
     * Get list of additional fields for positions
     * @OA\Get (
     *     path="/api/additionals/list/get",
     *     tags={"Additional fields"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener lista de organizaciones",
     *     description="Obtener listado de organizaciones.",
     *      @OA\Response(
     *          response=200,
     *          description="Listado de campos adicionales obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Campo adicional 1"),
     *                   ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Listado de campos adicionales obtenido exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *                 response=401,
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
    public function getList(): JsonResponse
    {
        return response()->json([
            'data' => Additional::where('is_active', 1)
                ->where(function ($query) {
                    if (auth('sanctum')->user()->role == 'C') {
                        $query->where('user_id', auth('sanctum')->user()->id);
                    }
                })
                ->orderBy('name')
                ->get()
                ->makeHidden(['is_active', 'organization_id', 'user_id', 'is_active_label']),
            'message' => 'Listado de campos adicionales obtenido exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Search additional fields
     * @OA\Get (
     *     path="/api/additionals/search",
     *     tags={"Additional fields"},
     *     security={{"bearerAuth":{}}},
     *     summary="Buscar campos adicionales",
     *     description="Búsqueda de campos adicionales.",
     *     @OA\Parameter(
     *         name="text",
     *         in="query",
     *         required=false,
     *         @OA\Schema(
     *             type="string"
     *         ),
     *         description="Nombre de campo adicional"
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
     *          description="Búsqueda de campos adicionales realizada exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=20),
     *                      @OA\Property(property="name", type="string", example="Recepcionista 1"),
     *                      @OA\Property(property="is_active", type="number", example=1),
     *                      @OA\Property(property="status", type="number", example="Activo"),
     *              ),
     *              @OA\Property(property="message", type="string", example="Búsqueda de campos adicionales realizada exitosamente."),
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
     * @param Request $request
     * @return JsonResponse
     */
    public function search(SearchRequest $request): JsonResponse
    {
        $where = function ($query) use ($request) {
            if ($request->has('text')) {
                $query->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
            }

            if (auth('sanctum')->user()->role == 'C') {
                $query->where('user_id', auth('sanctum')->user()->id);
            }
            return $query;
        };

        // Obtención de listado
        $additionals = Additional::where($where)
            ->orderBy($request->input('sort_by', 'id'), $request->input('order', 'asc'))
            ->paginate($request->input('per_page', 50), ['*'], 'page', $request->input('page', 1))->makeHidden(['organization_id', 'user_id']);
        //->toSql();

        return response()->json([
            'data' => $additionals,
            'message' => 'Búsqueda de campos adicionales realizada exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Create additional field
     * @OA\Post (
     *     path="/api/additionals/create",
     *     tags={"Additional fields"},
     *     security={{"bearerAuth":{}}},
     *     summary="Crear campo adicional",
     *     description="Creación de campo adicional.",
     *         @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="is_active",
     *                          type="number"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Campo adicional 1",
     *                     "is_active":"1"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Campo adicional creado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=3),
     *                      @OA\Property(property="name", type="string", example="Campo adicional 3"),
     *                      @OA\Property(property="is_active", type="boolean", example=1)
     *              ),
     *              @OA\Property(property="message", type="string", example="Campo adicional creado exitosamente."),
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
     * @param SaveAdditionalRequest $request
     * @return JsonResponse
     */
    public function create(SaveAdditionalRequest $request): JsonResponse
    {
        $request->validated();
        //Creando el puesto y obteniendo la data
        $request->merge([
            'user_id' => auth('sanctum')->user()->id,
            'organization_id' => auth('sanctum')->user()->organization_id,
        ]);
        $additional = Additional::create($request->all());


        if ($additional) {
            return response()->json([
                'data' => [
                    'id' => $additional->id,
                    'name' => $additional->name,
                    'is_active' => $additional->is_active,
                ],
                'message' => 'Campo adicional creado exitosamente.'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'No se pudo completar la solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get additional field
     * @OA\Get (
     *     path="/api/additionals/{id}/get",
     *     tags={"Additional fields"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener campo adicional",
     *     description="Obtener datos del campo adicional.",
     *         @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del campo adicional"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Datos del campo adicional obtenidos exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Puesto 1"),
     *                      @OA\Property(property="is_active", type="boolean", example=1),
     *                      @OA\Property(property="is_active_label", type="string", example="Activo")
     *              ),
     *              @OA\Property(property="message", type="string", example="Datos del campo adicional obtenidos exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El campo adicional no existe",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El campo adicional no existe."),
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
     * Getting position data
     *
     * @param Request $request
     * @param Integer $id
     * @return JsonResponse
     */
    public function get(Request $request, int $id): JsonResponse
    {
        try {
            $additional = Additional::where('id', $id)->first()->makeHidden(['organization_id', 'user_id']);

            if ($additional) {
                return response()->json([
                    'data' => $additional,
                    'message' => 'Datos del campo adicional obtenidos exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'El campo adicional no existe.'
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
     * Update additional field
     * @OA\Put (
     *     path="/api/additionals/{id}/update",
     *     tags={"Additional fields"},
     *     security={{"bearerAuth":{}}},
     *     summary="Actualizar campo adicional",
     *     description="Actualización de campo adicional.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del campo adicional"
     *     ),
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="is_active",
     *                          type="number"
     *                      ),
     *                 ),
     *                 example={
     *                     "name":"Recepcionista",
     *                     "is_active": 1,
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Campo adicional actualizado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="number", example=3),
     *                      @OA\Property(property="name", type="string", example="Campo adicional 3"),
     *                      @OA\Property(property="is_active", type="boolean", example=1),
     *                      @OA\Property(property="is_active_label", type="number", example="Activo"),
     *              ),
     *              @OA\Property(property="message", type="string", example="Campo adicional actualizado exitosamente."),
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
     * @param SaveAdditionalRequest $request
     * @param Integer $id
     * @return JsonResponse
     */
    public function update(SaveAdditionalRequest $request, int $id): JsonResponse
    {
        $additional = Additional::where('id', $id)->first();
        $additional->update($request->validated());

        if ($additional) {
            return response()->json([
                'data' => $additional->makeHidden(['organization_id', 'user_id']),
                'message' => 'Campo adicional actualizado exitosamente.'
            ], Response::HTTP_OK);
        } else {
            return response()->json([
                'message' => 'No se pudo completar la solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete additional field
     * @OA\Delete (
     *     path="/api/additionals/{id}/delete",
     *     tags={"Additional fields"},
     *     security={{"bearerAuth":{}}},
     *     summary="Eliminar campo adicional",
     *     description="Eliminación de campo adicional.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del campo adicional"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Campo adicional eliminado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Campo adicional eliminado exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El campo adicional no existe",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El campo adicional no existe."),
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
     * Deleting additional field
     *
     * @param Request $request
     * @param Integer $id
     * @return JsonResponse
     */
    public function delete(Request $request, int $id): JsonResponse
    {
        try {
            $additional = Additional::find($id);

            if ($additional) {
                $additional->delete();
                return response()->json([
                    'message' => 'Campo adicional eliminado exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'El campo adicional no existe.'
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
