<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the controller to call when that URI is requested.
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('login',['as'=>'login','uses'=>'Auth\AuthController@getLogin']);
Route::get('/auth/login',['as'=>'backLogin','uses'=>'Auth\AuthController@backLogin']);
Route::post('/postLogin', 'Auth\AuthController@postLogin');
Route::get('logout', ['as'=>'logout','uses'=>'Auth\AuthController@logout']);
Route::group(['prefix'=>'game', 'middleware'=>'auth'],function(){
	Route::get('admin/danh-sach-khach-hang',['as'=>'listUser','uses'=>'gameController@listUser']);
	Route::get('admin/them-khach-hang',['as'=>'addUser','uses'=>'gameController@addUser']);
	Route::post('admin/postAddUser',['as'=>'postAddUser','uses'=>'gameController@postAddUser']);
	Route::get('quay-nhanh-tay-nhan-ngay-qua-khung',['as'=>'gameShow','uses'=>'gameController@game']);
	Route::get('finish/{id}',['as'=>'finish','uses'=>'gameController@finish']);
	Route::get('phanthuong/{phanthuong}',['as'=>'phanthuong','uses'=>'gameController@phanthuong']);
});
