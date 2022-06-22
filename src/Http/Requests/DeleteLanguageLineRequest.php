<?php

namespace EscolaLms\Translations\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Gate;
use Spatie\TranslationLoader\LanguageLine;

class DeleteLanguageLineRequest extends FormRequest
{
    public function authorize(): bool
    {
        return Gate::allows('delete', $this->getLanguageLine());
    }

    public function rules(): array
    {
        return [];
    }

    public function getLanguageLine(): LanguageLine
    {
        return LanguageLine::findOrFail($this->route('id'));
    }
}