<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use App\Models\User;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Response;

class ProfileController extends Controller
{

    /**
     * Get profile data
     * @OA\Get (
     *     path="/api/profile/get",
     *     tags={"Profile"},
     *     security={{"bearerAuth":{}}},
     *     summary="Obtener datos de usuario",
     *     description="Obtener datos de perfil de usuario.",
     *      @OA\Response(
     *          response=200,
     *          description="Datos de usuario obtenidos exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Nombre"),
     *                      @OA\Property(property="lastname", type="string", example="Apellidos"),
     *                      @OA\Property(property="type", type="string", example="E=Empresa ó P=Persona"),
     *                      @OA\Property(property="document_type", type="string", example="DNI/RUC/CE/PAS"),
     *                      @OA\Property(property="document_number", type="string", example="12345678"),
     *                      @OA\Property(property="phone", type="string", example="987654321"),
     *                      @OA\Property(property="email", type="string", example="user@test.com"),
     *                      @OA\Property(property="city_id", type="number", example=1),
     *              ),
     *              @OA\Property(property="message", type="string", example="Datos de usuario obtenidos exitosamente."),
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
     * Getting user profile data
     *
     * @return JsonResponse
     */
    public function getProfile(): JsonResponse
    {
        return response()->json([
            //Buscando los datos de usuario, incluyendo la cuidad elegida por defecto con sus datos completos y haciendo el ID ciudad oculto
            'data' => User::where('id', auth('sanctum')->user()->id)->first(),
            'message' => 'Datos de usuario obtenidos exitosamente.'
        ], Response::HTTP_OK);
    }

    /**
     * Update profile
     * @OA\Put (
     *     path="/api/profile/update",
     *     tags={"Profile"},
     *     security={{"bearerAuth":{}}},
     *     summary="Actualizar datos de usuario",
     *     description="Actualizar datos de usuario. La contraseña se envía solamente si se quiere actualizar.",
     *         @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="name",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="lastname",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="type",
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
     *                          property="phone",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "name":"Nombre",
     *                     "lastname":"Apellidos",
     *                     "type":"P",
     *                     "document_type":"DNI",
     *                     "document_number":"12345678",
     *                     "phone":"987654321",
     *                     "email":"user@test.com",
     *                     "password":"123456"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Datos de usuario actualizados exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="Datos de usuario actualizados exitosamente."),
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
     * Updating user profile
     *
     * @param UpdateProfileRequest $request
     * @return JsonResponse
     */
    public function updateProfile(UpdateProfileRequest $request): JsonResponse
    {
        $user = User::where('id', auth('sanctum')->user()->id)->first();
        $request->validated();
        if ($request->get('password')) {
            $request->validate([
                'password' => [
                    'required',
                    'string',
                    \Illuminate\Validation\Rules\Password::min(8)
                        ->mixedCase()
                        ->numbers()
                        ->symbols()
                        ->uncompromised()
                ]
            ]);

            $user->password = $request->get('password');
            $user->save();
        }
        $user->update($request->except('password'));

        return response()->json([
            //Buscando los datos de usuario, incluyendo la cuidad elegida por defecto con sus datos completos y haciendo el ID ciudad oculto
            'data' => User::where('id', auth('sanctum')->user()->id)->first(),
            'message' => 'Datos de usuario actualizados exitosamente.'
        ], Response::HTTP_OK);
    }
}
