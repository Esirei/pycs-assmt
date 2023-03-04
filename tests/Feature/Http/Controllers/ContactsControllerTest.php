<?php

namespace Http\Controllers;

use App\Models\Contact;
use App\Models\Enums\InformationType;
use App\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function testContactIndex()
    {
        Contact::factory(20)->has(Information::factory(3))->create();

        $this->getJson(route('contacts.index'))
            ->assertOk()
            ->assertJsonStructure([
                'data',
                'current_page',
                'next_page_url',
                'prev_page_url',
                'to',
                'total'
            ])
            ->assertJsonCount(15, 'data');
    }

    public function testStoreContact()
    {
        $input = [
            'name' => fake()->name,
            'photo' => fake()->imageUrl,
            'information' => [
                ['type' => fake()->randomElement(InformationType::cases()), 'content' => fake()->word],
                ['type' => fake()->randomElement(InformationType::cases()), 'content' => fake()->word],
                ['type' => fake()->randomElement(InformationType::cases()), 'content' => fake()->word],
            ],
        ];

        $this->postJson(route('contacts.store'), $input)
            ->assertOk();

        $this->assertDatabaseCount(Contact::class, 1);
        $this->assertDatabaseCount(Information::class, 3);
    }

    public function testUpdateContact()
    {
        $contact = Contact::factory()->has(Information::factory(3))->create();

        $input = [
            'name' => fake()->name,
            'photo' => fake()->imageUrl,
            'information' => [
                ...Information::get(),
                ['type' => fake()->randomElement(InformationType::cases()), 'content' => fake()->word],
                ['type' => fake()->randomElement(InformationType::cases()), 'content' => fake()->word],
            ],
        ];

        $this->patchJson(route('contacts.update', $contact), $input)
            ->assertOk();

        $this->assertDatabaseCount(Contact::class, 1);
        $this->assertDatabaseCount(Information::class, 5);
    }

    public function testShowContact()
    {
        $contact = Contact::factory()->has(Information::factory(3))->create();

        $this->getJson(route('contacts.show', $contact))
            ->assertOk()
            ->assertJsonStructure([
                'name',
                'last_name',
                'photo',
                'company',
                'information' => [
                    '*' => [
                        'type',
                        'content',
                    ],
                ]
            ])
            ->assertJson($contact->toArray());
    }

    public function testDeleteContact()
    {
        $contact = Contact::factory()->has(Information::factory(3))->create();

        $this->deleteJson(route('contacts.destroy', $contact))
            ->assertOk();

        $this->assertDatabaseCount(Contact::class, 0);
        $this->assertDatabaseCount(Information::class, 0);
    }
}
