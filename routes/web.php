<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\TaskController;
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
Route::GET('/tasks/status:pending',[TaskController::class,'taskTermine'])->name('taskpending');
Route::get('/test-notif', [TaskController::class, 'notification'])->name('envoyer');

Route::PATCH('/tasks/{id}/updateStatus',[TaskController::class,'updateStatus'])->name('tasks.updateStatus');
Route::resource('tasks', TaskController::class);
// Route::get('/tasks',[TaskController::class,'index'])->name('tasks.index');
// Route::get('/tasks/create',[TaskController::class,'create'])->name('tasks.create');
// Route::post('/tasks/store',[TaskController::class,'store'])->name('tasks.store');
require __DIR__.'/auth.php';
