<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class WelcomeTest extends TestCase
{
    /**
     * A basic feature test example.
     */
    public function testHas(): void
    {
        $wanted1 = "Laravel";
        $wanted2 = "<title>Back-end</title>";
        $response = $this->get('/');
        $response->assertStatus(200);
        $response->assertSee($wanted1);
        $response->assertDontSee($wanted2, false);
    }
}
