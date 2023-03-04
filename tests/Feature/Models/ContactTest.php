<?php

namespace Models;

use App\Models\Contact;
use App\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ContactTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateContact()
    {
        Contact::factory()->create();
        $this->assertDatabaseCount(Contact::class, 1);
    }

    public function testContactHasInformation()
    {
        $contact = Contact::factory()->has(Information::factory())->create();

        $this->assertDatabaseCount(Information::class, 1);

        $this->assertCount(1, $contact->information);
        $this->assertInstanceOf(Information::class, $contact->information->first());
    }
}
