<?php

namespace EscolaLms\Translations\Services\Contracts;

use EscolaLms\Core\Dtos\OrderDto;
use Illuminate\Database\Eloquent\Builder;
use Spatie\TranslationLoader\LanguageLine;

interface LanguageLineServiceContract
{
    public function getList(OrderDto $orderDto, array $search = [], bool $onlyActive = false): Builder;
    public function create(array $data): LanguageLine;
    public function update(LanguageLine $languageLine, array $data): LanguageLine;
    public function delete(LanguageLine $languageLine): bool;
}