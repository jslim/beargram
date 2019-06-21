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

use App\Mail\NewUserWelcomeMail;


Auth::routes();



Route::get('/email', function(){

			return new NewUserWelcomeMail();


		}); //temporaly testing the emails templates


Route::post('follow/{user}','FollowsController@store'); //para follow a usuarios



Route::get('/', 'PostsController@index'); //para mostrar los posts de following en index 


Route::get('/recent', 'PostsController@recent');  //para mostrar los posts mas recientes

Route::get('/p/create', 'PostsController@create');

Route::post('/p', 'PostsController@store');

Route::get('p/{post}', 'PostsController@show');


Route::get('/profile/{user}', 'ProfilesController@index')->name('profile.show'); //muestra el perfil

Route::get('/profile/{user}/edit', 'ProfilesController@edit')->name('profile.edit'); //muestra el formulario


Route::patch('/profile/{user}', 'ProfilesController@update')->name('profile.update'); //hace el proceso del update