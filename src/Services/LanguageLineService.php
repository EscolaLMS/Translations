<?php

namespace EscolaLms\Translations\Services;

use EscolaLms\Core\Dtos\OrderDto;
use EscolaLms\Translations\Repositories\Contracts\LanguageLineRepositoryContract;
use EscolaLms\Translations\Repositories\Criteria\OrderCriterion;
use EscolaLms\Translations\Services\Contracts\LanguageLineServiceContract;
use Illuminate\Database\Eloquent\Builder;
use Spatie\TranslationLoader\LanguageLine;

class LanguageLineService implements LanguageLineServiceContract
{
    private LanguageLineRepositoryContract $languageLineRepository;

    public function __construct(LanguageLineRepositoryContract $lineRepository)
    {
        $this->languageLineRepository = $lineRepository;
    }

    public function getList(OrderDto $orderDto, array $search = [], bool $onlyActive = false): Builder
    {
        $criteria = [];

        if (!is_null($orderDto->getOrder())) {
            $criteria[] = new OrderCriterion($orderDto->getOrderBy(), $orderDto->getOrder());
        }

        return $this->languageLineRepository
            ->allQueryBuilder($search, $criteria);
    }

    public function create(array $data): LanguageLine
    {
        return $this->languageLineRepository->create($data);
    }

    public function update(LanguageLine $languageLine, array $data): LanguageLine
    {
        return $this->languageLineRepository->update($data, $languageLine->getKey());
    }

    public function delete(LanguageLine $languageLine): bool
    {
        return $this->languageLineRepository->delete($languageLine->getKey()) ?? false;
    }
}