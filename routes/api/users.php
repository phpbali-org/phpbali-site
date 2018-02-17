<?php 

use Illuminate\Support\Facades;

Route::group(['middleware' => 'auth:api'], function(){
	Route::match(['put','patch'],'/{id}','Api\UserController@update')->name('users.update');
});