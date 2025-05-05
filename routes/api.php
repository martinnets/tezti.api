<?php

use App\Http\Controllers\AdditionalController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\EvaluatedController;
use App\Http\Controllers\HierarchicalLevelController;
use App\Http\Controllers\MoodleController;
use App\Http\Controllers\OrganizationController;
use App\Http\Controllers\PositionController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ReportController;
use App\Http\Controllers\SkillController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\ScormPackageController;
use App\Http\Controllers\EmailController;

use App\Http\Middleware\EmailIsVerified;
use App\Http\Middleware\UserIsActive;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Route;

// Auth endponits
Route::post('signin', [AuthController::class, 'signin'])->name('signin');
Route::post('login', [AuthController::class, 'login'])->name('login');
Route::post('forgot-password', [AuthController::class, 'forgotPassword'])->name('forgot-password');
Route::post('validate-password-code', [AuthController::class, 'validatePasswordCode'])->name('validate-password-code');
Route::patch('change-password', [AuthController::class, 'changePassword'])->name('change-password');
 // Positions endponits
 Route::prefix('positions')->name('positions.')->group(function () {
    Route::get('sellst', [PositionController::class, 'index'])->name('index');
    Route::get('indicators/get', [PositionController::class, 'getIndicators'])->name('get-indicators');
    Route::get('search', [PositionController::class, 'search'])->name('search');
    Route::get('search/export', [PositionController::class, 'exportSearch'])->name('export-search')->withoutMiddleware(['auth:sanctum']);
    Route::post('create', [PositionController::class, 'create'])->name('create');
    Route::get('{id}/get', [PositionController::class, 'get'])->name('get');
    Route::put('{id}/update', [PositionController::class, 'update'])->name('update');
    Route::delete('{id}/delete', [PositionController::class, 'delete'])->name('delete');
    Route::post('{id}/skills/set', [PositionController::class, 'setSkills'])->name('set-skills');
    Route::get('{id}/skills/get', [PositionController::class, 'getSkills'])->name('get-skills');
    Route::get('{id}/users/search', [PositionController::class, 'searchUsers'])->name('search-users');
    Route::post('{id}/users/set-add', [PositionController::class, 'setAddUser'])->name('set-add-user');
    Route::post('{id}/users/send-reminders', [PositionController::class, 'sendReminders'])->name('send-reminders');
    Route::get('users/{id}/get', [PositionController::class, 'getUser'])->name('get-user');
    Route::delete('users/{id}/remove', [PositionController::class, 'removeUser'])->name('remove-user');
    Route::get('{id}/users/{user_id}/check', [PositionController::class, 'checkUser'])->name('check-user');

    // Positions filter endponits
    Route::prefix('filters')->name('filters.')->group(function () {
        Route::get('creators/get', [PositionController::class, 'getCreators'])->name('get-creators');
        Route::get('status/get', [PositionController::class, 'getStatus'])->name('get-status');
        Route::get('types/get', [PositionController::class, 'getTypes'])->name('get-types');
    });
});
// Authenticated endponits
Route::middleware(['auth:sanctum', UserIsActive::class])->group(function () {
    // Auth endponits
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');
    // Enviar Invitacion
    Route::post('/emails/send', [EmailController::class, 'enviar']);

    Route::middleware([EmailIsVerified::class])->group(function () {
        // Profile endponits
        Route::prefix('profile')->name('profile.')->group(function () {
            Route::get('get', [ProfileController::class, 'getProfile'])->name('get');
            Route::put('update', [ProfileController::class, 'updateProfile'])->name('update');
        });

        // Organization endponits
        Route::prefix('organizations')->name('organizations.')->group(function () {
            Route::get('list/get', [OrganizationController::class, 'getList'])->name('get-list');
            Route::post('create', [OrganizationController::class, 'create'])->name('create');
        });

        // Hierarchical Level endponits
        Route::prefix('hierarchical-levels')->name('hierarchical-levels.')->group(function () {
            Route::get('list/get', [HierarchicalLevelController::class, 'getList'])->name('get-list');
        });

        // Additional fields endponits
        Route::prefix('additionals')->name('additionals.')->group(function () {
            Route::get('list/get', [AdditionalController::class, 'getList'])->name('get-list');
            Route::get('search', [AdditionalController::class, 'search'])->name('search');
            Route::post('create', [AdditionalController::class, 'create'])->name('create');
            Route::get('{id}/get', [AdditionalController::class, 'get'])->name('get');
            Route::put('{id}/update', [AdditionalController::class, 'update'])->name('update');
            Route::delete('{id}/delete', [AdditionalController::class, 'delete'])->name('delete');
        });

        // Skills endponits
        Route::prefix('skills')->name('skills.')->group(function () {
            Route::get('list/get', [SkillController::class, 'getList'])->name('get-list');
        });
        // Cognitive endponits
        Route::prefix('cognitive')->name('cognitive.')->group(function () {
            Route::get('list', [SkillController::class, 'show'])->name('show');
        });


        // Admins endponits
        Route::prefix('admins')->name('admins.')->group(function () {
            Route::get('search', [AdminController::class, 'search'])->name('search');
            Route::post('create', [AdminController::class, 'create'])->name('create');
            Route::get('{id}/get', [AdminController::class, 'get'])->name('get');
            Route::put('{id}/update', [AdminController::class, 'update'])->name('update');
            Route::delete('{id}/delete', [AdminController::class, 'delete'])->name('delete');

            // Admins filter endponits
            Route::prefix('filters')->name('filters.')->group(function () {
                Route::get('roles/get', [AdminController::class, 'getRoles'])->name('get-roles');
            });
        });

        // Users endponits
        Route::prefix('users')->name('users.')->group(function () {
            Route::get('by-email/get', [UserController::class, 'getByEmail'])->name('get-by-email');
            Route::get('document-type/list', [UserController::class, 'listDocumentType'])->name('list-document-type');
            Route::get('status/list', [UserController::class, 'listStatus'])->name('list-status');
        });

       

        // Evaluteds endponits
        Route::prefix('evaluateds')->name('evaluateds.')->group(function () {
            Route::get('indicators/get', [EvaluatedController::class, 'getIndicators'])->name('get-indicators');
            Route::get('search', [EvaluatedController::class, 'search'])->name('search');
            Route::get('search/export', [EvaluatedController::class, 'exportSearch'])->name('export-search')->withoutMiddleware(['auth:sanctum']);
            Route::get('{id}/get', [EvaluatedController::class, 'get'])->name('get');

            // Evaluteds filter endponits
            Route::prefix('filters')->name('filters.')->group(function () {
                Route::get('positions/search', [EvaluatedController::class, 'searchPositions'])->name('search-positions');
                Route::get('status/get', [EvaluatedController::class, 'getStatus'])->name('get-status');
            });
        });

        // Reports endponits
        Route::prefix('reports')->name('reports.')->group(function () {
            Route::get('evaluated-ranking', [ReportController::class, 'evaluatedRanking'])->name('evaluated-ranking');
            Route::get('evaluated-ranking/export', [ReportController::class, 'exportEvaluatedRanking'])->name('evaluated-ranking.export')->withoutMiddleware(['auth:sanctum']);
            Route::get('by-skills', [ReportController::class, 'bySkills'])->name('by-skills');
            Route::get('by-skills/export', [ReportController::class, 'exportBySkills'])->name('by-skills.export')->withoutMiddleware(['auth:sanctum']);
            Route::get('{id}/individual', [ReportController::class, 'individualReport'])->name('individual-report');
            Route::get('{id}/pdi', [ReportController::class, 'pdi'])->name('pdi');
            Route::post('individual/download', [ReportController::class, 'individualReportDownload'])->name('individual-report.download')->withoutMiddleware(['auth:sanctum']);
            Route::post('pdi/download', [ReportController::class, 'pdiDownload'])->name('pdi.download')->withoutMiddleware(['auth:sanctum']);
            Route::get('results', [ReportController::class, 'results'])->name('results')->withoutMiddleware(['auth:sanctum']);
        });
    });
});

