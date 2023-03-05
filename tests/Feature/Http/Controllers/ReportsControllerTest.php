<?php

namespace Http\Controllers;

use App\Models\Enums\InformationType;
use App\Models\Information;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;


class ReportsControllerTest extends TestCase
{
    use RefreshDatabase;

    public function test()
    {
        Information::factory(20)->sequence(
            ['type' => InformationType::LOCATION, 'content' => 'aaa'],
            ['type' => InformationType::LOCATION, 'content' => 'aaa'],
            ['type' => InformationType::LOCATION, 'content' => 'bb'],
            ['type' => InformationType::LOCATION, 'content' => 'ccc'],
            ['type' => InformationType::LOCATION, 'content' => 'ccc'],
            ['type' => InformationType::LOCATION, 'content' => 'ccc'],
        )->create();

        $this->getJson(route('reports'))
            ->assertOk()
            ->assertJsonCount(3, 'data')
            ->assertJsonStructure([
                'data' => [
                    '*' => [
                        'type',
                        'content',
                        'total',
                    ],
                ]
            ]);
    }
}
