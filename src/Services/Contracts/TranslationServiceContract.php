<?php

namespace EscolaLms\Translations\Services\Contracts;

use EscolaLms\Translations\Dto\TranslationDto;

interface TranslationServiceContract
{
    /**
     * @param string $key
     * @param array<string, string> $replace
     * @return array<int, TranslationDto>
     */
    public function retrieve(string $key, array $replace): array;
}
