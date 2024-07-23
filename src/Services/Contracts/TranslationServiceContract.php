<?php

namespace EscolaLms\Translations\Services\Contracts;

interface TranslationServiceContract
{
    /**
     * @param string $key
     * @param array<string, string> $replace
     * @return array<string, string>
     */
    public function retrieve(string $key, array $replace): array;
}
