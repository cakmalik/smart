<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\Bakid\Dormitory;
use Illuminate\Http\Request;

class RoomController extends Controller
{
    public function getRoomsByDormitory(Dormitory $dormitory)
    {
        $rooms = $dormitory->rooms;
        // get rooms where capacity is not full
        // dd($rooms);
        $rooms = $rooms->filter(function ($room) {
            // return $room->capacity > $room->students->count();
            return $room->capacity > $room->current_capacity;
        });

        // dd($rooms);
        return response()->json($rooms);
    }
}
