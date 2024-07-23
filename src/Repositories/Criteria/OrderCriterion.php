<?php

namespace EscolaLms\Translations\Repositories\Criteria;

use EscolaLms\Core\Repositories\Criteria\Criterion;
use EscolaLms\Translations\Models\LanguageLine;
use Illuminate\Database\Eloquent\Builder;

class OrderCriterion extends Criterion
{
    /**
     * @param Builder<LanguageLine> $query
     * @return Builder<LanguageLine>
     */
    public function apply(Builder $query): Builder
    {
        return $query->orderBy($this->key, $this->value);
    }
}
