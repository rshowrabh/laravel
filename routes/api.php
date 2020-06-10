<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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

Route::apiResource('user', 'API\UserController');
Route::get('profile', 'API\UserController@profile');
Route::put('profile', 'API\UserController@upadteEx');
Route::get('profile/ex', 'API\UserExtendsController@index');
Route::put('profile/ex', 'API\UserExtendsController@updateEx');

Route::get('/contacts', 'ContactsController@get');
Route::get('/uniqueContacts', 'ContactsController@uniqueContacts');
Route::get('/conversation/{id}', 'ContactsController@getMessagesFor');
Route::post('/conversation/send', 'ContactsController@send');
 
Route::get('/onlineUsers', 'API\UserController@userOnlineStatus');
Route::get('changeStatus', 'API\UserController@changeStatus');

Route::apiResource('academic', 'API\AcademicController');
Route::apiResource('skill', 'API\SkillsController');
Route::apiResource('grade', 'API\GradesController');

Route::get('student_request', 'API\StudentRequestController@index');

Route::get('instantTutor', 'API\InstantTutorController@index');
Route::put('instantTutor', 'API\InstantTutorController@updateInstantTutor');
Route::get('getInstantTutor', 'API\InstantTutorController@getInstantTutor');

Route::get('my_students', 'API\MyStudentsController@index');




 