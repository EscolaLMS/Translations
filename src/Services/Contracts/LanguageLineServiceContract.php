<?php

namespace EscolaLms\Translations\Services\Contracts;

use EscolaLms\Core\Dtos\OrderDto;
use EscolaLms\Translations\Dto\PublicTranslationListCriteriaDto;
use EscolaLms\Translations\Enum\ConstantEnum;
use EscolaLms\Translations\Models\LanguageLine;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Collection;

interface LanguageLineServiceContract
{
    /**
     * @param OrderDto $orderDto
     * @param array<string, mixed> $search
     * @return Builder<LanguageLine>
     */
    public function getList(OrderDto $orderDto, array $search = []): Builder;

    /**
     * @param PublicTranslationListCriteriaDto $searchDto
     * @param int $perPage
     * @return LengthAwarePaginator<LanguageLine>|Collection<int, LanguageLine>
     */
    public function getPublicLanguageLinesPaginatedList(PublicTranslationListCriteriaDto $searchDto, int $perPage = ConstantEnum::PER_PAGE): LengthAwarePaginator|Collection;

    /**
     * @param array<string, mixed> $data
     * @return LanguageLine
     */
    public function create(array $data): LanguageLine;

    /**
     * @param LanguageLine $languageLine
     * @param array<string, mixed> $data
     * @return LanguageLine
     */
    public function update(LanguageLine $languageLine, array $data): LanguageLine;
    public function delete(LanguageLine $languageLine): bool;
}
