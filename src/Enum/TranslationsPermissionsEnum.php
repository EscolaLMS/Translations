<?php

namespace EscolaLms\Translations\Enum;

use EscolaLms\Core\Enums\BasicEnum;

class TranslationsPermissionsEnum extends BasicEnum
{
    public const TRANSLATIONS_LIST = 'translations_list';
    public const TRANSLATIONS_CREATE = 'translations_create';
    public const TRANSLATIONS_READ = 'translations_read';
    public const TRANSLATIONS_UPDATE = 'translations_update';
    public const TRANSLATIONS_DELETE = 'translations_delete';
}