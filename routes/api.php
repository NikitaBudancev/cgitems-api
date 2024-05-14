<?php

use App\Http\Controllers\Api\Auth\LoginController;
use App\Http\Controllers\Api\Auth\LogoutController;
use App\Http\Controllers\Api\Auth\RegisterController;
use App\Http\Controllers\Api\Auth\VerificationController;
use App\Http\Controllers\Api\Courses\CourseController;
use App\Http\Controllers\Api\Courses\CourseProjectController;
use App\Http\Controllers\Api\Courses\CourseReviewController;
use App\Http\Controllers\Api\Courses\CourseUserController;
use App\Http\Controllers\Api\Media\ProjectMediaController;
use App\Http\Controllers\Api\Projects\ProfileProjectController;
use App\Http\Controllers\Api\Projects\ProjectController;
use App\Http\Controllers\Api\Projects\UserProjectController;
use App\Http\Controllers\Api\Projects\UserReviewController;
use App\Http\Controllers\Api\Stages\StageController;
use App\Http\Controllers\Api\Users\CurrentUserController;
use App\Http\Controllers\Api\Users\UserController;
use App\Http\Controllers\Api\Users\UserCourseController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::prefix('auth')->group(function () {
    Route::post('register', RegisterController::class)->name('register');
    Route::post('login', LoginController::class)->name('login');
    Route::post('logout', LogoutController::class)->middleware('auth')->name('logout');

    Route::prefix('verification')
        ->name('verification.')
        ->controller(VerificationController::class)
        ->group(function () {
            Route::post('verify', 'verify')->name('verify');
            Route::post('notify', 'notify')->middleware('auth')->name('notify');
        });
});

Route::prefix('me')->name('me.')->group(function () {
    Route::get('/', CurrentUserController::class);
    Route::apiResource('projects', ProfileProjectController::class)->names('projects');
    Route::apiResource('projects/media', ProjectMediaController::class)->names('projects.media');
})->middleware('auth');

Route::get('projects', ProjectController::class)->name('projects');

Route::apiResource('stages', StageController::class)->names('stages');

Route::apiResource('users', UserController::class)->names('users');
Route::apiResource('users.courses', UserCourseController::class)->names('users.courses');
Route::apiResource('users.projects', UserProjectController::class)->names('users.projects');
Route::apiResource('users.reviews', UserReviewController::class)->names('users.reviews');

Route::apiResource('courses', CourseController::class)->names('users.reviews');
Route::apiResource('courses.users', CourseUserController::class)->names('courses.users');
Route::apiResource('courses.reviews', CourseReviewController::class)->names('courses.reviews');
Route::apiResource('courses.projects', CourseProjectController::class)->names('courses.projects');
