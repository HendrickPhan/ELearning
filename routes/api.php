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
    'prefix' => 'auth',
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
    'middleware' => 'auth.role:0' //admin
], function ($router) {
    Route::post('user/{userId}/activate', 'AdminController@activateUser');
    Route::post('user/{userId}/deactivate', 'AdminController@deactivateUser');
});
/** Admin-grade */
Route::group([
    'prefix' => 'admin/grade',
    'middleware' => 'auth.role:0' //admin
], function ($router) {
    Route::put('/{id}', 'GradeController@update')->where(['id' => '[0-9]+']);;
    Route::delete('/{id}', 'GradeController@delete')->where(['id' => '[0-9]+']);;
});
/** Admin-subject */
Route::group([
    'prefix' => 'admin/subject',
], function ($router) {
    Route::put('/{id}', 'SubjectController@update')->where(['id' => '[0-9]+']);;
    Route::delete('/{id}', 'SubjectController@delete')->where(['id' => '[0-9]+']);;
});


/** Teacher */
Route::group([
    'prefix' => 'teacher'
],  function ($router) {
    Route::get('/', 'TeacherController@index');
    Route::get('/{id}', 'TeacherController@detail')->where(['id' => '[0-9]+']);
    Route::post('/register', 'TeacherController@register');
    Route::post('/attach-certificates', 'TeacherController@attachCertificates');
    Route::post('/attach-grade-subjects', 'TeacherController@attachGradeSubjects');
});

Route::group([
    'prefix' => 'teacher',
    'middleware' => 'auth.role:1' //teacher
], function ($router) {
    Route::get('/info', 'TeacherController@info');
});

/** Teacher-Student subscribe*/
Route::group([
    'prefix' => 'teacher',
    'middleware' => 'auth.role:2' //student
], function ($router) {
    Route::post('{id}/subscribe', 'TeacherController@subscribeTeacher');
});

/** Teacher-Lesson*/
Route::group([
    'prefix' => 'lesson',
    'middleware' => 'auth.role:1' //teacher
], function ($router) {
    Route::post('/', 'LessonController@create');
    Route::get('/my-select-list', 'LessonController@mySelectList');
    
});
/** Teacher-Quiz */
Route::group([
    'prefix' => 'quiz',
    'middleware' => 'auth.role:1' //teacher
], function ($router) {
    Route::post('/', 'QuizController@create');
    Route::get('/my-select-list', 'QuizController@mySelectList');
    
});
/** Teacher-Essay */
Route::group([
    'prefix' => 'essay',
    'middleware' => 'auth.role:1' //teacher
], function ($router) {
    Route::post('/', 'EssayController@create');
    Route::get('/my-select-list', 'EssayController@mySelectList');
});


/** Student */
Route::group([
    'prefix' => 'student'
],  function ($router) {
    Route::post('/register', 'StudentController@register');
    Route::get('/', 'StudentController@index');
    Route::get('/{id}', 'StudentController@detail')->where(['id' => '[0-9]+']);

    Route::post('/{id}/subscribe', 'StudentController@subscribeStudent');
    Route::get('/subscribe', 'StudentController@subscribedParentList');
    Route::put('/subscribe/{id}/approve', 'StudentController@approveParentSubscribe');
    Route::put('/subscribe/{id}/reject', 'StudentController@rejectParentSubscribe');
});

Route::group([
    'prefix' => 'teacher',
    'middleware' => 'auth.role:2' //student
], function ($router) {
    Route::get('/info', 'StudentController@info');
});

/** Parent */
Route::group([
    'prefix' => 'parent'
],  function ($router) {
    Route::post('/register', 'ParentController@register');
    Route::get('/info', 'ParentController@info');

    Route::post('/student/{id}/subscribe', 'ParentController@subscribe');
});


/** Certificate */
Route::group([
    'prefix' => 'certificate',
], function ($router) {
    Route::post('/', 'CertificateController@create');
    Route::get('/', 'CertificateController@index');
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

/** Course */
Route::group([
    'prefix' => 'course',
    'middleware' => 'auth.role:1' //teacher
], function ($router) {
    Route::post('/', 'CourseController@create');
});


/** Lesson */
Route::group([
    'prefix' => 'lesson',
], function ($router) {
    Route::get('/{id}', 'LessonController@detail')->where(['id' => '[0-9]+']);
    Route::get('/', 'LessonController@index');
});

/** Quiz */

Route::group([
    'prefix' => 'course',
], function ($router) {
    Route::get('/{id}', 'CourseController@detail')->where(['id' => '[0-9]+']);
});

//---------------------student

Route::group([
    'prefix' => 'course',
    'middleware' => 'auth.role:2' //student
], function ($router) {
    Route::get('/recommend', 'CourseController@recommend');
    Route::get('/student-my-courses', 'CourseController@studentMyCourses');

    Route::get('/student-index', 'CourseController@studentIndex');
    
    Route::post('/{id}/enroll', 'CourseController@enroll');
    Route::get('/{course_id}/{lesson_id}/learn', 'LessonController@learnLesson');
    Route::get('/{course_id}/{lesson_id}/quiz', 'QuizController@doQuiz');
    Route::post('/{course_id}/{lesson_id}/quiz', 'QuizAttemptController@attempt');
   
    Route::post('/{course_id}/comment', 'CourseController@addComment');
});