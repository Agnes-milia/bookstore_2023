<?php

namespace Tests\Unit;

use App\Room;
use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
{
    /**
     * A basic unit test example.
     */
    public function test_example(): void
    {
        $this->assertTrue(true);
    }

    public function testRoomHas()
    {
        $room = new Room(["Jack", "Peter", "Amy"]); // Create a new room
        $this->assertTrue($room->has("Jack")); // Expect true
        $this->assertFalse($room->has("Eric")); // Expect false
    }

}
