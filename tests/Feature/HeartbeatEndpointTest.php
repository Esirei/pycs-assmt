<?php

namespace Tests\Feature;

use Tests\TestCase;

class HeartbeatEndpointTest extends TestCase
{
    public function testHeartbeat()
    {
        $this->get('heartbeat')
            ->assertOk()
            ->assertJson(['status' => true, 'version' => '9.20.0']);
    }
}
