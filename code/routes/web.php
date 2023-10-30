<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BookCatagoryController;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReaderController;
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

//Admin Routes
Route::prefix('admin')->group(function () {
    Route::get('/login',[AdminController::class,'index'])->name('admin.index');
    Route::post('/login/owner',[AdminController::class,'checklogin'])->name('admin.login');
    Route::get('/dashboard',[AdminController::class,'dashboard'])->name('admin.dashboard')->middleware('admin');
    Route::get('/logout',[AdminController::class,'adminlogout'])->name('admin.logout')->middleware('admin');

    //master->book
    Route::get('/book',[BookController::class,'index'])->name('book');
    Route::post('/book',[BookController::class,'store']);
    Route::post('/book/assign_book',[BookController::class,'assignbook']);
    Route::get('/book/create', [BookController::class,'create']);
    Route::get('/book/{id}', [BookController::class,'show']);
    Route::put('/book/{id}', [BookController::class,'update']);
    Route::delete('/book/{id}', [BookController::class,'destroy']);

    //book Category
    Route::resource('/book-category',BookCatagoryController::class);

    //User
    Route::resource('/user',UserController::class);
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

//User Routes
Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/book',[BookController::class,'index'])->name('book');
    Route::get('/book/create', [BookController::class,'create']);
    Route::get('/book/{id}', [BookController::class,'show']);
    Route::put('/book/{id}', [BookController::class,'update']);
});

//Reader Routes
Route::prefix('reader')->group(function () {
    Route::get('/login',[ReaderController::class,'index'])->name('reader.index');
    Route::post('/login/owner',[ReaderController::class,'checklogin'])->name('reader.login');

    Route::get('/register',[ReaderController::class,'register_index'])->name('reader.registerindex');
    Route::post('/register/create',[ReaderController::class,'register'])->name('reader.register');

    Route::get('/dashboard',[ReaderController::class,'dashboard'])->name('reader.dashboard')->middleware('reader');
    Route::get('/logout',[ReaderController::class,'readerlogout'])->name('reader.logout')->middleware('reader');

    //master->book
    Route::get('/book',[BookController::class,'index'])->name('book');
    Route::get('/book/create', [BookController::class,'create']);
    Route::get('/book/{id}', [BookController::class,'show']);
    Route::put('/book/{id}', [BookController::class,'update']);
});

require __DIR__.'/auth.php';
