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

// Route::prefix('common')->group(function() {
    
// });


Route::get('/', 'CommonController@home');

Route::get('/logout', 'CommonController@logout');
Route::get('/logout', 'CommonController@logout');
Route::get('/sitemap.xml', 'SitemapXmlController@index');

Route::prefix('/search')->group(function() {
	Route::get('/', 'CommonController@search');
	Route::get('/pagination', 'CommonController@search');
});

Route::post('/report', 'Ajax\CommonAjaxController@reportUser');


Route::prefix('/timeline')->group(function() {
	Route::get('/', 'CommonController@timelineAll')->name('timeline.all');
	Route::get('/tag', 'CommonController@timelineTag');
	Route::get('/user', 'CommonController@timelineUser');
	Route::get('/group', 'CommonController@timelineGroup');


    // Route::post('/tag_quest', 'Ajax\CommonAjaxController@timelineTag');
    // Route::post('/user_quest', 'Ajax\CommonAjaxController@timelineUser');
	
    Route::post('/timeline_quest', 'Ajax\CommonAjaxController@timelineAll');
	Route::post('/user/timeline_quest', 'Ajax\CommonAjaxController@timelineUser');
	Route::post('/tag/timeline_quest', 'Ajax\CommonAjaxController@timelineTag');
	
	// Route::get('/pagination', 'CommonController@timelineAll');

	
	// Route::get('/tag/pagination', 'CommonController@timelineTag');

	
	// Route::get('/user/pagination', 'CommonController@timelineUser');	


// 

});

Route::prefix('/post')->group(function() {
	Route::get('/', 'CommonController@postdNewfeed')->name('post.newfeed');
	Route::get('/trend', 'CommonController@postTrend')->name('post.trend');
});

Route::prefix('/question')->group(function() {

	Route::get('/', 'CommonController@questionNewFeed')->name('question.newfeed');
	Route::get('/timeline', 'CommonController@questionTimeline')->name('question.timeline');
	Route::get('/trend', 'CommonController@questionTrend');
	Route::get('/waiting-answers', 'CommonController@questionWaitingAnswers');

});

Route::prefix('/tags/{tag_name}')->group(function() {
	Route::get('/', 'CommonController@tagPage');
	Route::post('/tag_quest', 'Ajax\CommonAjaxController@tagShow');

    Route::get('/pagination', 'Ajax\CommonAjaxController@tagShow');
});

Route::post('/tagsRank', 'Ajax\CommonAjaxController@tagsRank');
Route::post('/usersRank', 'Ajax\CommonAjaxController@usersRank');

Route::post('/tagfollow', 'Ajax\CommonAjaxController@tagFollow');


Route::post('/usersRankTag', 'Ajax\CommonAjaxController@usersRankTag');
// Route::post('/organizationRankTag', 'Ajax\CommonAjaxController@usersRank');



// Route::get('pagination', 'Ajax\CommonAjaxController@tagShow');