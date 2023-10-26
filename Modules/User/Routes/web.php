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
Route::group([ 'middleware' => 'auth' ], function () {
    // ...
    Route::get('/notifications', 'UserController@notifications');
});

// Route::get('/feed', 'UserController@generate_rss_feed')->name('file');


Route::prefix('/stock')->group(function() {
    Route::get('/', 'UserController@stock');
    Route::post('/content', 'UserController@stockContent')->name('user.stockContent');
    Route::get('/content', 'UserController@stockContent');
});
Route::get('/uploadimage', 'UploadImageController@index')->name('user.imgIndex');
Route::post('/save', 'UploadImageController@save');



// Route::prefix('/delete')->group(function() {
//     Route::post('/post', 'UserController@deletePost')->name('user.deletePost');


// });
Route::post('/changeFolderName', 'Ajax\UserPageAjaxController@changeFolderName')->name('user.changeFolderName');



Route::post('/deleteItem', 'Ajax\UserAjaxController@deleteItem')->name('user.deleteItem');
Route::post('/editItem', 'Ajax\UserAjaxController@editItem');
Route::post('/findItem', 'Ajax\UserAjaxController@findItem');

Route::post('/getTagsSuggest', 'Ajax\UserAjaxController@getTagsSuggest');

Route::get('/drafts', 'UserController@drafts')->name('user.drafts');



Route::post('/follow', 'Ajax\UserPageAjaxController@followUser');


Route::get('/publish', 'UserController@publishPost');

Route::post('/createCategory', 'Ajax\UserAjaxController@createCategory');

Route::post('/likePost', 'Ajax\UserAjaxController@likePost');
Route::post('/likeQuestion', 'Ajax\UserAjaxController@likeQuestion');

Route::post('/stockPost', 'Ajax\UserAjaxController@stockPost');
Route::post('/postComment', 'Ajax\UserAjaxController@postComment');
Route::post('/likeComment', 'Ajax\UserAjaxController@likeComment');
Route::post('/answearQuestion', 'Ajax\UserAjaxController@answearQuestion');
Route::post('/likeAnswear', 'Ajax\UserAjaxController@likeAnswear');

Route::prefix('/{username}')->group(function() {
    Route::get('/', 'UserPageController@userHomePage')->name('user.userHomePage');
    Route::get('/followers','UserPageController@followers')->name('user.followers');
    Route::get('/following','UserPageController@followingUser')->name('user.followingUser');
    Route::get('pagination', 'Ajax\UserPageAjaxController@userPage');

    Route::get('/private','UserPageController@privatePost')->name('user.private');
    
    Route::get('/posts/{item}','UserController@showPost')->name('user.showPost');
    Route::get('/posts/{item}/likers','UserController@postLiker')->name('user.postLiker');
     Route::get('/questions/{item}/likers','UserController@postLiker')->name('user.postLiker');



    Route::get('/privates/{item}','UserController@showPost');
    Route::post('/posts/{item}','UserController@storePost');
    Route::get('/questions/{quetion}','UserController@showQuestion')->name('user.showQuestion');;;
    Route::post('/questions/{quetion}','UserController@storeQuestion');

});

Route::prefix('/drafts')->group(function() {
    Route::get('/', 'UserController@drafts')->name('user.drafts');
    Route::post('/content', 'UserController@draftContent')->name('user.draftContent');


    Route::get('/post', 'UserController@createPost');
    Route::post('/post/store', 'UserController@storePost');
    Route::post('/post/edit', 'UserController@storePost');
    Route::get('/post/{item}/edit', 'UserController@editPost')->name('user.editPost');

    Route::get('/question', 'UserController@createQuestion');
    Route::post('/question/store', 'UserController@storeQuestion');
    Route::post('/question/edit', 'UserController@storeQuestion');
    Route::get('/question/{item}/edit', 'UserController@editQuestion')->name('user.editQuestion');;



    // Route::get('/{item}/edit', 'UserController@editPost')->name('user.editPost');
    // Route::get('/new/{item}/edit', 'UserController@editQuestion')->name('user.editQuestion');


});





