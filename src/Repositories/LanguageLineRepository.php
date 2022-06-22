<?php

namespace EscolaLms\Translations\Repositories;

use EscolaLms\Core\Repositories\BaseRepository;
use EscolaLms\Translations\Repositories\Contracts\LanguageLineRepositoryContract;
use Spatie\TranslationLoader\LanguageLine;
use Illuminate\Database\Eloquent\Builder;

class LanguageLineRepository extends BaseRepository implements LanguageLineRepositoryContract
{
    protected $fieldSearchable = [
        'group',
        'key',
    ];

    public function getFieldsSearchable(): array
    {
        return $this->fieldSearchable;
    }

    public function model(): string
    {
        return LanguageLine::class;
    }

    public function allQueryBuilder(array $search = [], array $criteria = []): Builder
    {
        $query = $this->allQuery($search);

        if (!empty($criteria)) {
            $query = $this->applyCriteria($query, $criteria);
        }

        return $query;
    }
}