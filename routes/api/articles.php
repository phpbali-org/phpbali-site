<?php 

use Illuminate\Support\Facades\Route;

Route::get('published','Api\ArticleController@publishedArticles')->name('articles.published.index');
Route::get('published/{id}','Api\ArticleController@publishedArticle')->name('articles.published.show');

Route::group(['middleware' => 'auth:api'], function() {
	Route::post('/','Api\ArticleController@store')->name('articles.store');
	Route::get('/','Api\ArticleController@index')->name('articles.index');
	Route::get('/{id}','Api\ArticleController@show')->name('articles.show');
	Route::match(['put','patch'],'/{id}','Api\ArticleController@update')->name('articles.update');
	Route::delete('/{id}','Api\ArticleController@delete')->name('articles.delete');

});