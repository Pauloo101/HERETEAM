<?php
use App\Models\sections;
use App\Http\Controllers\TeacherController;
use GuzzleHttp\Psr7\Response;

Route::get('/', function () {
    return view('welcome');
});
//Route::get('/{any}', 'SpaController@index')->where('any', '.*');
Auth::routes(['register' =>  false]);

Route::get('/home', 'HomeController@index')->name('home');
//Student core
Route::resource('/student', 'StudentController');
Route::get('/fetchstudent', 'StudentController@fetchstudent');
Route::post('/updatestudent','StudentController@studentupdate');
Route::get('/getrecords','StudentController@getrecords');
Route::post('/record','Pivot\student_subjectController@record');
Route::resource('/teacher','TeacherController');
Route::post('/subjectteacher', 'TeacherController@subjectteacher');
Route::get('/getteachers',function(){
    $teachers = \App\Models\Teacher::all();
    return $teachers;
});

//Route::post('/Class','ClassroomController@store');
Route::resource('/gradesystem','GradeController');
//marks
Route::get('/fetchmarks', 'Pivot\student_subjectController@fetchmarks');

//subjects
Route::resource('/subject','SubjectController');
Route::get('/getsubject',function(){
    $subject = \App\Models\Subject::all();
    return $subject;
});
Route::get('/fetchsubject', 'SubjectController@fetchsubject');
Route::get('/fetchclass/{id}', function($id){
    $classroom = \App\Models\Subject::find($id)->classrooms;
    return $classroom;
});
Route::post('/subject/assignclass','SubjectController@assignclass')->name('subject.assignclass');
Route::post('/subject/Regstudent', 'SubjectController@Regstudent')->name('subject.Regstudent');
Route::post('/subject/Regclass','SubjectController@RegClass')->name('subject.RegClass');
Route::resource('/classroom&subject','Pivot\classroom_subjectController');
Route::resource('/student&subject','Pivot\student_subjectController');
Route::get('/dashboard/{here}', function (){
    return App\Models\Student::with('classroom')->latest()->get();
});





//section and classroom
Route::post('/storesection','ClassroomController@storesection');
Route::get('/section','ClassroomController@indexsection')->middleware('cors');
Route::resource('/Class','ClassroomController');
Route::post('/classupdate','ClassroomController@classupdate');
Route::post('/classdelete','ClassroomController@classdelete');
Route::get('/classroom', function (){
   return \App\Models\Classroom::all();
});
Route::post('/updatesection','ClassroomController@updatesection');
//select class and section
Route::get('/search/{gg}', function ($gg){
    $here = \App\Models\Classroom::find($gg)->sections()->get();

    return $here;
});
Route::get('/why',function(){
    $here = \App\Models\sections::all();
    return $here;
});

//settings
Route::resource('/settings','SettingController');
Route::get('/getsettings', function(){
$settings = \App\Setting::all();
return $settings;
});
//session
Route::resource('/session','SessionController');
//term
Route::resource('/term','TermController');
//assign student to subject


// Route::post('/ccc', 'TeacherController@here');
//test and exam records
Route::post('/save','RecordController@save');
// Route::post('/testtwo',);
// Route::post('/testthree',);
// Route::post('/exam',);

//configstudent vue file
Route::get('/getparent','StudentController@getparent');

    //teacher route
    Route::get('teachers/login','AuthTeacher\LoginController@showLoginForm')->name('teacher.login');
    Route::post('teachers/login','AuthTeacher\LoginController@login');
    Route::post('teachers/teacher-password/email','AuthTeacher\ForgotPasswordController@sendResetLinkEmail')->name('teacher.password.email');
    Route::get('teachers/teacher-password/reset','AuthTeacher\ForgotPasswordController@showLinkRequestForm')->name('teacher.password.request');
    Route::post('teachers/teacher-password/resest','AuthTeacher\ResetPasswordController@reset');
    Route::get('teachers/teacher-password/resest/{token}','AuthTeacher\ResetPasswordController@showResetForm')->name('teacher.password.reset');
    Route::get('/teachers','AuthTeacher\TeacherController@index');
    Route::get('/teachers/teacher-subject','AuthTeacher\TeacherController@getsubject');

