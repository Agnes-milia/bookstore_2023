<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    use RefreshDatabase;

    public function test_user_database(): void
    {
        User::factory()->count(3)->create();
        $this->assertDatabaseCount("users", 5);
        $this->assertDatabaseHas('users', [
            'email' => 'konyvtaros@gmail.com',
        ]);
        $this->assertDatabaseMissing('users', [
            'email' => 'sally@example.com',
        ]);
    }
    
}
