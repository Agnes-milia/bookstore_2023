<?php

namespace Tests\Feature;

use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class DatabaseTest extends TestCase
{
    //minden teszt után az adatbázis visszaáll az eredeti állapotába:
    use RefreshDatabase;

    public function test_user_database()
    {
        User::factory()->count(3)->create();
        //eredetileg van az adatbázisban 2 user
        $this->assertDatabaseCount('users', 5);
        $this->assertDatabaseHas('users', [
            'email' => 'konyvtaros@gmail.com',
        ]);
        $this->assertDatabaseMissing('users', [
            'email' => 'sally@example.com',
        ]);
    }
}

