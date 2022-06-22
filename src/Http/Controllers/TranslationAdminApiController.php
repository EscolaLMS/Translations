<?php

namespace EscolaLms\Translations\Http\Controllers;

use EscolaLms\Core\Dtos\OrderDto;
use EscolaLms\Core\Http\Controllers\EscolaLmsBaseController;
use EscolaLms\Translations\Enum\ConstantEnum;
use EscolaLms\Translations\Http\Requests\CreateLanguageLineRequest;
use EscolaLms\Translations\Http\Requests\DeleteLanguageLineRequest;
use EscolaLms\Translations\Http\Requests\ListLanguageLineRequest;
use EscolaLms\Translations\Http\Requests\ReadLanguageLineRequest;
use EscolaLms\Translations\Http\Requests\UpdateLanguageLineRequest;
use EscolaLms\Translations\Http\Resources\LanguageLineAdminResource;
use EscolaLms\Translations\Http\Swagger\TranslationAdminApiSwagger;
use EscolaLms\Translations\Services\Contracts\LanguageLineServiceContract;
use Illuminate\Http\JsonResponse;

class TranslationAdminApiController extends EscolaLmsBaseController implements TranslationAdminApiSwagger
{
    private LanguageLineServiceContract $languageLineService;

    public function __construct(LanguageLineServiceContract $languageLineService)
    {
        $this->languageLineService = $languageLineService;
    }

    public function index(ListLanguageLineRequest $request): JsonResponse
    {
        $search = $request->except(['limit', 'skip', 'order', 'order_by']);
        $orderDto = OrderDto::instantiateFromRequest($request);

        $languageLines = $this->languageLineService
            ->getList($orderDto, $search)
            ->paginate($request->get('per_page') ?? ConstantEnum::PER_PAGE);

        return $this->sendResponseForResource(
            LanguageLineAdminResource::collection($languageLines),
            __('Language lines retrieved successfully')
        );
    }

    public function store(CreateLanguageLineRequest $request): JsonResponse
    {
        $languageLine = $this->languageLineService->create($request->validated());

        return $this->sendResponseForResource(
            LanguageLineAdminResource::make($languageLine),
            __('Language line saved successfully')
        );
    }

    public function show(ReadLanguageLineRequest $request): JsonResponse
    {
        return $this->sendResponseForResource(LanguageLineAdminResource::make($request->getLanguageLine()));
    }

    public function update(UpdateLanguageLineRequest $request): JsonResponse
    {
        $languageLine = $this->languageLineService->update($request->getLanguageLine(), $request->validated());

        return $this->sendResponseForResource(
            LanguageLineAdminResource::make($languageLine),
            __('Language line updated successfully')
        );
    }

    public function delete(DeleteLanguageLineRequest $request): JsonResponse
    {
        if (!$this->languageLineService->delete($request->getLanguageLine())) {
            return $this->sendError(__('Error while deleting a language line'));
        }

        return $this->sendSuccess(__('Language line deleted successfully'));
    }
}