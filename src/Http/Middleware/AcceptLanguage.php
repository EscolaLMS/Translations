<?php

namespace EscolaLms\Translations\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Config;

class AcceptLanguage
{
    public function handle(Request $request, Closure $next): mixed
    {
        // @phpstan-ignore-next-line
        App::setLocale($request->header('X-Locale', Config::get('app.locale')));

        return $next($request);
    }
}
