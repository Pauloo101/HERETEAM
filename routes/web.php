<?php

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

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/{any}', 'SpaController@index')->where('any', '.*');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource('/student', 'StudentController');
Route::resource('/teacher','TeacherController');
Route::resource('/Class','ClassroomController');
Route::resource('/gradesystem','GradeController');
Route::resource('/subject','SubjectController');
Route::get('/dashboard', function (){
    return App\Models\Student::with('classroom')->latest()->get();
});

