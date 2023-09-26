<?php

use App\Http\Controllers\BookController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
//alap útvonalak
Route::get('/api/books', [BookController::class, 'index']);
Route::get('/api/books/{id}', [BookController::class, 'show']);
Route::delete('/api/books/{id}', [BookController::class, 'destroy']);
Route::post('/api/books', [BookController::class, 'store']);
Route::put('/api/books/{id}', [BookController::class, 'update']);
//Route::patch('/api/books/{id}', [BookController::class, 'update']);

//view útvonalak
Route::get('/book/list', [BookController::class, 'listView']);
