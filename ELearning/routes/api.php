<?php

use Illuminate\Http\Request;

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


/** Auth */
Route::group([
    'prefix' => 'auth'
],  function ($router) {
    Route::post('/login', 'AuthController@login');
});

Route::group([
    'middleware' => 'auth:api',
    'prefix' => 'auth'
],  function ($router) {
    Route::post('/logout', 'AuthController@logout');
    Route::post('/refresh', 'AuthController@refresh');
    Route::post('/info', 'AuthController@info');
});


/** Admin */
Route::group([
    'prefix' => 'admin',
    'middleware' => 'admin.auth'
], function ($router) {
    Route::post('user/{userId}/activate', 'AdminController@activateUser');
    Route::post('user/{userId}/deactivate', 'AdminController@deactivateUser');
});

/** Teacher */
Route::group([
    'prefix' => 'teacher'
],  function ($router) {
    Route::post('/register', 'TeacherController@register');
    Route::post('/info', 'TeacherController@info');
});

Route::group([
    'prefix' => 'teacher',
    'middleware' => 'teacher.auth'
], function ($router) {
    Route::get('/info', 'TeacherController@info');
});

/** Student */
Route::group([
    'prefix' => 'student'
],  function ($router) {
    Route::post('/register', 'StudentController@register');
    Route::post('/info', 'StudentController@info');
});

Route::group([
    'prefix' => 'student',
    'middleware' => 'student.auth'
], function ($router) {
    Route::get('/info', 'StudentController@info');
});