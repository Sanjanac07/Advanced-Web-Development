<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\StudentSubjectController;
use App\Http\Controllers\MarkController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
*/

// ---------- DEFAULT REDIRECT ----------
Route::get('/', fn () => redirect()->route('login'));

// ---------- AUTH ----------
Route::get('/login', [AuthController::class, 'showLogin'])->name('login');
Route::post('/login', [AuthController::class, 'login'])->name('login.post');

Route::get('/register', [AuthController::class, 'showRegister'])->name('register');
Route::post('/register', [AuthController::class, 'register'])->name('register.post');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ---------- DASHBOARD (role redirect) ----------
Route::middleware('auth')->get('/dashboard', function () {
    $user = auth()->user();
    if (! $user) return redirect()->route('login');

    return $user->role === 'staff'
        ? redirect()->route('staff.dashboard')
        : redirect()->route('student.dashboard');
})->name('dashboard');

// ---------- STUDENT ROUTES ----------
Route::middleware(['auth','role:student'])->group(function () {
    Route::get('/student/dashboard', [StudentController::class, 'dashboard'])->name('student.dashboard');

    // Student subject selection
    Route::get('/student/select-subjects', [StudentSubjectController::class, 'showSubjects'])->name('student.select.subjects');
    Route::post('/student/select-subjects', [StudentSubjectController::class, 'selectSubjects'])->name('student.select.subjects.save');

    // Student view marks
    Route::get('/student/marks', [MarkController::class, 'studentMarks'])->name('student.marks');
});

// ---------- STAFF ROUTES ----------
Route::middleware(['auth','role:staff'])->prefix('staff')->group(function () {
    Route::get('/dashboard', fn () => view('staff.dashboard'))->name('staff.dashboard');

    // Manage Students
    Route::get('/students', [StaffController::class, 'index'])->name('staff.students.index');
    Route::get('/students/{id}/edit', [StaffController::class, 'edit'])->name('staff.students.edit');
    Route::post('/students/{id}', [StaffController::class, 'update'])->name('staff.students.update');

    // Marks Management
    Route::get('/marks', [MarkController::class, 'index'])->name('staff.marks.index');
    Route::get('/marks/create', [MarkController::class, 'create'])->name('staff.marks.create');
    Route::post('/marks', [MarkController::class, 'store'])->name('staff.marks.store');

    // Edit/Update Marks
    Route::get('/marks/{id}/edit', [MarkController::class, 'edit'])->name('staff.marks.edit');
    Route::post('/marks/{id}/update', [MarkController::class, 'update'])->name('staff.marks.update');
});
