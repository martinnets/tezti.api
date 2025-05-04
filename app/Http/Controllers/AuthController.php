<?php

namespace App\Http\Controllers;

use App\Http\Requests\ChangePasswordRequest;
use App\Http\Requests\ForgotPasswordRequest;
use App\Http\Requests\SinginRequest;
use App\Http\Requests\SingupRequest;
use App\Http\Requests\VerifyRequest;
use App\Mail\ForgotPasswordTemplate;
use App\Mail\VerificationCodeTemplate;
use App\Models\User;
use Carbon\Carbon;
use Exception;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Str;
use OpenApi\Annotations as OA;

class AuthController extends Controller
{
    public function login(Request $request)
    {
        return $request;
       
        // $user = User::where('email', $request->email)->first();

        // if (!$user || !Hash::check($request->password, $user->password)) {
        //     return response()->json([
        //         'message' => 'Las credenciales proporcionadas son incorrectas.'
        //     ], Response::HTTP_UNAUTHORIZED);

        // } elseif (!$user->is_active) {
        //     return response()->json([
        //         'message' => 'El usuario está desactivado.'
        //     ], Response::HTTP_UNAUTHORIZED);
        // } elseif ($user->role == 'U') {
        //     return response()->json([
        //         'message' => 'La cuenta no es de tipo Administrador.'
        //     ], Response::HTTP_UNAUTHORIZED);
        // }
        // $token =$user->createToken('auth_token')->plainTextToken;
        // //$token = '123';
        // return response()->json([
        //     'data' => [
        //         'id' => $user->id,
        //         'name' => $user->name,
        //         'lastname' => $user->lastname,
        //         'role' => $user->role,
        //         'type' => $user->type,
        //         'document' => $user->document,
        //         'phone' => $user->phone,
        //         'email' => $user->email,
        //         'token' => $token
        //     ],
        //     'message' => 'Has iniciado sesión correctamente.'
        // ], 200);
        
    }
    /**
     * Signin
     * @OA\Post (
     *     path="/api/signin",
     *     tags={"Auth"},
     *     summary="Login usuarios",
     *     description="Inicio de sesión para usuarios, usando email y contraseña.",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="password",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="device_name",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "email":"user@test.com",
     *                     "password":"useruser1",
     *                     "device_name":"phone_user1"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="Credenciales válidas",
     *          @OA\JsonContent(
     *              @OA\Property(property="data", type="object",
     *                      @OA\Property(property="id", type="number", example=2),
     *                      @OA\Property(property="name", type="string", example="Nombre"),
     *                      @OA\Property(property="lastname", type="string", example="Apellidos"),
     *                      @OA\Property(property="role", type="string", example="S=Superadmin ó C=Administrador cliente"),
     *                      @OA\Property(property="document_type", type="string", example="DNI"),
     *                      @OA\Property(property="document_number", type="string", example="12345678"),
     *                      @OA\Property(property="phone", type="string", example="987654321"),
     *                      @OA\Property(property="email", type="string", example="user@test.com"),
     *                      @OA\Property(property="token", type="string", example="randomtokenasfhajskfhajf398rureuuhfdshk"),
     *              ),
     *              @OA\Property(property="message", type="string", example="Has iniciado sesión correctamente."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Usuario o contraseña incorrectos."),
     *          )
     *      )
     * )
     *
     * Login with user account
     *
     *  
     *  
     */
    public function signin(Request $request)
    {
       // return $request;
        $user = User::where('email', $request->email)->first();

        if (!$user || !Hash::check($request->password, $user->password)) {
            return response()->json([
                'message' => 'Las credenciales proporcionadas son incorrectas.'
            ], Response::HTTP_UNAUTHORIZED);

        } elseif (!$user->is_active) {
            return response()->json([
                'message' => 'El usuario está desactivado.'
            ], Response::HTTP_UNAUTHORIZED);
        } elseif ($user->role == 'U') {
            return response()->json([
                'message' => 'La cuenta no es de tipo Administrador.'
            ], Response::HTTP_UNAUTHORIZED);
        }
        //$user->createToken($request->device_name)->plainTextToken
        $token = $user->createToken('auth_token')->plainTextToken;
        return response()->json([
            'data' => [
                'id' => $user->id,
                'name' => $user->name,
                'lastname' => $user->lastname,
                'role' => $user->role,
                'type' => $user->type,
                'document' => $user->document,
                'phone' => $user->phone,
                'email' => $user->email,
                'token' => $token
            ],
            'message' => 'Has iniciado sesión correctamente.'
        ], 200);
    }

    /**
     * Forgot password
     * @OA\Post (
     *     path="/api/forgot-password",
     *     tags={"Auth"},
     *     summary="Olvidé mi contraseña",
     *     description="Solcitud de código al email para reestablecer contraseña.",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "email":"user@test.com"
     *                }
     *              ),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El email no coincide con nuestros registros",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El email no coincide con nuestros registros."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar su solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="data", type="object", example="Detalle del error."),
     *                  @OA\Property(property="message", type="string", example="El email no coincide con nuestros registros."),
     *          )
     *      ),
     * )
     *
     * Requesting code to reset password
     *
     * @param ForgotPasswordRequest $request
     * @return JsonResponse
     */
    public function forgotPassword(ForgotPasswordRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $code = Str::random(6);

        if ($user) {
            try {
                DB::table('password_reset_tokens')->upsert([
                    'email' => $user->email,
                    'token' => Hash::make($code),
                    'created_at' => Carbon::now(),
                ], uniqueBy: ['email'], update: ['token', 'created_at']);

                Mail::to($user->email)->send(new ForgotPasswordTemplate($user, $code));

                return response()->json([
                    'message' => 'El email de reestablecimiento de contraseña ha sido enviado.'
                ], Response::HTTP_OK);

            } catch (Exception $ex) {

                return response()->json([
                    'data' => $ex->getMessage(),
                    'message' => 'No se pudo completar su solicitud.'
                ], Response::HTTP_INTERNAL_SERVER_ERROR);

            }
        } else {
            return response()->json([
                'message' => 'El email no coincide con nuestros registros.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Validates validity of reset password code
     * @OA\Post (
     *     path="/api/validate-password-code",
     *     tags={"Auth"},
     *     summary="Validar código de contraseña",
     *     description="Validar vigencia de código de reestablecimiento de contraseña.",
     *     security={{"bearerAuth":{}}},
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="code",
     *                          type="string"
     *                      ),
     *                      @OA\Property(
     *                          property="email",
     *                          type="string"
     *                      )
     *                 ),
     *                 example={
     *                     "email":"user@test.com",
     *                     "code":"xyYS23"
     *                 }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="El código se encuentra vigente y puede ser utilizado",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="El código se encuentra vigente y puede ser utilizado."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El email no coincide con nuestros registros",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El email no coincide con nuestros registros. ó No se tiene registada solicitud de cambio de contraseña."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="El código proporcionado no es correcto",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El código proporcionado no es correcto."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=410,
     *          description="El código ha expirado, por favor solicitar uno nuevo",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El código ha expirado, por favor solicitar uno nuevo."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar su solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="data", type="object", example="Detalle del error."),
     *                  @OA\Property(property="message", type="string", example="El email no coincide con nuestros registros."),
     *          )
     *      ),
     * )
     *
     * Validates validity of password reset code
     *
     * @param VerifyRequest $request
     * @return JsonResponse
     */
    public function validatePasswordCode(VerifyRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $passwordResetToken = DB::table('password_reset_tokens')->where('email', $user->email)->first();

        if ($user) {
            if ($passwordResetToken) {
                if (!$user || !$passwordResetToken || !Hash::check($request->code, $passwordResetToken->token)) {
                    return response()->json([
                        'message' => 'El código proporcionado no es correcto.'
                    ], Response::HTTP_UNAUTHORIZED);

                } else {
                    if ((strtotime(Carbon::now()) - strtotime($passwordResetToken->created_at)) > config('auth.code_timeout')) {
                        return response()->json([
                            'message' => 'El código ha expirado, por favor solicitar uno nuevo.',
                        ], Response::HTTP_GONE);

                    } else {
                        return response()->json([
                            'message' => 'El código se encuentra vigente y puede ser utilizado.'
                        ], Response::HTTP_OK);
                    }
                }
            } else {
                return response()->json([
                    'message' => 'No se tiene registada solicitud de cambio de contraseña.'
                ], Response::HTTP_OK);
            }
        } else {
            return response()->json([
                'message' => 'El email no coincide con nuestros registros.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Change password
     * @OA\Patch (
     *     path="/api/change-password",
     *     tags={"Auth"},
     *     summary="Cambiar contraseña",
     *     description="Cambio de contraseña usando código de reestablecimiento recibido al email.",
     *     @OA\RequestBody(
     *         @OA\MediaType(
     *             mediaType="application/json",
     *             @OA\Schema(
     *                 @OA\Property(
     *                      type="object",
     *                      @OA\Property(
     *                          property="code",
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
     *                     "code":"xyYS23",
     *                     "email":"user@test.com",
     *                     "password":"12346578"
     *                }
     *             )
     *         )
     *      ),
     *      @OA\Response(
     *          response=200,
     *          description="La contraseña ha sido cambiada exitosamente",
     *          @OA\JsonContent(
     *              @OA\Property(property="message", type="string", example="La contraseña ha sido cambiada exitosamente."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=400,
     *          description="El email no coincide con nuestros registros",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El email no coincide con nuestros registros. ó No se tiene registada solicitud de cambio de contraseña."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="El código proporcionado no es correcto",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="El código proporcionado no es correcto."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=500,
     *          description="No se pudo completar su solicitud",
     *          @OA\JsonContent(
     *                  @OA\Property(property="data", type="object", example="Detalle del error."),
     *                  @OA\Property(property="message", type="string", example="El email no coincide con nuestros registros."),
     *          )
     *      ),
     * )
     *
     * Change password usind code
     *
     * @param ChangePasswordRequest $request
     * @return JsonResponse
     */
    public function changePassword(ChangePasswordRequest $request): JsonResponse
    {
        $user = User::where('email', $request->email)->first();
        $passwordResetToken = DB::table('password_reset_tokens')->where('email', $user->email)->first();

        if ($user) {
            if ($passwordResetToken) {
                if (!$user || !$passwordResetToken || !Hash::check($request->code, $passwordResetToken->token)) {
                    return response()->json([
                        'message' => 'El código proporcionado no es correcto.'
                    ], Response::HTTP_UNAUTHORIZED);

                } else {
                    DB::table('password_reset_tokens')->where('email', $user->email)->delete();

                    $user->updated_at = Carbon::now();
                    $user->password = Hash::make($request->password);
                    $user->save();

                    return response()->json([
                        'message' => 'La contraseña ha sido cambiada exitosamente.'
                    ], Response::HTTP_OK);
                }
            } else {
                return response()->json([
                    'message' => 'No se tiene registada solicitud de cambio de contraseña.'
                ], Response::HTTP_OK);
            }
        } else {
            return response()->json([
                'message' => 'El email no coincide con nuestros registros.'
            ], Response::HTTP_BAD_REQUEST);
        }
    }

    /**
     * Logout
     * @OA\Post (
     *     path="/api/logout",
     *     tags={"Auth"},
     *     security={{"bearerAuth":{}}},
     *     summary="Cerrar sesión de usuario",
     *     description="Cierre de sesión de usuario logueado.",
     *      @OA\Response(
     *          response=200,
     *          description="Sesión cerrada",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Has cerrado sesión correctamente."),
     *          )
     *      ),
     *      @OA\Response(
     *          response=401,
     *          description="Credenciales inválidas",
     *          @OA\JsonContent(
     *                  @OA\Property(property="message", type="string", example="Credenciales inválidas."),
     *          )
     *      )
     * )
     *
     * Close user session
     *
     * @param Request $request
     * @return JsonResponse
     */
    public function logout(Request $request): JsonResponse
    {
        $request->user()->tokens()->delete();
        return response()->json([
            'message' => 'Has cerrado sesión correctamente.'
        ], Response::HTTP_OK);
    }
}
