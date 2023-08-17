<?php

use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\Student\TimeTableController;
use App\Http\Controllers\Teacher\TimeTableController as TeacherTimeTableController;
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

Route::middleware(['auth', 'verified'])->group(function () {

    Route::middleware('role:1')->prefix('student')->name('student.')->group(function() {

        Route::get('timetable', [TimeTableController::class, 'index'])->name('timetable');

    });

    Route::middleware('role:2')->prefix('teacher')->name('teacher.')->group(function() {

        Route::get('timetable', [TeacherTimeTableController::class, 'index'])->name('timetable');

    });

    Route::middleware('role:3')->prefix('admin')->name('admin.')->group(function() {

        Route::get('users', [UserController::class, 'users'])->name('users');

    });

});

Route::middleware('auth')->group(function () {

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

});

require __DIR__.'/auth.php';
