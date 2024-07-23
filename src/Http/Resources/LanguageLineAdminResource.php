<?php

namespace EscolaLms\Translations\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class LanguageLineAdminResource extends JsonResource
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
            'text' => $this->resource->text,
            'public' => $this->resource->public,
            'created_at' => $this->resource->created_at,
            'updated_at' => $this->resource->updated_at,
        ];
    }
}
