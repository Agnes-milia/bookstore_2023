<?php

namespace Tests\Unit;

use App\Room;
use PHPUnit\Framework\TestCase;

class RoomTest extends TestCase
{
    public function testRoomHas()
    {
        $room = new Room(["Jack", "Peter", "Amy"]); // Create a new room
        $this->assertTrue($room->has("Jack")); // Expect true
        $this->assertFalse($room->has("Eric")); // Expect false
    }

    public function testRoomAdd()
    {
        $room = new Room(["Jack"]); // Create a new room
        $this->assertContains("Peter", $room->add("Peter"));
    }

    public function testRoomRemove()
    {
        $room = new Room(["Bonnie", "Clyde"]); // Create a new room
        $this->assertCount(1, $room->remove("Bonnie"));
        $room->takeOne();
        $this->assertNull($room->takeOne());
    }


}
