<?php

namespace Models;

use App\Models\Contact;
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
}
