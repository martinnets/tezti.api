<?php

namespace App\Http\Controllers;

use App\Enums\RoleUser;
use App\Http\Requests\SaveAdminRequest;
use App\Http\Requests\SearchRequest;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class AdminController extends Controller
{
    /**
     * Search admin users
     * @OA\Get (
     *     path="/api/admins/search",
     *     tags={"Administrators"},
     *     security={{"bearerAuth":{}}},
     *     summary="Buscar administradores",
     *     description="Búsqueda de usuarios administrador.",
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
        $admins = User::whereIn('role', ['S', 'C'])
            ->where(function ($query) use ($request) {
                if ($request->has('text')) {
                    $query->whereRaw("unaccent(name) ILIKE unaccent(?)", ['%' . $request->input('text') . '%']);
                }
                return $query;
            })
            ->orderBy($request->input('sort_by', 'id'), $request->input('order', 'asc'))
            ->paginate($request->input('per_page', 50), ['*'], 'page', $request->input('page', 1));

        return response()->json([
            'data' => $admins,
            'message' => 'Búsqueda de usuarios administrador realizada exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Get admin filter - list of roles
     * @OA\Get (
     *     path="/api/admins/filters/roles/get",
     *     tags={"Administrators"},
     *     security={{"bearerAuth":{}}},
     *     summary="Filtros - Obtener lista de roles",
     *     description="Filtros - Obtener listado de roles de usuario administrador.",
     *      @OA\Response(
     *          response=200,
     *          description="Listado de roles de usuario administrador obtenido exitosamente",
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
     *              @OA\Property(property="message", type="string", example="Listado de roles de usuario administrador obtenido exitosamente."),
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
    public function getRoles(): JsonResponse
    {
        $data = RoleUser::COLLECTION;
        unset($data[0]);
        return response()->json([
            'data' => $data,
            'message' => 'Listado de estados de usuario administrador obtenido exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Create admin user
     * @OA\Post (
     *     path="/api/admins/create",
     *     tags={"Administrators"},
     *     security={{"bearerAuth":{}}},
     *     summary="Crear administrador",
     *     description="Creación de usuario administrador.",
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
     *                          property="role",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="organization_id",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="is_active",
     *                          type="boolean"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Adminsitrador de prueba",
     *                     "role":"S",
     *                     "email":"admin@test.com",
     *                     "password":"******",
     *                     "organization_id": null,
     *                     "is_active":"1"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Usuario administrador creado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=3),
     *                      @OA\Property(property="name", type="string", example="Administrador de prueba"),
     *                      @OA\Property(property="role", type="string", example="S"),
     *                      @OA\Property(property="email", type="string", example="admin@test.com"),
     *                      @OA\Property(property="organization_id", type="number", example=1),
     *                      @OA\Property(property="is_active", type="boolean", example=1)
     *              ),
     *              @OA\Property(property="message", type="string", example="Usuario administrador creado exitosamente."),
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
     * @param SaveAdminRequest $request
     * @return JsonResponse
     */
    public function create(SaveAdminRequest $request): JsonResponse
    {
        try {
            $request->validated();
            //Creando el puesto y obteniendo la data
            if (auth('sanctum')->user()->organization_id) {
                $request->merge([
                    'organization_id' => auth('sanctum')->user()->organization_id,
                ]);
            }

            $request->merge([
                'email_verified_at' => Carbon::now(),
            ]);

            $admin = User::create($request->all());


            if ($admin) {
                return response()->json([
                    'data' => $admin,
                    'message' => 'Usuario administrador creado exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'No se pudo completar la solicitud.'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Get user admin
     * @OA\Get (
     *     path="/api/admins/{id}/get",
     *     tags={"Administrators"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener usuario administrador",
     *     description="Obtener datos de usuario administrador.",
     *      @OA\Parameter(
     *           name="id",
     *           in="path",
     *           required=true,
     *           @OA\Schema(
     *               type="number"
     *           ),
     *           description="ID de usuario administrador"
     *       ),
     *      @OA\Response(
     *          response=200,
     *          description="Datos de usuario administrador obtenidos exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="exists", type="boolean", example="true"),
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=3),
     *                      @OA\Property(property="name", type="string", example="Administrador de prueba"),
     *                      @OA\Property(property="role", type="string", example="S"),
     *                      @OA\Property(property="email", type="string", example="admin@test.com"),
     *                      @OA\Property(property="organization_id", type="number", example=1),
     *                      @OA\Property(property="is_active", type="boolean", example=1)
     *              ),
     *              @OA\Property(property="message", type="string", example="Datos de usuario administrador obtenidos exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El ID no pertenece a un usuario administrador",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El ID no pertenece a un usuario administrador."),
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
     *          response=404,
     *          description="El ID de usuario administrador no existe",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El ID de usuario administrador no existe."),
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
     * Getting user admin
     *
     * @param Request $request
     * @param int $id
     * @return JsonResponse
     */
    public function get(Request $request, int $id): JsonResponse
    {
        try {
            $admin = User::find($id)->makeHidden(['lastname', 'document_type', 'document_number', 'phone', 'document_type_label']);

            if ($admin) {
                if ($admin->role == 'U') {
                    return response()->json([
                        'message' => 'El ID no pertenece a un usuario administrador.'
                    ], Response::HTTP_BAD_REQUEST);
                } else {
                    return response()->json([
                        'data' => $admin,
                        'message' => 'Datos de usuario por email obtenidos exitosamente.'
                    ], Response::HTTP_OK);
                }
            } else {
                return response()->json([
                    'message' => 'El ID de usuario administrador no existe.'
                ], Response::HTTP_NOT_FOUND);
            }
        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Update admin user
     * @OA\Put (
     *     path="/api/admins/{id}/update",
     *     tags={"Administrators"},
     *     security={{"bearerAuth":{}}},
     *     summary="Actualizar administrador",
     *     description="Actualización de usuario administrador.",
     *      @OA\Parameter(
     *           name="id",
     *           in="path",
     *           required=true,
     *           @OA\Schema(
     *               type="number"
     *           ),
     *           description="ID de usuario administrador"
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
     *                          property="role",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="organization_id",
     *                          type="number"
     *                      ),
     *                      @OA\Property(
     *                          property="is_active",
     *                          type="boolean"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Adminsitrador de prueba",
     *                     "role":"S",
     *                     "email":"admin@test.com",
     *                     "password":"******",
     *                     "organization_id": null,
     *                     "is_active":"1"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Usuario administrador actualizado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=3),
     *                      @OA\Property(property="name", type="string", example="Administrador de prueba"),
     *                      @OA\Property(property="role", type="string", example="S"),
     *                      @OA\Property(property="email", type="string", example="admin@test.com"),
     *                      @OA\Property(property="organization_id", type="number", example=1),
     *                      @OA\Property(property="is_active", type="boolean", example=1)
     *              ),
     *              @OA\Property(property="message", type="string", example="Usuario administrador actualizado exitosamente."),
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
     * Updating administrator user
     *
     * @param SaveAdminRequest $request
     * @param int $id
     * @return JsonResponse
     */
    public function update(SaveAdminRequest $request, int $id): JsonResponse
    {
        try {
            User::find($id)->update($request->validated());
            $admin = User::find($id)->makeHidden(['lastname', 'document_type', 'document_number', 'phone', 'document_type_label']);

            if ($admin) {
                return response()->json([
                    'data' => $admin,
                    'message' => 'Usuario administador actualizado exitosamente.'
                ], Response::HTTP_OK);
            } else {
                return response()->json([
                    'message' => 'No se pudo completar la solicitud.'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);
            }
        } catch (Exception $ex) {
            return response()->json([
                'data' => $ex->getMessage(),
                'message' => 'No se pudo completar su solicitud.'
            ], Response::HTTP_INTERNAL_SERVER_ERROR);
        }
    }

    /**
     * Delete admin user
     * @OA\Delete (
     *     path="/api/admins/{id}/delete",
     *     tags={"Administrators"},
     *     security={{"bearerAuth":{}}},
     *     summary="Eliminar administrador",
     *     description="Eliminación de usuario administrador.",
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         @OA\Schema(
     *             type="integer"
     *         ),
     *         description="ID del usuario administrador"
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="Usuario administrador eliminado exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Usuario administrador eliminado exitosamente."),
     *          ),
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El usuario no es de tipo administrador",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El usuario no es de tipo administrador."),
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
     *          response=404,
     *          description="El usuario administrador no existe",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El usuario administrador no existe."),
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
            $admin = User::find($id);

            if ($admin) {
                if ($admin->role <> 'U') {
                    $admin->delete();
                    return response()->json([
                        'message' => 'Usuario administrador eliminado exitosamente.'
                    ], Response::HTTP_OK);
                } else {
                    return response()->json([
                        'message' => 'El usuario no es de tipo administrador.'
                    ], Response::HTTP_BAD_REQUEST);
                }
            } else {
                return response()->json([
                    'message' => 'El usuario administrador no existe.'
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
