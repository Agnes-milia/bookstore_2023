<?php

namespace App\Http\Controllers;

use App\Models\Copy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CopyController extends Controller
{
    public function index(){
        return Copy::all();
    }

    public function show($id){
        return Copy::find($id);
    }

    public function destroy($id){
        return Copy::find($id)->delete();
    }

    public function store(Request $request){
        $copy = new Copy();
        $copy->publication = $request->publication;
        $copy->book_id = $request->book_id;
        $copy->hardcovered = $request->hardcovered;
        $copy->status = $request->status;
        $copy->save();
    }

    public function update(Request $request, $id){
        $copy = Copy::find($id);
        $copy->publication = $request->publication;
        //csak patch lehet!
        //$copy->book_id = $request->book_id;
        $copy->hardcovered = $request->hardcovered;
        $copy->status = $request->status;
        $copy->save();
    }

    public function bookCopyLending() {
        $copies = Copy::with('book')->with('lending')->get();
        return $copies;
    }

    public function moreLendings($copy_id, $db){
        //bejelentkezett felh azon kölcsönzései a példány kódjával, ahol a példányt legalább 2 $db -szer kikölcsönözte 
        $user = Auth::user();
        $lendings = DB::table('lendings as l')
        ->selectRaw('count(l.copy_id) as number_of_copies, l.copy_id')
        ->join('copies as c', 'l.copy_id','=','c.copy_id')
        ->where('l.user_id', $user->id)
        ->where('l.copy_id', $copy_id)
        ->groupBy('l.copy_id')
        ->having('number_of_copies', '>=', $db)
        ->get();

        return $lendings;
    }

}
