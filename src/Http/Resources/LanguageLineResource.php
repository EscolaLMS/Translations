<?php

namespace EscolaLms\Translations\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageLineResource extends JsonResource
{
    /**
     * @return array<string, mixed>
     */
    public function toArray($request): array
    {
        return [
            'id' => $this->resource->id,
            'group' => $this->resource->group,
            'key' => $this->resource->key,
            'text' => $this->resource->text
        ];
    }
}
