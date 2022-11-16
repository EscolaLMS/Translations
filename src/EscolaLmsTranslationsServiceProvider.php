<?php

namespace EscolaLms\Translations;

use EscolaLms\Translations\Console\Command\MergeTranslationsOfPermissionsCommand;
use EscolaLms\Translations\Http\Middleware\AcceptLanguage;
use EscolaLms\Translations\Providers\AuthServiceProvider;
use EscolaLms\Translations\Repositories\Contracts\LanguageLineRepositoryContract;
use EscolaLms\Translations\Repositories\LanguageLineRepository;
use EscolaLms\Translations\Services\Contracts\LanguageLineServiceContract;
use EscolaLms\Translations\Services\LanguageLineService;
use Illuminate\Contracts\Http\Kernel;
use Illuminate\Support\ServiceProvider;
use Spatie\TranslationLoader\TranslationServiceProvider;

/**
 * SWAGGER_VERSION
 */
class EscolaLmsTranslationsServiceProvider extends ServiceProvider
{
    const REPOSITORIES = [
        LanguageLineRepositoryContract::class => LanguageLineRepository::class,
    ];

    const SERVICES = [
        LanguageLineServiceContract::class => LanguageLineService::class,
    ];

    public $singletons = self::SERVICES + self::REPOSITORIES;

    public function boot()
    {
        $this->app->make(Kernel::class)->pushMiddleware(AcceptLanguage::class);

        $this->loadRoutesFrom(__DIR__ . '/routes.php');
        $this->loadMigrationsFrom(__DIR__ . '/../database/migrations');

        $this->loadTranslationsFrom(__DIR__ . '/../resources/lang', 'escolalms_translations');
        $this->mergeConfigFrom(__DIR__ . '/../config/config.php', 'escolalms_translations');

        if ($this->app->runningInConsole()) {
            $this->bootForConsole();
        }
    }

    public function register()
    {
        $this->app->register(AuthServiceProvider::class);
        $this->app->register(TranslationServiceProvider::class);
    }

    protected function bootForConsole(): void
    {
        $this->commands([
            MergeTranslationsOfPermissionsCommand::class,
        ]);

        $this->publishes([
            __DIR__ . '/../config/config.php' => config_path('escolalms_translations.php'),
        ], 'escolalms_translations');
    }
}