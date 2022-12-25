<?php

use Illuminate\Support\Facades\Route;





// ========== LANDING PAGE ========== //
Route::group(['controller' => 'App\Http\Livewire\LandingPage'], function ()
{
    Route::get('/', 'App\Http\Livewire\LandingPage'::class)->name('landing-page');
});



// ========== LOGIN PAGE FOR GUESTS ========== //
Route::group(['controller' => 'App\Http\Livewire\Auth\Login'], function ()
{
    Route::get('/login', App\Http\Livewire\Auth\Login::class)->name("login")->middleware('guest');
    // Route::post('/post-login', 'Login')->name('post-login');
});



// ========== LOGOUT FUNCTION FOR AUTHENTICATED USERS ========== //
Route::post('/logout', 'App\Http\Livewire\Auth\Logout@Logout');



// ========== NEWS ========== //
Route::get('/news', \App\Http\Livewire\AllNews::class);



// ========== DIRECTORY ========== //
Route::group(['prefix' => 'directory'], function ()
{
    Route::name('directory.')->group(function ()
    {
        Route::controller(\App\Http\Livewire\Directory::class)->group(function()
        {
            Route::get('/teacher', \App\Http\Livewire\Directory::class)->name("teacher");
            Route::get('/student', \App\Http\Livewire\Directory::class)->name("student");
        });
    });
});



// ========== DIRECTORY ========== //
Route::get('school-profile', 'App\Http\Livewire\SchoolProfile'::class)->name('school-profile');



// ========== ADMIN SECTION ========== //
Route::group(['prefix' => 'admin'], function ()
{
    Route::name('admin.')->group(function ()
    {
        Route::middleware(['auth', 'auth.role:0'])->group(function ()
        {
            // ========== DASHBOARD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\Dashboard::class)->group(function()
            {
                Route::get('/dashboard', \App\Http\Livewire\Admin\Dashboard::class)->name('dashboard');
            });

            // ========== STUDENT CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\StudentCRUD::class)->group(function()
            {
                Route::get('/student-list', \App\Http\Livewire\Admin\StudentCRUD::class)->name('student-list');
            });

            // ========== TEACHER CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\TeacherCRUD::class)->group(function()
            {
                Route::get('/teacher-list', \App\Http\Livewire\Admin\TeacherCRUD::class)->name('teacher-list');
            });

            // ========== CLASS CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\ClassCRUD::class)->group(function()
            {
                Route::get('/class-list', \App\Http\Livewire\Admin\ClassCRUD::class)->name('class-list');
            });

            // ========== TEACHER TEACHING SUBJECT CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\TeacherTeachingSubjectCRUD::class)->group(function()
            {
                Route::get('/teacher-teaching-subject', \App\Http\Livewire\Admin\TeacherTeachingSubjectCRUD::class)->name('teacher-teaching-subject');
            });

            // ========== SUBJECT CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\SubjectCRUD::class)->group(function()
            {
                Route::get('/subject-list', \App\Http\Livewire\Admin\SubjectCRUD::class)->name('subject-list');
            });

            // ========== EXTRACURRICULAR CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\ExtracurricularCRUD::class)->group(function()
            {
                Route::get('/extracurricular-list', \App\Http\Livewire\Admin\ExtracurricularCRUD::class)->name('extracurricular-list');
            });

            // ========== SCHOOL YEAR CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\SchoolYearCRUD::class)->group(function()
            {
                Route::get('/school-year', \App\Http\Livewire\Admin\SchoolYearCRUD::class)->name('school-year');
            });

            // ========== SCORING SESSION LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\ScoringSessionCRUD::class)->group(function()
            {
                Route::get('/scoring-session', \App\Http\Livewire\Admin\ScoringSessionCRUD::class)->name('scoring-session');
            });

            // ========== NEWS CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\NewsCRUD::class)->group(function()
            {
                Route::get('/news', \App\Http\Livewire\Admin\NewsCRUD::class)->name('news');

                // ========== UPLOAD IMAGE LIVEWIRE ========== //
                Route::post('/upload-image', "UploadImage")->name("upload-image");
            });
        });
    });
});



// ========== TEACHER SECTION ========== //
Route::group(['prefix' => 'teacher'], function ()
{
    Route::name('teacher.')->group(function ()
    {
        Route::middleware(['auth', 'auth.role:1'])->group(function ()
        {
            // ========== DASHBOARD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Teacher\Dashboard::class)->group(function()
            {
                Route::get('/dashboard', \App\Http\Livewire\Teacher\Dashboard::class)->name('dashboard');
            });

            // ========== PROFILE LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Teacher\Profile::class)->group(function()
            {
                Route::get('/profile', \App\Http\Livewire\Teacher\Profile::class)->name('profile');

                // ========== UPDATE PROFILE PICTURE ========== //
                Route::post('/update-profile-picture', "UpdateProfilePicture")->name('update-profile-picture');
            });

            // ========== HOMEROOM CLASS LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\HomeroomClass::class)->group(function()
            {
                Route::get('/homeroom-class', \App\Http\Livewire\Student\HomeroomClass::class)->name('homeroom-class');
            });

            // ========== SUBJECT SCORE LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Teacher\SubjectScoreCRUD::class)->group(function()
            {
                Route::get('/subject-score', \App\Http\Livewire\Teacher\SubjectScoreCRUD::class)->name('subject-score');
            });

            // ========== EXTRACURRICULAR SCORE LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Teacher\ExtracurricularScoreCRUD::class)->group(function()
            {
                Route::get('/extracurricular-score', \App\Http\Livewire\Teacher\ExtracurricularScoreCRUD::class)->name('extracurricular-score');
            });
        });
    });
});



// ========== STUDENT SECTION ========== //
Route::group(['prefix' => 'student'], function ()
{
    Route::name('student.')->group(function ()
    {
        Route::middleware(['auth', 'auth.role:2'])->group(function ()
        {
            // ========== DASHBOARD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\Dashboard::class)->group(function()
            {
                Route::get('/dashboard', \App\Http\Livewire\Student\Dashboard::class)->name('dashboard');
            });

            // ========== PROFILE LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\Profile::class)->group(function()
            {
                Route::get('/profile', \App\Http\Livewire\Student\Profile::class)->name('profile');

                // ========== UPDATE PROFILE PICTURE ========== //
                Route::post('/update-profile-picture', "UpdateProfilePicture")->name('update-profile-picture');
            });

            // ========== HOMEROOM CLASS LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\HomeroomClass::class)->group(function()
            {
                Route::get('/homeroom-class', \App\Http\Livewire\Student\HomeroomClass::class)->name('homeroom-class');
            });

            // ========== SUBJECT LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\Subject::class)->group(function()
            {
                Route::get('/subject', \App\Http\Livewire\Student\Subject::class)->name('subject');
            });

            // ========== EXTRACURRICULAR LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\TakingExtracurricular::class)->group(function()
            {
                Route::get('/extracurricular', \App\Http\Livewire\Student\TakingExtracurricular::class)->name('extracurricular');
            });

            // ========== ABSENT RECAPITULATION LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\AbsentRecapitulation::class)->group(function()
            {
                Route::get('/absent-recapitulation', \App\Http\Livewire\Student\AbsentRecapitulation::class)->name('absent-recapitulation');
            });

            // ========== MONTHLY REPORT LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\MonthlyReport::class)->group(function()
            {
                Route::get('/monthly-report', \App\Http\Livewire\Student\MonthlyReport::class)->name('monthly-report');
            });

            // ========== SEMESTER REPORT LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\SemesterReport::class)->group(function()
            {
                Route::get('/semester-report', \App\Http\Livewire\Student\SemesterReport::class)->name('semester-report');
            });
        });
    });
});

