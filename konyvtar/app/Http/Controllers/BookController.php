<?php

namespace App\Http\Controllers;

use App\Models\Book;
use App\Models\Copy;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class BookController extends Controller
{
    public function index(){
        return Book::all();
    }

    public function show($id){
        return Book::find($id);
    }

    public function destroy($id){
        return Book::find($id)->delete();
    }

    public function store(Request $request){
        $book = new Book();
        $book->author = $request->author;
        $book->title = $request->title;
        $book->save();
    }

    public function update(Request $request, $id){
        $book = Book::find($id);
        $book->author = $request->author;
        $book->title = $request->title;
        $book->save();
    }

    //view függvények
    public function listView(){
        $books = Book::all();
        return view('book.list', ['books'=>$books]);
    }

    public function editView($id){
        $book = Book::find($id);
        return view('book.edit', ['book'=>$book]);
    }

    public function newView(){
        return view('book.new');
    }

    //with függvényekkel
    public function bookCopy(){
        //a copy a függvény neve!
        $copies = Book::with('copy')->get();
        return $copies;
    }

    public function bookCopies($title)
    {	
        $copies = Book::with('copy')->where('title','=', $title)->get();
        return $copies;
    }

    public function bookPublication($book_id)
    {
        //egy bizonyos könyv (azonosító a bemenet)-höz tartozó példányok (2000 felettiek) megjelenítése
        return DB::table('copies as c')	//egy tábla lehet csak
        ->select('copy_id', 'hardcovered', 'publication', 'status')		//itt nem szükséges
        ->join('books as b' ,'c.book_id','=','b.book_id')
        ->where('c.publication', '>', 2000)
        ->where('b.book_id', $book_id)
        ->get();
    }

    
    public function bookPublication2($book_id)
    {
        //egy bizonyos könyv (azonosító a bemenet)-höz tartozó példányok (2000 felettiek) megjelenítése
        return DB::select("SELECT * FROM copies c
        INNER JOIN books b on b.book_id = c.book_id
        WHERE publication > 2000 and b.book_id = $book_id ");
    }

    public function bookPublicationNumber($book_id)
    {
        //egy bizonyos könyv (azonosító a bemenet)-höz tartozó példányok (2000 felettiek) száma
        return DB::table('copies as c')	//egy tábla lehet csak
        ->join('books as b' ,'c.book_id','=','b.book_id')
        ->where('c.publication', '>', 2000)
        ->where('b.book_id', $book_id)
        ->count();
    }

    public function bookPublicationNumber2($book_id)
    {
        //egy bizonyos könyv (azonosító a bemenet)-höz tartozó példányok (2000 felettiek) számae
        return DB::select("SELECT count(*) as db FROM copies c
        INNER JOIN books b on b.book_id = c.book_id
        WHERE publication > 2000 and b.book_id = $book_id ");
    }
}
