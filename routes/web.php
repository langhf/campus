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

//Route::get('/', function () {
//    return view('welcome');
//});



Route::get('/','HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/payinfos','HomeController@payinfos')->name('payinfos');

Route::get('/workchecks','HomeController@workchecks')->name('workchecks');

Route::get('/doorchecks','HomeController@doorchecks')->name('doorchecks');

Route::get('uncheckedusers','HomeController@unchecked')->name('uncheckedusers');

Route::get('checkedusers','HomeController@checked')->name('checkedusers');

Route::delete('users/{user_id}','HomeController@delete_user')->name('deleteuser');










