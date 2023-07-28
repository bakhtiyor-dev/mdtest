<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Auth::routes([
    'register' => false,
    'reset' => false,
    'confirm' => false,
    'verify' => false
]);

Route::middleware('auth')->namespace('App\\Http\\Controllers\\Client')->group(function () {

    Route::redirect('/', '/exams/available');

    Route::get('/exams/available', 'ExamController@available')->name('exams.available');
    Route::get('/exams/expired', 'ExamController@expired')->name('exams.expired');

    Route::get('/exams/{exam}/attempts', 'AttemptController@index')->name('exam.attempts');
    Route::get('/exam/attempts/{attempt}/view', 'AttemptController@show')->name('attempt.show');
    Route::get('/exams/{exam}/{attemptNumber}/start', 'AttemptController@start')->name('exam.start');
    Route::post('/exams/{exam}/{attempt}/finish', 'AttemptController@finish')->name('exam.finish');
});



/* Auto-generated admin routes */
Route::middleware(['auth:' . config('admin-auth.defaults.guard'), 'admin'])->group(static function () {
    Route::prefix('admin')->namespace('App\Http\Controllers\Admin')->name('admin/')->group(static function () {
        /* Auto-generated admin routes */
        Route::get('/', 'AnalyticsController@index');
        Route::get('/profile', 'ProfileController@editProfile')->name('edit-profile');
        Route::post('/profile', 'ProfileController@updateProfile')->name('update-profile');
        Route::get('/password', 'ProfileController@editPassword')->name('edit-password');
        Route::post('/password', 'ProfileController@updatePassword')->name('update-password');

        /* Auto-generated admin routes */
        Route::prefix('exam-user-attempts')->name('exam-user-attempts/')->group(static function () {
            Route::get('/', 'ExamUserAttemptController@index')->name('index');
            Route::post('/export', 'ExamUserAttemptController@export')->name('export');
            Route::post('/print', 'ExamUserAttemptController@print')->name('print');
            Route::get('/{attempt}/view', 'ExamUserAttemptController@result')->name('view');
            Route::delete('/{attempt}', 'ExamUserAttemptController@destroy')->name('destroy');
            Route::post('/bulk-destroy', 'ExamUserAttemptController@bulkDestroy')->name('bulk-destroy');
        });

        /* Auto-generated admin routes */
        Route::prefix('users')->name('users/')->group(static function () {
            Route::get('/', 'UserController@index')->name('index');

            if (!config('app.auth_ldap')) {
                Route::get('/create', 'UserController@create')->name('create');
                Route::post('/', 'UserController@store')->name('store');
                Route::get('/{user}/edit', 'UserController@edit')->name('edit');
            }

            Route::post('/bulk-destroy', 'UserController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{user}', 'UserController@update')->name('update');
            Route::delete('/{user}', 'UserController@destroy')->name('destroy');

            Route::get('/sync', 'UserController@sync')->name('sync');
        });

        /* Auto-generated admin routes */
        Route::prefix('exams')->name('exams/')->group(static function () {
            Route::get('/', 'ExamController@index')->name('index');
            Route::get('/create', 'ExamController@create')->name('create');
            Route::post('/', 'ExamController@store')->name('store');
            Route::get('/{exam}/edit', 'ExamController@edit')->name('edit');
            Route::post('/bulk-destroy', 'ExamController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{exam}', 'ExamController@update')->name('update');
            Route::delete('/{exam}', 'ExamController@destroy')->name('destroy');
        });

        /* Auto-generated admin routes */
        Route::prefix('tests')->name('tests/')->group(static function () {

            Route::post('/export', 'TestController@export')->name('export');
            Route::post('/import', 'TestController@import')->name('import');
            Route::post('/print', 'TestController@print')->name('print');

            Route::get('/', 'TestController@index')->name('index');
            Route::get('/create', 'TestController@create')->name('create');
            Route::post('/', 'TestController@store')->name('store');
            Route::get('/{test}/edit', 'TestController@edit')->name('edit');
            Route::post('/bulk-destroy', 'TestController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{test}', 'TestController@update')->name('update');
            Route::delete('/{test}', 'TestController@destroy')->name('destroy');

        });

        /* Auto-generated admin routes */
        Route::prefix('exam-users')->name('exam-users/')->group(static function () {

            Route::get('/exam/{exam}', 'ExamUserController@index')->name('index');
            Route::get('/exam/{exam}/create', 'ExamUserController@create')->name('create');
            Route::post('/exam/{exam}', 'ExamUserController@store')->name('store');
            Route::post('/bulk-destroy', 'ExamUserController@bulkDestroy')->name('bulk-destroy');
            Route::delete('/{examUser}', 'ExamUserController@destroy')->name('destroy');

            Route::get('/exam/{exam}/users/{user}', 'ExamUserAttemptController@show')->name('user.attempts');
            Route::get('/attempts/{attempt}/show', 'ExamUserAttemptController@result')->name('attempt');
            Route::post('/bulk-notify/{exam}', 'NotifyUserController')->name('bulk-notify');
        });

        /* Auto-generated admin routes */
        Route::prefix('rating-settings')->name('rating-settings/')->group(static function () {
            Route::get('/', 'RatingSettingController@index')->name('index');
            Route::get('/create', 'RatingSettingController@create')->name('create');
            Route::post('/', 'RatingSettingController@store')->name('store');
            Route::get('/{ratingSetting}/edit', 'RatingSettingController@edit')->name('edit');
            Route::post('/bulk-destroy', 'RatingSettingController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{ratingSetting}', 'RatingSettingController@update')->name('update');
            Route::delete('/{ratingSetting}', 'RatingSettingController@destroy')->name('destroy');
        });

        Route::prefix('departments')->name('departments/')->group(static function () {
            Route::get('/', 'DepartmentController@index')->name('index');
            Route::get('/create', 'DepartmentController@create')->name('create');
            Route::post('/', 'DepartmentController@store')->name('store');
            Route::get('/{department}/edit', 'DepartmentController@edit')->name('edit');
            Route::post('/bulk-destroy', 'DepartmentController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{department}', 'DepartmentController@update')->name('update');
            Route::delete('/{department}', 'DepartmentController@destroy')->name('destroy');
        });

        Route::prefix('test-categories')->name('test-categories/')->group(static function () {
            Route::get('/', 'TestCategoriesController@index')->name('index');
            Route::get('/create', 'TestCategoriesController@create')->name('create');
            Route::post('/', 'TestCategoriesController@store')->name('store');
            Route::get('/{testCategory}/edit', 'TestCategoriesController@edit')->name('edit');
            Route::post('/bulk-destroy', 'TestCategoriesController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{testCategory}', 'TestCategoriesController@update')->name('update');
            Route::delete('/{testCategory}', 'TestCategoriesController@destroy')->name('destroy');
        });

        Route::prefix('organisations')->name('organisations/')->group(static function () {
            Route::get('/', 'OrganisationController@index')->name('index');
            Route::get('/create', 'OrganisationController@create')->name('create');
            Route::post('/', 'OrganisationController@store')->name('store');
            Route::get('/{organisation}/edit', 'OrganisationController@edit')->name('edit');
            Route::post('/bulk-destroy', 'OrganisationController@bulkDestroy')->name('bulk-destroy');
            Route::post('/{organisation}', 'OrganisationController@update')->name('update');
            Route::delete('/{organisation}', 'OrganisationController@destroy')->name('destroy');
        });

    });
});