<?php

namespace EscolaLms\Translations;

use EscolaLms\Auth\Providers\AuthServiceProvider;
use EscolaLms\Translations\Http\Middleware\AcceptLanguage;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;


/**
 * SWAGGER_VERSION
 */
class EscolaLmsTranslationsServiceProvider extends ServiceProvider
{
    public $singletons = [];

    public function boot()
    {
        $this->app->make(Kernel::class)->pushMiddleware(AcceptLanguage::class);

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
    }

    public function register()
    {
        $this->app->register(AuthServiceProvider::class);
    }
}