<?php

namespace EscolaLms\Translations\Repositories;

use EscolaLms\Core\Repositories\BaseRepository;
use EscolaLms\Core\Repositories\Criteria\Criterion;
use EscolaLms\Translations\Models\LanguageLine;
use EscolaLms\Translations\Repositories\Contracts\LanguageLineRepositoryContract;
use Illuminate\Database\Eloquent\Builder;

class LanguageLineRepository extends BaseRepository implements LanguageLineRepositoryContract
{
    /**
     * @var array<int, string>
     */
    protected array $fieldSearchable = [
        'group',
        'key',
        'public'
    ];

    /**
     * @return array<int, string>
     */
    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return LanguageLine::class;
    }

    /**
     * @param array<string, mixed> $search
     * @param array<int, Criterion> $criteria
     * @return Builder<LanguageLine>
     */
    public function allQueryBuilder(array $search = [], array $criteria = []): Builder
    {
        $query = $this->allQuery($search);

        if (!empty($criteria)) {
            $query = $this->applyCriteria($query, $criteria);
        }

        return $query;
    }
}
