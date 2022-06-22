<?php

use EscolaLms\Translations\Http\Controllers\TranslationAdminApiController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api'], 'prefix' => 'api/admin/translations'], function () {
    Route::get(null, [TranslationAdminApiController::class, 'index']);
    Route::post(null, [TranslationAdminApiController::class, 'store']);
    Route::put('{id}', [TranslationAdminApiController::class, 'update']);
    Route::get('{id}', [TranslationAdminApiController::class, 'show']);
    Route::delete('{id}', [TranslationAdminApiController::class, 'delete']);
});