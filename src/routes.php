<?php

use EscolaLms\Translations\Http\Controllers\TranslationAdminApiController;
use EscolaLms\Translations\Http\Controllers\TranslationApiController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth:api'], 'prefix' => 'api/admin/translations'], function () {
    Route::get('', [TranslationAdminApiController::class, 'index']);
    Route::post('', [TranslationAdminApiController::class, 'store']);
    Route::put('{id}', [TranslationAdminApiController::class, 'update']);
    Route::get('{id}', [TranslationAdminApiController::class, 'show']);
    Route::delete('{id}', [TranslationAdminApiController::class, 'delete']);
    Route::post('retrieve', [TranslationAdminApiController::class, 'translate']);
});

Route::group(['prefix' => 'api/translations'], function () {
    Route::get('', [TranslationApiController::class, 'index']);
});
