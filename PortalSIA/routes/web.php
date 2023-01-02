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



// ========== EXPORT CLASS DETAILS ========== //
Route::middleware(['auth'])->group(function ()
{
    // ========== EXPORTING CLASS AS PDF ========== //
    Route::get("export-class-pdf/{id?}", [\App\Http\Controllers\ExportClassAsPDF::class, "Export"])->name('export-class-pdf')->withoutMiddleware('auth.role:2');
    
    // ========== EXPORTING CLASS AS EXCEL ========== //
    Route::get("export-class-excel/{id?}", [\App\Http\Controllers\ExportClassAsExcel::class, "Export"])->name('export-class-excel')->withoutMiddleware('auth.role:2');
});



// ========== SCHOOL PROFILE ========== //
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

            // ========== ALL NOTIFICATIONS LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\AllNotification::class)->group(function()
            {
                Route::get('/all-notifications', \App\Http\Livewire\Admin\AllNotification::class)->name('all-notifications');
            });

            // ========== STUDENT CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\StudentCRUD::class)->group(function()
            {
                Route::get('/student-list', \App\Http\Livewire\Admin\StudentCRUD::class)->name('student-list');
            });

            // ========== STUDENT TAKING EXTRACURRICULAR CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\StudentTakingExtracurricularCRUD::class)->group(function()
            {
                Route::get('/student-taking-extracurricular', \App\Http\Livewire\Admin\StudentTakingExtracurricularCRUD::class)->name('student-taking-extracurricular');
            });

            // ========== TEACHER CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\TeacherCRUD::class)->group(function()
            {
                Route::get('/teacher-list', \App\Http\Livewire\Admin\TeacherCRUD::class)->name('teacher-list');
            });

            // ========== TEACHER TEACHING SUBJECT CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\TeacherTeachingSubjectCRUD::class)->group(function()
            {
                Route::get('/teacher-teaching-subject', \App\Http\Livewire\Admin\TeacherTeachingSubjectCRUD::class)->name('teacher-teaching-subject');
            });

            // ========== TEACHER TEACHING EXTRACURRICULAR CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\TeacherTeachingExtracurricularCRUD::class)->group(function()
            {
                Route::get('/teacher-teaching-extracurricular', \App\Http\Livewire\Admin\TeacherTeachingExtracurricularCRUD::class)->name('teacher-teaching-extracurricular');
            });

            // ========== CLASS CRUD LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Admin\ClassCRUD::class)->group(function()
            {
                Route::get('/class-list', \App\Http\Livewire\Admin\ClassCRUD::class)->name('class-list');
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
            Route::controller(\App\Http\Livewire\Student\TakingExtracurricularCRUD::class)->group(function()
            {
                Route::get('/extracurricular', \App\Http\Livewire\Student\TakingExtracurricularCRUD::class)->name('extracurricular');
            });

            // ========== ABSENT RECAPITULATION LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\AbsentRecapitulation::class)->group(function()
            {
                Route::get('/absent-recapitulation', \App\Http\Livewire\Student\AbsentRecapitulation::class)->name('absent-recapitulation');
            });

            // ========== SEMESTER REPORT LIVEWIRE ========== //
            Route::controller(\App\Http\Livewire\Student\SemesterReport::class)->group(function()
            {
                Route::get('/semester-report', \App\Http\Livewire\Student\SemesterReport::class)->name('semester-report');
            });
        });
    });
});

