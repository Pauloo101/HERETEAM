<?php
use App\Models\sections;
use App\Http\Controllers\TeacherController;
use App\Models\Classroom;
use GuzzleHttp\Psr7\Response;

Route::get('/', function () {
    return view('cms.landing');
});
//CMS Route
Route::get('/gallery', function(){
 return view('cms.gallery');
});
Route::get('/news', function () {
    return view('cms.news') ;
 });
Route::get('/director', function () {
    return view('cms.director');
});
Route::get('/about', function(){
    return view('cms.about');
});

Route::get('/bum', function(){
    return 'here';
});

// finance
Route::get('/finance','Utility\PaymentController@index')->middleware('auth');
Route::get('/fetchpayment','Utility\PaymentController@fetchpayment')->middleware('auth');
Route::post('/getstats','Utility\PaymentController@getstats');







//Route::get('/{any}', 'SpaController@index')->where('any', '.*');
Auth::routes(['register' =>  false]);

Route::get('/result',function(){
    return view('result.index');
});

Route::get('/payment',function(){
    return view('mobile.mobile');
})->middleware('auth');

Route::get('/home', 'HomeController@index')->name('home');
//Student core
Route::resource('/student', 'StudentController');
Route::post('/removestudent','StudentController@removestudent');
Route::get('/fetchstudent', 'StudentController@fetchstudent');
Route::post('/updatestudent','StudentController@studentupdate');
Route::get('/getrecords','StudentController@getrecords');
Route::post('/record','Pivot\student_subjectController@record');
Route::resource('/teacher','TeacherController');
Route::post('/saverecord', 'TeacherController@saverecord');
//gradecontroller
Route::get('/subjectresult','GradeController@subjectresult');
Route::post('/approve','GradeController@approve');
//promote
Route::post('/promotestudent','StudentController@promotestudent');
Route::post('/migratetoterm','SettingController@migratetoterm');
Route::post('/subjectteacher', 'TeacherController@subjectteacher');
Route::get('/getteachers',function(){
    $teachers = \App\Models\Teacher::all();
    return $teachers;
});
Route::get('/searchstudent','StudentController@searchstudent');

//Route::post('/Class','ClassroomController@store');
Route::resource('/gradesystem','GradeController');
//marks
Route::get('/fetchmarks', 'Pivot\student_subjectController@fetchmarks');

//subjects
Route::resource('/subject','SubjectController');
Route::get('/getsubject', 'SubjectController@getsubject' );
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
Route::get('/classlist',function(){
    $classrooms =  Classroom::with('sections')->get();
    return $classrooms;
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
Route::get('/getactivesettings','SettingController@getactivesetting');
//session
Route::resource('/session','SessionController');
//term
Route::resource('/term','TermController');
Route::get('/getterms','TermController@getterms');
//assign student to subject


// Route::post('/ccc', 'TeacherController@here');
//test and exam records
Route::post('/save','RecordController@save');
// Route::post('/testtwo',);
// Route::post('/testthree',);
// Route::post('/exam',);

//configstudent vue file
Route::get('/getparent','StudentController@getparent');

    //teachers route
    Route::get('teachers/login','AuthTeacher\LoginController@showLoginForm')->name('teacher.login');
    Route::post('teachers/login','AuthTeacher\LoginController@login');
    Route::post('teachers/teacher-password/email','AuthTeacher\ForgotPasswordController@sendResetLinkEmail')->name('teacher.password.email');
    Route::get('teachers/teacher-password/reset','AuthTeacher\ForgotPasswordController@showLinkRequestForm')->name('teacher.password.request');
    Route::post('teachers/teacher-password/resest','AuthTeacher\ResetPasswordController@reset');
    Route::get('teachers/teacher-password/resest/{token}','AuthTeacher\ResetPasswordController@showResetForm')->name('teacher.password.reset');
    Route::get('/teachers','AuthTeacher\TeacherController@index');
    Route::get('/teachers/teacher-subject','AuthTeacher\TeacherController@getsubject');
    Route::post('/teachers/saverecord','AuthTeacher\TeacherController@saverecord');
    Route::get('teachers/subjectlist','AuthTeacher\TeacherController@subjectlist');
    Route::get('/teachers/getclassroom', 'AuthTeacher\TeacherController@getclassroom');
    Route::get('teachers/getsection', 'AuthTeacher\TeacherController@getsection');
    Route::post('/teachers/storecbt','AuthTeacher\TeacherController@storecbt');
    Route::get('/teachers/gettopics','AuthTeacher\TeacherController@gettopics');
    Route::get('/teachers/getquestions','AuthTeacher\TeacherController@getquestions');
    Route::get('/teachers/assignmentstats','AuthTeacher\TeacherController@assignmentstats');






//payment
Route::post('/createpayment','PaymentController@createpayment');
Route::get('/getsettingpayment','PaymentController@getsettingpayment');
Route::get('/fetchhistory','PaymentController@fetchhistory');
Route::post('/savepayment','PaymentController@savepayment');
Route::post('/recordpayment','PaymentController@recordpayment');
Route::get('/paymentoverview','PaymentController@paymentoverview');
Route::get('fetchbill','PaymentController@fetchbill');
Route::get('fetchdebtors','PaymentController@fetchdebtors');
Route::get('getpayment','PaymentController@getpayment');
Route::post('/assignpayment','PaymentController@assignpayment');
Route::post('/unassignpayment','PaymentController@unassignpayment');
Route::get('/payverify','PaymentController@payverify');
Route::get('/fetchunassigned','PaymentController@fetchunassigned');
Route::get('/gethistory','PaymentController@gethistory');




//complain
Route::get('/complain','ComplainController@index');
Route::post('/reply', 'ComplainController@reply');
Route::get('/getreply', 'ComplainController@getreply');
Route::post('/complain', 'ComplainController@complain');
Route::get('/complains', function () {
    $complains = \App\Models\Complain::all();
    return $complains;
});
Route::get('/getcomplain', 'ComplainController@getcomplain');

//notification
Route::post('/sendpush', 'NotificationsController@sendpush');
Route::post('/manypush', 'NotificationsController@manypush');
Route::get('/getnotifications','NotificationsController@getnotifications');
//assignment
Route::get('/manageassignment','AssignmentController@manage');
Route::get('/assignment','AssignmentController@index');
Route::post('/storebasic','AssignmentController@storebasic');
Route::post('/storecbt','AssignmentController@storecbt');
//teacher assignment
Route::get('teachers/assignment','AuthTeacher\TeacherController@createassignment');
Route::post('teachers/storebasic','AuthTeacher\TeacherController@storebasic');
Route::get('teachers/manageassignment', 'AuthTeacher\TeacherController@manageassignment');
//api stuff
Route::get('/getbasic','Student\studentassignment@getbasic');
Route::get('/getcbt', 'Student\studentassignment@getcbt');
Route::get('/cbtsubject', 'Student\studentassignment@cbtsubject');
Route::get('/paul','ExpController@here');

// Route::post('/subscribe','E')

//excel
Route::get('/importstudent','Excel\importstudent@index');
Route::post('/importparse','Excel\importstudent@parse')->name('import_parse');
Route::post('/importprocess','Excel\importstudent@process')->name('import_process');


//inventory
Route::get('/sales','Inventory\ProductController@index');
Route::get('/getorders','Inventory\OrderController@getorders');
Route::post('/createproduct','Inventory\ProductController@createproduct');
Route::get('/getproducts','Inventory\ProductController@getproducts');

//utility
Route::get('/gettransactions','Utility\TranscationController@gettransactions');
Route::post('/ticket','Utility\TicketController@store');
//parent
Route::get('/parents','ParentController@index');
Route::get('/searchparent','ParentController@searchparent');
Route::post('/matchparent','ParentController@matchparent');
Route::post('/updateparent','ParentController@updateparent');
Route::post('/placeorder', 'Inventory\OrderController@placeorder');


//test
Route::get('/totalstudent','ApiController@totalstudent');
