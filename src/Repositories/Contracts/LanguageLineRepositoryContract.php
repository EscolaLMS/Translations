<?php

namespace EscolaLms\Translations\Repositories\Contracts;

use EscolaLms\Core\Repositories\Criteria\Criterion;
use EscolaLms\Translations\Models\LanguageLine;
use Illuminate\Database\Eloquent\Builder;

interface LanguageLineRepositoryContract
{
    /**
     * @param array<string, mixed> $search
     * @param array<int, Criterion> $criteria
     * @return Builder<LanguageLine>
     */
    public function allQueryBuilder(array $search = [], array $criteria = []): Builder;
}
