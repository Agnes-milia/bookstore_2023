<?php

namespace App\Http\Controllers;

use App\Models\Reservation;
use Illuminate\Http\Request;

class ReservationController extends Controller
{
    public function index(){
        // SELECT * FROM RESERVATIONS:
        return Reservation::all();
    }

    public function show ($user_id, $book_id, $start)
    {
        $lending = Reservation::where('user_id', $user_id)
        ->where('book_id', $book_id)
        ->where('start', $start)
        ->get();
        return $lending[0];
        //ez ugyanaz másképp
        //return Reservation::where('user_id', $user_id)->where('copy_id', $copy_id)->where('start', $start)->first();
    }

    public function destroy($user_id, $book_id, $start){
        return $this->show($user_id, $book_id, $start)
        ->delete();
    }

    public function store(Request $request){
        $lending = new Reservation();
        $lending->user_id = $request->user_id;
        $lending->book_id = $request->book_id;
        $lending->start = $request->start;
        $lending->message = $request->message;
        $lending->save();
    }

    public function update(Request $request, $user_id, $book_id, $start){
        $lending = $this->show($user_id, $book_id, $start);
        //csak patch!!!
        $lending->message = $request->message;
        $lending->save();
    }
}
