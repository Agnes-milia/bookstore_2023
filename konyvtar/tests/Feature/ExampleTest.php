<?php

namespace Tests\Feature;

// use Illuminate\Foundation\Testing\RefreshDatabase;

use App\Models\Book;
use App\Models\User;
use Tests\TestCase;
use Illuminate\Support\Facades\Auth;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     */
    public function testReturnsResponse(): void
    {
        $response = $this->get('/');
        $response->assertStatus(200);
    }

    public function testGetRoutes(): void
    {
        $response = $this->get('/api/copies');
        $response->assertStatus(200);
    }

    public function testPostRoutes(): void
    {
        $response = $this->post('/api/books', ['author' => "Marquez", 'title' => "Száz év magány"]);
        $response->assertStatus(200);
    }

    public function testUserId() : void {
        //nem rögzíti az adatbázisban
        $user = User::factory()->make();
        $this->withoutMiddleware()->get('/api/users/' . $user->id)
        ->assertStatus(200);
    }

    public function testUserIdAuth() : void {
        $this->withoutExceptionHandling(); 
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/users/' . $user->id); 
        $response->assertStatus(200);
    }

    public function testBookEndPoint(): void
    {
        $response = $this->get('/api/books');
        $response->assertStatus(200);
    }

    public function testAPostResponse() : void
    {
        $response = $this->post('/api/books', ['author' => 'Marquez', 'title' => 'Egy előre bejelentett gyilkosság krónikája']);
        $response->assertStatus(200);
    }

    public function testBookId() : void 
    {
        //a make nem rögzíti az adatbázisban a felh-t
        $book = Book::factory()->make();
        $this->withoutMiddleware()->get('/api/books/' . $book->book_id)
        ->assertStatus(200);
    }

    public function testBookIdAuth() : void 
    {
        $this->withoutExceptionHandling(); 
        // create rögzíti az adatbázisban a felh-t
        $user = User::factory()->create();
        $response = $this->actingAs($user)->get('/api/users/' . $user->id);
        $response->assertStatus(200);
    }
        


}
