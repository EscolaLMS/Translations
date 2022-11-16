<?php

namespace EscolaLms\Translations\Console\Command;

use Illuminate\Console\Command;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Collection;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Lang;
use Spatie\Permission\Models\Permission;

class MergeTranslationsOfPermissionsCommand extends Command
{
    protected $signature = 'translations:merge-permissions';

    protected $description = 'Create files with translations of permissions from other packages';

    private Filesystem $disk;

    private string $path;

    private array $languages;

    private string $fileName;

    public function handle(Filesystem $filesystem): void
    {
        $this->disk = $filesystem;
        $this->path = Config::get('escolalms_translations.lang_path');
        $this->languages = Config::get('escolalms_translations.languages');
        $this->fileName = Config::get('escolalms_translations.permission_translation_file_name');
        $permissions = Permission::all()->pluck('name');
        $this->createEmptyLanguageFiles();

        foreach ($this->languages as $language) {
            $file = "$this->path/$language/$this->fileName.php";
            $content = $this->buildFileContent($file, $language, $permissions);
            $this->writeFile($file, $content);
        }
    }

    private function createEmptyLanguageFiles(): void
    {
        foreach ($this->languages as $language) {
            $directoryPath = "$this->path/$language";
            $file = "$this->fileName.php";
            $fullPath = "$directoryPath/$file";

            if (!$this->disk->exists($fullPath)) {
                if (!$this->disk->exists($directoryPath)) {
                    $this->disk->makeDirectory($directoryPath);
                }
                $this->writeFile($fullPath);
            }
        }
    }

    private function writeFile(string $filePath, array $content = []): void
    {
        $output = "<?php \n\n";
        $output .= "// Do not edit. This file is automatically generated.";
        $output .= "\n\nreturn [ ". $this->buildStringExpression($content) . "\n];";

        file_put_contents($filePath, $output);
    }

    private function buildStringExpression(array $content): string
    {
        $output = '';

        foreach ($content as $key => $value) {
            $value = str_replace('\"', '"', addslashes($value));
            $output .= "\n\t'{$key}' => '{$value}',";
        }

        return $output;
    }

    private function buildFileContent(string $file, string $language, Collection $permissions): array
    {
        $content = include $file;
        foreach ($permissions as $permissionName) {
            $package = explode('_', $permissionName)[0];

            if (Lang::has("$package::permissions.$permissionName", $language)) {
                $content[$permissionName] = Lang::get("$package::permissions.$permissionName", [], $language);
            }
        }

        return $content;
    }
}