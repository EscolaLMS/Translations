<?php

namespace EscolaLms\Translations\Policies;

use EscolaLms\Auth\Models\User;
use EscolaLms\Translations\Enum\TranslationsPermissionsEnum;
use Illuminate\Auth\Access\HandlesAuthorization;
use Spatie\TranslationLoader\LanguageLine;

class LanguageLinePolicy
{
    use HandlesAuthorization;

    public function list(User $user): bool
    {
        return $user->can(TranslationsPermissionsEnum::TRANSLATION_LIST);
    }

    public function read(User $user, LanguageLine $languageLine): bool
    {
        return $user->can(TranslationsPermissionsEnum::TRANSLATION_READ);
    }

    public function create(User $user): bool
    {
        return $user->can(TranslationsPermissionsEnum::TRANSLATION_CREATE);
    }

    public function delete(User $user, LanguageLine $languageLine): bool
    {
        return $user->can(TranslationsPermissionsEnum::TRANSLATION_DELETE);
    }

    public function update(User $user, LanguageLine $languageLine): bool
    {
        return $user->can(TranslationsPermissionsEnum::TRANSLATION_UPDATE);
    }
}