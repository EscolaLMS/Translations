<?php

namespace EscolaLms\Translations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

/**
 * @OA\Schema(
 *      schema="retrieve-translation-request",
 *      required={"key"},
 *      @OA\Property(
 *          property="key",
 *          description="key",
 *          type="string"
 *      ),
 *      @OA\Property(
 *          property="replace",
 *          description="replace",
 *          type="object"
 *      )
 * )
 *
 */

class RetrieveTranslationRequest extends FormRequest
{
    /**
     * @return array<string, array<int, string>>
     */
    public function rules(): array
    {
        return [
            'key' => ['required', 'string'],
            'replace' => ['sometimes', 'array'],
        ];
    }

    public function getKey(): string
    {
        return $this->get('key');
    }

    /**
     * @return array<string, string>
     */
    public function getReplace(): array
    {
        return $this->get('replace', []);
    }
}
