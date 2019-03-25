<?php

//Authentication
Route::post('v1/auth', 'AuthenticateController@authJwt');

Route::post('v1/users', 'UserController@store');

Route::group(['prefix' => 'v1/users', 'middleware' => 'jwt.auth'], function () {
    Route::get('/', 'UserController@all')->name('users');
    Route::get('{user_id}', 'UserController@show');
    Route::put('{user_id}', 'UserController@update');
    Route::delete('{user_id}', 'UserController@delete');
});

Route::group(['prefix' => 'v1/posts', 'middleware' => 'jwt.auth'], function () {
    Route::post('/', 'PostsController@store');
    Route::get('/', 'PostsController@all')->name('posts');
    Route::get('{post_id}', 'PostsController@show');
    Route::put('{post_id}', 'PostsController@update');
    Route::delete('{post_id}', 'PostsController@delete');
});

Route::group(['prefix' => 'v1/comments', 'middleware' => 'jwt.auth'], function () {
    Route::post('/', 'CommentsController@store');
    Route::get('/', 'CommentsController@all')->name('comments');
    Route::get('{comment_id}', 'CommentsController@show');
    Route::put('{comment_id}', 'CommentsController@update');
    Route::delete('{comment_id}', 'CommentsController@delete');
});