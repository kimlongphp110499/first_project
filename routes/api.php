<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminApiController;
use App\Http\Controllers\CourseApiController;
use App\Http\Controllers\InstructorApiController;
use App\Http\Controllers\PostApiController;
use App\Http\Controllers\ReplyApiController;
use App\Http\Controllers\UserApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::group(['middleware' => 'api', 'prefix' => 'student'], function () {
    Route::post('/login', [UserApiController::class, 'login']);
    Route::post('/register', [UserApiController::class, 'register']);
    Route::post('/logout', [UserApiController::class, 'logout']);
    Route::post('/refresh', [UserApiController::class, 'refresh']);
    Route::get('/profile', [UserApiController::class, 'profile']);
});

Route::group(['middleware' => 'api', 'prefix' => 'admin'], function () {
    Route::post('/login', [AdminApiController::class, 'login']);
    Route::post('/register', [AdminApiController::class, 'register']);
    Route::post('/logout', [AdminApiController::class, 'logout']);
    Route::post('/refresh', [AdminApiController::class, 'refresh']);
    Route::get('/profile', [AdminApiController::class, 'profile']);

    // admin action
    Route::post('/course/create', [CourseApiController::class, 'create'])->middleware('auth:instructor');
});

Route::group(['middleware' => 'api', 'prefix' => 'instructor'], function () {
    Route::post('/login', [InstructorApiController::class, 'login']);
    Route::post('/register', [InstructorApiController::class, 'register']);
    Route::post('/logout', [InstructorApiController::class, 'logout']);
    Route::post('/refresh', [InstructorApiController::class, 'refresh']);
    Route::get('/profile', [InstructorApiController::class, 'profile']);

    // instructor action
    Route::post('/course/create', [CourseApiController::class, 'create'])->middleware('auth:instructor');
    Route::get('/course/post/delete', [CourseApiController::class, 'create'])->middleware('auth:instructor');
});

Route::group(['middleware' => 'api', 'prefix' => 'course'], function () {
    Route::post('create', [CourseApiController::class, 'create'])->middleware('auth:instructor');
    Route::post('enroll', [CourseApiController::class, 'enroll'])->middleware('auth:student');
    Route::post('delete', [CourseApiController::class, 'delete'])->middleware('auth:admin');
});

Route::group(['middleware' => 'api', 'prefix' => 'post'], function () {
    Route::post('create', [PostApiController::class, 'create'])->middleware('auth:instructor');
    Route::post('show', [PostApiController::class, 'show'])->middleware('auth:student');
    Route::post('delete', [PostApiController::class, 'delete'])->middleware('auth:instructor');
});

Route::group(['middleware' => 'api', 'prefix' => 'reply'], function () {
    Route::post('create', [ReplyApiController::class, 'create'])->middleware('auth:student');
    Route::post('delete', [ReplyApiController::class, 'delete']);
});