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

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/here','ClassroomController@here');

Route::post('/login', 'AuthController@login');
Route::post('/parent/login', 'AuthController@login');
// Route::post('/teachers/login', 'AuthController@login');
// Route::post('/register', 'AuthController@register');
//complain
Route::post('/complain', 'ComplainController@complain');
Route::post('/reply', 'ComplainController@reply');
Route::get('/getreply', 'ComplainController@getreply');
Route::get('/getcomplain', 'ComplainController@getcomplain');
Route::get('/getnotification', 'NotificationsController@getnotifications');

Route::post('/savetoken', 'ParentController@savetoken');

//student core
Route::get('/fetchstudent', 'ParentController@fetchstudent');
Route::get('/getsettingpayment', 'ParentController@getsettingpayment');
Route::get('/fetchhistory', 'ParentController@fetchhistory');

Route::get('/getrecords', 'ParentController@getrecords');
Route::get('/getsessions', 'ParentController@getsessions');
Route::get('/getterms', 'ParentController@getterms');
Route::post('/payment','ParentController@payment');
Route::get('/getbasic','Student\studentassignment@getbasic');
// Route::get('/getcbt','Student\studentassignment@getcbt');
Route::post('submitcbt', 'Student\studentassignment@submitcbt');
Route::get('/cbtsubject','Student\studentassignment@cbtsubject');
Route::post('/getcbtquestions',"Student\studentassignment@getcbtquestions");
Route::post('/makepayment',"PaymentController@makepayment");
//products
Route::get('/getproducts', 'Inventory\ProductController@getproducts');

//utility
Route::post('/transaction','Utility\TranscationController@record');
Route::post('/placeorder','Inventory\OrderController@placeorder');

//inventory
Route::get('/getorders', 'Inventory\OrderController@getorders');
Route::get('/fetchorder','Inventory\OrderController@fetchorder');
Route::post('/createproduct', 'Inventory\ProductController@createproduct');
Route::get('/getproducts', 'Inventory\ProductController@getproducts');
Route::post('/collect','Inventory\OrderController@collect');
Route::get('/stats','Inventory\ProductController@stats');

//payment
Route::get('/apihistory', 'PaymentController@apihistory');
