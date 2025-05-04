<?php

use App\Http\Controllers\EvaluationController;
use App\Http\Controllers\CognitiveController;

use App\Http\Controllers\ReportController;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EvaluacionController;
use App\Http\Middleware\RemoveXFrameOptions;

Route::get('/', function () {
    return view('welcome');
});

//Route::get('evaluation', [EvaluationController::class, 'index'])->name('evaluation');
Route::get('evaluation', [EvaluationController::class, 'index'])->name('evaluation')->middleware(RemoveXFrameOptions::class);

Route::post('evaluation', [EvaluationController::class, 'index'])->name('evaluation.save');

Route::get('pdf', [ReportController::class, 'individualReportDownload'])->name('pdf');

Route::get('/evaluacion', [EvaluacionController::class, 'show']);
Route::post('/evaluacion', [EvaluacionController::class, 'store']);
Route::post('/evaluacion/sendinvitation', [EvaluacionController::class, 'sendinvitation']);

 