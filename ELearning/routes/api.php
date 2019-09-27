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
    Route::post('/register', 'TeacherController@register');
    Route::get('/info', 'TeacherController@info');
    Route::get('/{id}', 'TeacherController@detail');
});


/** Student */
Route::group([
    'prefix' => 'student'
],  function ($router) {
    Route::post('/register', 'StudentController@register');
    Route::get('/', 'StudentController@index');
    Route::get('/info', 'StudentController@info');
    //Approve parent
    Route::put('/parent/approve', 'StudentController@approve');
    Route::put('/parent/reject', 'StudentController@reject');
    Route::get('/parent', 'StudentController@parentList');
    //Subcribe teacher
    Route::get('/teacher', 'StudentController@searchTeacher');
    Route::get('/teacher/{id}', 'StudentController@detailTeacher');
    Route::post('/teacher/{id}/subscribe', 'StudentController@subscribeTeacher');

    Route::get('/{id}', 'StudentController@detail');//de o cuoi 
});


/** Parent */
Route::group([
    'prefix' => 'parent'
],  function ($router) {
    Route::post('/register', 'ParentController@register');
    Route::post('/student/{id}/subscribe', 'ParentController@subscribe');
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