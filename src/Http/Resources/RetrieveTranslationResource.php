<?php

namespace EscolaLms\Translations\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class RetrieveTranslationResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'key' => $this->resource->key,
            'value' => $this->resource->value,
        ];
    }
}
