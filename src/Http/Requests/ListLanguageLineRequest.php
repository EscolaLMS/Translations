<?php

namespace EscolaLms\Translations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Spatie\TranslationLoader\LanguageLine;

class ListLanguageLineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('list', LanguageLine::class);
    }

    public function rules(): array
    {
        return [];
    }
}