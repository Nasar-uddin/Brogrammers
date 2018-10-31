<?php
use App\Catagory;

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

Route::get('/','PostsController@index');
Route::resource('posts','PostsController');
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/posts/user/{id}','PostsController@byuser');
Route::get('/posts/catagory/{id}','PostsController@bycatagory');
Route::post('/comment','CommentsController@store');
View::composer(['*'],function($view){
	$catagories = Catagory::all();
	$view->with('catagories',$catagories);
});