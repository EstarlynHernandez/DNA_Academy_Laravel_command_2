<?php

use App\Http\Controllers\MediaVotiController;
use App\Http\Controllers\SchoolController;
use App\Http\Controllers\StudentController;
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

//Studenti
Route::get('/students', [StudentController::class, 'index'])->name('student.index');
Route::delete('/student/delete', [StudentController::class, 'destroy'])->name('student.delete');
Route::get('/students/media', [MediaVotiController::class, 'index']);

//Scuole
Route::get('/', [SchoolController::class, 'index'])->name('school.index');
Route::get('/schools/salari', [SchoolController::class, 'mediaSalari'])->name('school.salary');
Route::get('/schools/media', [SchoolController::class, 'mediaScuola'])->name('school.media');
Route::get('/schools/students', [SchoolController::class, 'mediaScuola'])->name('school.studenti');
Route::delete('/school/delete', [SchoolController::class, 'destroy'])->name('school.delete');
