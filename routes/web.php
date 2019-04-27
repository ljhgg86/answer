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
    return redirect()->route('admin.polls.index');
});
Route::group(['namespace' => 'Admin', 'prefix'=>'admin','middleware' => 'auth'], function (){
	Route::get('/polls/index','PollsController@index')->name('admin.polls.index');
	Route::get('/polls/reward/{pollid}','PollsController@reward')->name('admin.polls.reward');
	Route::get('/polls/getRewards/{pollid}','PollsController@getRewards')->name('admin.polls.getRewards');
	// Route::get('/polls/listvotes/{id}','PollsController@listvotes')->name('admin.polls.listvotes');
	Route::resource('polls','PollsController');
	
	Route::get('/votes/editvotes/{id}/{pollid}','VotesController@editvotes')->name('admin.votes.editvotes');
	Route::get('/votes/listvotes/{id}','VotesController@listvotes')->name('admin.votes.listvotes');
	Route::get('/votes/getvote/{id}','VotesController@getvote')->name('admin.votes.getvote');
	Route::get('/votes/destroyvote/{pollid}/{id}','VotesController@destroyvote')->name('admin.votes.destroyvote');
	Route::resource('votes','VotesController',['except'=>['edit']]);
	Route::get('/options/listoptions/{id}','OptionsController@listoptions')->name('admin.options.listoptions');
	Route::resource('options','OptionsController');
	Route::post('/image/upload', 'UploadController@uploadImgFile')->name('image.upload');
	Route::post('/video/upload', 'UploadController@uploadVideoFile')->name('video.upload');
	Route::post('/answerrecord/lottery','AnswerrecordController@lottery')->name('admin.answerrecord.lottery');
	Route::get('/answerrecord/index','AnswerrecordController@index')->name('admin.answerrecord.index');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
