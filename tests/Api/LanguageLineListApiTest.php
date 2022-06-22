<?php

namespace EscolaLms\Translations\Tests\Api;

use EscolaLms\Core\Tests\CreatesUsers;
use EscolaLms\Translations\Database\Seeders\TranslationsPermissionSeeder;
use EscolaLms\Translations\Tests\TestCase;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Spatie\TranslationLoader\LanguageLine;

class LanguageLineListApiTest extends TestCase
{
    use DatabaseTransactions, CreatesUsers;

    private LanguageLine $authLanguageLine;
    private LanguageLine $validationLanguageLine;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(TranslationsPermissionSeeder::class);
        $this->admin = $this->makeAdmin();

        $this->authLanguageLine = LanguageLine::create([
            'group' => 'auth',
            'key' => 'failed',
            'text' => ['en' => 'These credentials do not match our records', 'pl' => 'Błędny login lub hasło'],
        ]);

        $this->validationLanguageLine = LanguageLine::create([
            'group' => 'validation',
            'key' => 'attributes.last_name',
            'text' => ['en' => 'last name', 'pl' => 'nazwisko'],
        ]);
    }

    public function testLanguageLineListUnauthorized(): void
    {
        $this->getJson('api/admin/translations')->assertUnauthorized();
    }

    public function testLanguageLineList(): void
    {
        $this->actingAs($this->admin, 'api')->getJson('api/admin/translations')
            ->assertOk()
            ->assertJsonFragment([
                'id' => $this->authLanguageLine->getKey(),
            ])
            ->assertJsonFragment([
                'id' => $this->validationLanguageLine->getKey(),
            ]);
    }

    public function testLanguageLineListFilter(): void
    {
        $this->actingAs($this->admin, 'api')
            ->getJson('api/admin/translations?group=' . $this->validationLanguageLine->group)
            ->assertOk()
            ->assertJsonFragment([
                'id' => $this->validationLanguageLine->getKey(),
            ])
            ->assertJsonMissing([
                'id' => $this->authLanguageLine->getKey(),
            ]);

        $this->actingAs($this->admin, 'api')
            ->getJson('api/admin/translations?key=' . $this->authLanguageLine->key)
            ->assertOk()
            ->assertJsonFragment([
                'id' => $this->authLanguageLine->getKey(),
            ])
            ->assertJsonMissing([
                'id' => $this->validationLanguageLine->getKey(),
            ]);
    }
}