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
Route::group(['namespace' => 'Admin', 'prefix'=>'admin','middleware' => 'cors'], function (){
	Route::get('/getPolls/{id}','PollsController@getPolls');
	Route::resource('polls', 'PollsController');
	Route::post('/answerrecord/hasVoted','AnswerrecordController@hasVoted')->name('admin.answerrecord.hasVoted');
	Route::post('/answerrecord/getAllRightUsers','AnswerrecordController@getAllRightUsers')->name('admin.answerrecord.getAllRightUsers');
	Route::resource('answerrecord', 'AnswerrecordController');
});