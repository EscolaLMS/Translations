<?php

namespace EscolaLms\Translations\Services;

use EscolaLms\Core\Dtos\OrderDto;
use EscolaLms\Core\Repositories\Criteria\Criterion;
use EscolaLms\Translations\Dto\PublicTranslationListCriteriaDto;
use EscolaLms\Translations\Models\LanguageLine;
use EscolaLms\Translations\Enum\ConstantEnum;
use EscolaLms\Translations\Repositories\Contracts\LanguageLineRepositoryContract;
use EscolaLms\Translations\Repositories\Criteria\OrderCriterion;
use EscolaLms\Translations\Services\Contracts\LanguageLineServiceContract;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

class LanguageLineService implements LanguageLineServiceContract
{
    private LanguageLineRepositoryContract $languageLineRepository;

    public function __construct(LanguageLineRepositoryContract $lineRepository)
    {
        $this->languageLineRepository = $lineRepository;
    }

    /**
     * @param OrderDto $orderDto
     * @param array<string, mixed> $search
     * @return Builder<LanguageLine>
     */
    public function getList(OrderDto $orderDto, array $search = []): Builder
    {
        $criteria = $this->prepareCriteria($orderDto);

        return $this->languageLineRepository
            ->allQueryBuilder($search, $criteria);
    }

    /**
     * @param PublicTranslationListCriteriaDto $searchDto
     * @param int $perPage
     * @return LengthAwarePaginator<LanguageLine>|Collection<int, LanguageLine>
     */
    public function getPublicLanguageLinesPaginatedList(PublicTranslationListCriteriaDto $searchDto, int $perPage = ConstantEnum::PER_PAGE): LengthAwarePaginator|Collection
    {
        $result = $this->languageLineRepository
            ->allQueryBuilder([], $searchDto->toArray());
        return $perPage <= 0 ? $result->get() : $result->paginate($perPage);
    }

    /**
     * @param array<string, mixed> $data
     * @return LanguageLine
     */
    public function create(array $data): LanguageLine
    {
        /** @var LanguageLine $model */
        $model = $this->languageLineRepository->create($data);
        return $model;
    }

    /**
     * @param LanguageLine $languageLine
     * @param array<string, mixed> $data
     * @return LanguageLine
     */
    public function update(LanguageLine $languageLine, array $data): LanguageLine
    {
        /** @var LanguageLine $model */
        $model = $this->languageLineRepository->update($data, $languageLine->getKey());
        return $model;
    }

    public function delete(LanguageLine $languageLine): bool
    {
        return $this->languageLineRepository->delete($languageLine->getKey()) ?? false;
    }

    /**
     * @param OrderDto $orderDto
     * @return array<int, Criterion>
     */
    private function prepareCriteria(OrderDto $orderDto): array
    {
        $criteria = [];

        if (!is_null($orderDto->getOrder())) {
            $criteria[] = new OrderCriterion($orderDto->getOrderBy(), $orderDto->getOrder());
        }

        return $criteria;
    }
}
