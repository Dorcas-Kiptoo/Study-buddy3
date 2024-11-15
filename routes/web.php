<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\TutorPageController;
use App\Http\Controllers\SubjectPageController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\TutorController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\StudentDashboardController;
use App\Http\Controllers\CourseController;

Route::get('/', function () {
    return view('index');
});

Route::get('/about', function () {
    return view('about');
});

Route::get('/register-student', function () {
    return view('register-student');
});

Route::get('/register-tutor', function () {
    return view('register-tutor');
});

Route::get('/login', function () {
    return view('login');
});

Route::get('/subject', function () {
    return view('subject');
});

Route::get('/tutor', function () {
    return view('tutor');
});

Route::get('/subject-detail', function () {
    return view('subject-detail');
});

Route::get('/tutor-detail', function () {
    return view('tutor-detail');
});

Route::get('/book-lesson', function () {
    return view('book-lesson');
});

Route::get('/edit-details', function () {
    if (!Auth::check() || Auth::user()->role != 'Student') {
        return redirect('/');
    }
    return view('edit-details');
})->name('edit-details');

Route::group(['middleware' => ['auth']], function () {
    Route::get('/dashboard', [DashboardController::class, 'showDashboard'])->name('dashboard');
    Route::get('/student-dashboard', [DashboardController::class, 'studentDashboard'])->name('student-dashboard');
    Route::get('/tutor-dashboard', [DashboardController::class, 'tutorDashboard'])->name('tutor-dashboard');
    Route::get('/admin-dashboard', [DashboardController::class, 'adminDashboard'])->name('admin-dashboard');
});

Route::post('/register-student', [AuthController::class, 'registerStudent']);
Route::post('/register-tutor', [AuthController::class, 'registerTutor']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');

Route::get('/admin-dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');
Route::post('/approve-tutor/{id}', [AdminController::class, 'approveTutor'])->name('admin.approveTutor');
Route::post('/subjects/{id}/add-image', [AdminController::class, 'addImage'])->name('admin.addImage');
Route::post('/subjects/{id}/add-description', [AdminController::class, 'addDescription'])->name('admin.addDescription');

Route::get('/tutor', [TutorPageController::class, 'index'])->name('tutors.index');
Route::get('/subject', [SubjectPageController::class, 'index'])->name('subjects.index');
Route::get('/', [HomeController::class, 'index'])->name('home.index');

Route::get('/tutor-dashboard', [TutorController::class, 'tutorDashboard'])->name('tutor.dashboard');
Route::post('/subjects/{subjectId}/set-price', [TutorController::class, 'setPrice'])->name('tutor.setPrice');
Route::post('/subjects/{subjectId}/set-duration', [TutorController::class, 'setDuration'])->name('tutor.setDuration');
Route::post('/sessions/{sessionId}/complete', [TutorController::class, 'completeSession'])->name('tutor.completeSession');
Route::post('/sessions/{sessionId}/cancel', [TutorController::class, 'cancelSession'])->name('tutor.cancelSession');
Route::post('/sessions/{sessionId}/add-meet-link', [TutorController::class, 'addMeetLink'])->name('tutor.addMeetLink');
Route::post('/availability/set', [TutorController::class, 'setAvailability'])->name('tutor.setAvailability');
Route::post('/subjects/add', [TutorController::class, 'addSubject'])->name('tutor.addSubject');

Route::get('/tutor-unverified', function () {
    return view('tutor-unverified');
})->name('tutor.unverified');

Route::get('/subject', [SubjectPageController::class, 'index'])->name('subject.index');
Route::get('/subject-detail/{subjectId}/{tutorId}', [SubjectPageController::class, 'show']);

Route::post('/update-profile', [ProfileController::class, 'updateProfile'])->name('update-profile');
Route::post('/update-profile-photo', [ProfileController::class, 'updateProfilePhoto'])->name('update-profile-photo');

Route::middleware(['auth'])->group(function () {
    Route::get('/student-dashboard', [StudentDashboardController::class, 'index'])->name('student-dashboard');
    Route::get('/rate-session/{sessionId}', [StudentDashboardController::class, 'showRatePage'])->name('rate-session');
    Route::post('/rate-session/{sessionId}', [StudentDashboardController::class, 'rateSession']);
});

Route::get('/subject-detail/{subjectId}/{tutorId}', [CourseController::class, 'showSubjectDetail'])->name('subject.detail');
Route::get('/book-lesson/{subjectId}/{tutorId}', [CourseController::class, 'bookLesson'])->name('book-lesson');
Route::post('/book-session', [CourseController::class, 'bookSession'])->name('book-session');
