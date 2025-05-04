<?php

namespace App\Http\Controllers;

use OpenApi\Annotations as OA;

/**
 * @OA\Info(
 *      title="Tezti API",
 *      version="1.0",
 *      description="Documentación API Tezti",
 *      @OA\Contact(
 *          email="services@evolbit.net"
 *      ),
 * )
 * @OA\Server(
 *      url="http://localhost:8080/",
 *      description="Dev"
 * )
 * @OA\Server(
 *      url="https://test.evolbit.one/",
 *      description="QA"
 * )
 * @OA\Server(
 *      url="https://evaluacion.tezti.com/",
 *      description="Stage"
 * )
 * @OA\SecurityScheme(
 *      type="http",
 *      securityScheme="bearerAuth",
 *      scheme="bearer",
 *      bearerFormat="JWT"
 * )
 */
abstract class Controller
{
}
