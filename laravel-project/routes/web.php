<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ViewController;
use App\Http\Controllers\NewPostController;
use App\Http\Controllers\ThreadController;
use App\Http\Controllers\ReplyController;
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

Route::get('/home',[ViewController::class,'index'])->name('home');

Route::get('/threads',[ThreadController::class,'index'])->name('threads')->withoutMiddleware('auth');

Route::get('/threads/show-create',[ThreadController::class,'create'])->name('posts.create');
Route::post('/threads/create',[ThreadController::class,'store'])->name('posts.save');

Route::get('/threads/show-logical-deleted',[ThreadController::class,'showdeleted'])->name('show.deleted');
Route::put('/threads/{id}/rollback',[ThreadController::class,'rollback'])->name('rollback');

Route::get('/threads/show-edit',[ThreadController::class,'showedit'])->name('show.edit');
Route::get('/threads/{id}/edit',[ThreadController::class,'edit'])->name('threads.edit');
Route::put('/threads/{id}/update',[ThreadController::class,'update'])->name('threads.update');
Route::delete('/threads/{id}/delete',[ThreadController::class,'destroy'])->name('threads.delete');
Route::delete('/threads/{id}/logical_delete',[ThreadController::class,'logical_delete'])->name('threads.logical_delete');

Route::get('/threads/{id}/reply',[ReplyController::class,'index'])->name('threads.show-reply');
Route::post('/threads/{id}/',[ReplyController::class,'store'])->name('threads.reply');

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

require __DIR__.'/auth.php';