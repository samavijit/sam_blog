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

Route::get('/', 'BlogController@index')->name('blog');
Route::get('/category/{category}', 'BlogController@category')->name('category');
Route::get('/author/{author}', 'BlogController@author')->name('author');
Route::get('/tag/{tag}', 'BlogController@tag')->name('tag');

Route::get('/blog/{post}', 'BlogController@show')->name('blog.show');
Route::post('/blog/comments/{post}', 'CommentsController@store')->name('blog.comments');
Auth::routes();

Route::get('/home', 'Backend\HomeController@index')->name('home');
Route::get('/edit-account', 'Backend\HomeController@edit')->name('edit-account');
Route::put('/edit-account', 'Backend\HomeController@update')->name('edit-account');

Route::group(['prefix'=>'backend', 'as'=>'backend.'],function(){

Route::resource('blog', 'Backend\BlogController');
Route::resource('category', 'Backend\CategoryController');
Route::resource('tags', 'Backend\TagsController');
Route::resource('user', 'Backend\UserController');


});

Route::put('backend/blog/restore/{blog}', 'Backend\BlogController@restore')->name('backend.blog.restore');
Route::delete('backend/blog/force-destroy/{blog}', 'Backend\BlogController@forceDestroy')->name('backend.blog.force-destroy');
Route::get('backend/user/confirm/{user}', 'Backend\UserController@confirm')->name('backend.user.confirm');