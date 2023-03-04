<?php

namespace Models;

use App\Models\Contact;
use App\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class InformationTest extends TestCase
{
    use RefreshDatabase;

    public function testCanCreateInformation()
    {
        Information::factory()->create();
        $this->assertDatabaseCount(Information::class, 1);
    }

    public function testInformationBelongsToContact()
    {
        $information = Information::factory()->create();

        $this->assertDatabaseCount(Contact::class, 1);

        $this->assertInstanceOf(Contact::class, $information->contact);
    }

    public function testInformationDeletesOnContactDeletion()
    {
        $information = Information::factory()->create();

        $information->contact()->delete();

        $this->assertDatabaseCount(Information::class, 0);
    }
}
