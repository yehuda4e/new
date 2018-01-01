<?php
Auth::routes();

Route::get('category/{category}', 'CategoryController@show');

Route::get('forum', 'ForumController@index');
Route::get('forum/{forum}', 'ForumController@show');
Route::get('forum/category/{category}', 'ForumCategoryController@index');
Route::get('topic/create', 'TopicController@create');
Route::get('topic/{topic}', 'TopicController@show');
Route::post('topic/{topic}/comment', 'TopicController@comment');
Route::post('topic', 'TopicController@store');
Route::get('topic/{topic}/edit', 'TopicController@edit');
Route::patch('topic/{topic}', 'TopicController@update');
Route::delete('topic/{topic}', 'TopicController@destroy');

Route::get('user/{user}', 'UserController@show');

Route::get('/', 'ArticleController@index')->name('home');
Route::post('article', 'ArticleController@store');
Route::get('article/create', 'ArticleController@create');
Route::get('{article}', 'ArticleController@show');
Route::post('{article}/comment', 'ArticleController@comment');
Route::get('{article}/edit', 'ArticleController@edit');
Route::patch('{article}', 'ArticleController@update');
Route::delete('{article}', 'ArticleController@destroy');
