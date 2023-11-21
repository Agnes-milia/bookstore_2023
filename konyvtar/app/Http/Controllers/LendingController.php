<?php

namespace App\Http\Controllers;

use App\Models\Lending;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LendingController extends Controller
{
    public function index(){
        return Lending::all();
    }

    public function show ($user_id, $copy_id, $start)
    {
        $lending = Lending::where('user_id', $user_id)->where('copy_id', $copy_id)->where('start', $start)->get();
        return $lending[0];
        //ez ugyanaz másképp
        //return Lending::where('user_id', $user_id)->where('copy_id', $copy_id)->where('start', $start)->first();
    }

    public function destroy($user_id, $copy_id, $start){
        return LendingController::show($user_id, $copy_id, $start)->delete();
    }

    public function store(Request $request){
        $lending = new Lending();
        $lending->user_id = $request->user_id;
        $lending->copy_id = $request->copy_id;
        $lending->start = $request->start;
        $lending->save();
    }

    public function update(Request $request){
        $lending = new Lending();
        //csak patch!!
        $lending->notice = $request->notice;
        $lending->end = $request->end;
        $lending->save();
    }

    public function lendingsByUser(){
        $user = Auth::user();	//bejelentkezett felhasználó
        $lendings = Lending::with('user')->where('user_id','=',$user->id)->get();
        return $lendings;
    }

    public function lendingsCountByUser()
    {
        $user = Auth::user();	//bejelentkezett felhasználó
        $lendings = Lending::with('user')->where('user_id','=', $user->id)->distinct('copy_id')->count();
        return $lendings;
    }
}
