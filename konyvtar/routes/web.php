<?php

use App\Http\Controllers\BookController;
use App\Http\Controllers\CopyController;
use App\Http\Controllers\LendingController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UserController;
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

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});


//admin útvonalak
Route::middleware( ['admin'])->group(function () {
    Route::apiResource('/api/copies', CopyController::class);
});

//basic útvonalak
Route::middleware( ['auth.basic'])->group(function () {
    Route::apiResource('/api/books', BookController::class);
    Route::apiResource('/api/users', UserController::class);
    Route::patch('api/password_modify/{id}', [UserController::class, 'updatePassword']);
    Route::get('/api/lendings', [LendingController::class, 'index']);
    Route::get('/api/lendings/{user_id}/{copy_id}/{start}', [LendingController::class, 'show']);
    Route::post('/api/lendings', [LendingController::class, 'store']);
    //with fg-ek
    Route::get('/with/copies', [BookController::class, 'bookCopy']);
    Route::get('/with/user_lendings', [LendingController::class, 'lendingsByUser']);
    Route::get('/with/book_copy_lendings', [CopyController::class, 'bookCopyLending']);
    Route::get('/with/lendings_count_user', [LendingController::class, 'lendingsCountByUser']);
    Route::get('/with/book_copies/{title}', [BookController::class, 'bookCopies']);
});

//bejelentkezés nélkül - nem kell group

require __DIR__.'/auth.php';
