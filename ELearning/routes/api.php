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
    'middleware' => 'auth.role:0'//admin
], function ($router) {
    Route::post('user/{userId}/activate', 'AdminController@activateUser');
    Route::post('user/{userId}/deactivate', 'AdminController@deactivateUser');
});
    /** Admin-grade */
Route::group([
    'prefix' => 'admin/grade',
    'middleware' => 'auth.role:0'//admin
], function ($router) {
    Route::put('/{id}', 'GradeController@update');
    Route::delete('/{id}', 'GradeController@delete');
});
    /** Admin-subject */
Route::group([
    'prefix' => 'admin/subject',
], function ($router) {
    Route::put('/{id}', 'SubjectController@update');
    Route::delete('/{id}', 'SubjectController@delete');
});


/** Teacher */
Route::group([
    'prefix' => 'teacher'
],  function ($router) {
    Route::get('/', 'TeacherController@index');
    Route::get('/{id}', 'TeacherController@detail');
    Route::post('/register', 'TeacherController@register');
});

Route::group([
    'prefix' => 'teacher',
    'middleware' => 'auth.role:1'//teacher
], function ($router) {
    Route::get('/info', 'TeacherController@info');
});

/** Student */
Route::group([
    'prefix' => 'student'
],  function ($router) {
    Route::post('/register', 'StudentController@register');
    Route::get('/', 'StudentController@search');
});

Route::group([
    'prefix' => 'student',
    'middleware' => 'auth.role:2'//student
], function ($router) {
    Route::get('/info', 'StudentController@info');
});


/** Parent */
Route::group([
    'prefix' => 'parent'
],  function ($router) {
    Route::post('/register', 'ParentController@register');
});

Route::group([
    'prefix' => 'parent',
    'middleware' => 'auth.role:3'//parent
], function ($router) {
    Route::get('/info', 'ParentController@info');
});

/** Grade */
Route::group([
    'prefix' => 'certificate',
], function ($router) {
    Route::post('/', 'CertificateController@create');
});

/** Grade */
Route::group([
    'prefix' => 'grade',
], function ($router) {
    Route::get('/', 'GradeController@index');
    Route::get('/{id}', 'GradeController@detail');
    Route::post('/', 'GradeController@create');
});

/** Subject */
Route::group([
    'prefix' => 'subject',
], function ($router) {
    Route::get('/', 'SubjectController@index');
    Route::get('/{id}', 'SubjectController@detail');
    Route::post('/', 'SubjectController@create');
});