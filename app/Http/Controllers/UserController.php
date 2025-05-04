<?php

namespace App\Http\Controllers;

use App\Enums\DocumentType;
use App\Enums\UserIsActive;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class UserController extends Controller
{
    /**
     * Get user status by email
     * @OA\Get (
     *     path="/api/users/by-email/get",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener usuario por email",
     *     description="Obtener datos de usuario por email.",
     *          @OA\Parameter(
     *              name="email",
     *              in="query",
     *              required=true,
     *              @OA\Schema(
     *                  type="string"
     *              ),
     *              description="Email"
     *          ),
     *         @OA\Response(
     *          response=200,
     *          description="Datos de usuario por email obtenidos exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="exists", type="boolean", example="true"),
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Nombre"),
     *                      @OA\Property(property="lastname", type="string", example="Apellidos"),
     *                      @OA\Property(property="document_type", type="string", example="DNI"),
     *                      @OA\Property(property="document_number", type="string", example="12345678"),
     *                      @OA\Property(property="email", type="string", example="user@test.com"),
     *                      @OA\Property(property="is_active", type="boolean", example="true"),
     *                      @OA\Property(property="is_active_label", type="boolean", example="Activo"),
     *              ),
     *              @OA\Property(property="message", type="string", example="Datos de usuario por email obtenidos exitosamente."),
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
     * @param Request $request
     * @return JsonResponse
     */
    public function getByEmail(Request $request): JsonResponse
    {

        $user = User::where('is_active', 1)
            ->where('email', $request->input('email'))
            ->first();

        return response()->json([
            'exists' => !is_null($user),
            'data' => $user ? $user->makeHidden(['organization_id', 'phone']) : null,
            'message' => 'Datos de usuario por email obtenidos exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Get user document type list
     * @OA\Get (
     *     path="/api/users/document-type/list",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener listado de tipos de documento",
     *     description="Obtener listado de tipos de documento de usuario.",
     *         @OA\Response(
     *          response=200,
     *          description="Listado de tipos de documento de usuario obtenidos exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                  @OA\Property(property="id", type="string", example="DNI"),
     *                  @OA\Property(property="name", type="string", example="DNI - Documento Nacional de Identidad")
     *              ),
     *              @OA\Property(property="message", type="string", example="Listado de tipos de documento de usuario obtenidos exitosamente."),
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
     * Getting list of user document type
     *
     * @return JsonResponse
     */
    public function listDocumentType(): JsonResponse
    {
        return response()->json([
            'data' => DocumentType::COLLECTION,
            'message' => 'Datos de usuario por email obtenidos exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Get list of user status
     * @OA\Get (
     *     path="/api/users/status/list",
     *     tags={"Users"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener lista de estados de usuario",
     *     description="Obtener listado de estados de usuario.",
     *      @OA\Response(
     *          response=200,
     *          description="Listado de estados de usuario obtenido exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(
     *                  property="data",
     *                  type="array",
     *                  @OA\Items(
     *                      type="object",
     *                      @OA\Property(property="id", type="number", example=true),
     *                      @OA\Property(property="name", type="string", example="Activo"),
     *                   ),
     *              ),
     *              @OA\Property(property="message", type="string", example="Listado de estados de usuario obtenido exitosamente."),
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
     * Getting list of user status
     *
     * @return JsonResponse
     */
    public function listStatus(): JsonResponse
    {
        return response()->json([
            'data' => UserIsActive::COLLECTION,
            'message' => 'Listado de estados de usuario obtenido exitosamente.'
        ], Response::HTTP_OK);
    }
}
